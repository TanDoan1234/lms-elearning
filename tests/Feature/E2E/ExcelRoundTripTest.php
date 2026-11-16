<?php

namespace Tests\Feature\E2E;

use App\Models\Course;
use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ExcelRoundTripTest extends TestCase
{
    use RefreshDatabase;

    public function test_template_is_xlsx_and_question_export_can_be_imported_without_losing_correct_options(): void
    {
        $instructor = User::factory()->create(['role' => 'instructor']);
        $source = Course::factory()->create(['instructor_id' => $instructor->id]);
        $target = Course::factory()->create(['instructor_id' => $instructor->id]);
        $single = $this->question($source, 'single', [true, false, false]);
        $multiple = $this->question($source, 'multiple', [true, true, false]);

        $template = $this->actingAs($instructor)->get(route('instructor.questions.template'));
        $template->assertOk()->assertHeader('content-disposition', 'attachment; filename=mau-cau-hoi.xlsx');
        $this->assertStringContainsString('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            (string) $template->headers->get('content-type'));

        $export = $this->get(route('instructor.courses.questions.export', $source));
        $export->assertOk();
        $path = $export->baseResponse->getFile()->getPathname();
        $upload = new UploadedFile($path, 'round-trip.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', null, true);
        $this->post(route('instructor.courses.questions.import', $target), ['file' => $upload])
            ->assertSessionHas('success');

        $this->assertSame(2, $target->questions()->count());
        $importedSingle = $target->questions()->with('options')->where('content', $single->content)->firstOrFail();
        $importedMultiple = $target->questions()->with('options')->where('content', $multiple->content)->firstOrFail();
        $this->assertSame(1, $importedSingle->options->where('is_correct', true)->count());
        $this->assertSame(2, $importedMultiple->options->where('is_correct', true)->count());
    }

    private function question(Course $course, string $type, array $correct): Question
    {
        $question = Question::create(['course_id' => $course->id, 'created_by' => $course->instructor_id,
            'content' => "Câu $type", 'type' => $type, 'difficulty' => 'medium', 'explanation' => 'Giải thích']);
        foreach ($correct as $index => $isCorrect) {
            $question->options()->create(['content' => 'Phương án '.($index + 1), 'is_correct' => $isCorrect]);
        }

        return $question;
    }
}
