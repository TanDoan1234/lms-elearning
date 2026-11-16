<?php

namespace Tests\Feature\Exams;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Tests\TestCase;

class QuestionImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_generated_xlsx_import_creates_questions_and_options(): void
    {
        $instructor = User::factory()->create(['role' => 'instructor']);
        $course = Course::factory()->create(['instructor_id' => $instructor->id]);
        $sheet = new Spreadsheet;
        $sheet->getActiveSheet()->fromArray([
            ['noi_dung', 'loai', 'do_kho', 'dap_an_a', 'dap_an_b', 'dap_an_c', 'dap_an_d', 'dap_an_e', 'dap_an_f', 'dap_an_dung', 'giai_thich'],
            ['2 + 2 bằng bao nhiêu?', 'single', 'easy', '4', '3', '', '', '', '', 'A', 'Phép cộng cơ bản'],
        ]);
        $path = tempnam(sys_get_temp_dir(), 'questions').'.xlsx';
        (new Xlsx($sheet))->save($path);

        $response = $this->actingAs($instructor)->post(route('instructor.courses.questions.import', $course), ['file' => new UploadedFile($path, 'questions.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', null, true)]);

        $response->assertRedirect()->assertSessionHas('success');
        $this->assertDatabaseHas('questions', ['course_id' => $course->id, 'content' => '2 + 2 bằng bao nhiêu?']);
        $this->assertDatabaseCount('options', 2);
        @unlink($path);
    }

    public function test_invalid_row_is_reported_in_vietnamese(): void
    {
        $instructor = User::factory()->create(['role' => 'instructor']);
        $course = Course::factory()->create(['instructor_id' => $instructor->id]);
        $csv = "noi_dung,loai,do_kho,dap_an_a,dap_an_b,dap_an_c,dap_an_d,dap_an_e,dap_an_f,dap_an_dung,giai_thich\nCâu lỗi,single,easy,A,B,,,,,\"A,C\",Lỗi\n";
        $response = $this->actingAs($instructor)->from(route('instructor.courses.questions.index', $course))->post(route('instructor.courses.questions.import', $course), ['file' => UploadedFile::fake()->createWithContent('questions.csv', $csv)]);
        $response->assertRedirect(route('instructor.courses.questions.index', $course))->assertSessionHas('error')->assertSessionHas('import_errors', fn ($errors) => str_contains($errors[0], 'Dòng 2'));
        $this->assertDatabaseCount('questions', 0);
    }
}
