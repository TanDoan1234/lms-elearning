<?php

namespace Tests\Feature\E2E;

use App\Livewire\Exam\TakeExam;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class FullLearningPathTest extends TestCase
{
    use RefreshDatabase;

    public function test_registered_student_completes_free_course_passes_final_exam_and_receives_certificate(): void
    {
        Storage::fake('public');
        $course = Course::factory()->create(['price' => 0, 'status' => 'published']);
        $section = Section::create(['course_id' => $course->id, 'title' => 'Chương 1', 'position' => 1]);
        $lessons = collect([1, 2])->map(fn ($position) => Lesson::create([
            'section_id' => $section->id, 'title' => "Bài $position", 'type' => 'video', 'position' => $position,
        ]));
        $exam = Exam::create(['course_id' => $course->id, 'title' => 'Thi cuối khóa', 'duration_minutes' => 30,
            'pass_score' => 60, 'max_attempts' => 2, 'shuffle_questions' => false, 'is_final' => true, 'status' => 'published']);
        $question = Question::create(['course_id' => $course->id, 'created_by' => $course->instructor_id,
            'content' => 'Laravel dùng mô hình nào?', 'type' => 'single', 'difficulty' => 'easy']);
        $correct = $question->options()->create(['content' => 'MVC', 'is_correct' => true]);
        $question->options()->create(['content' => 'Không có', 'is_correct' => false]);
        $exam->questions()->attach($question, ['points' => 1, 'position' => 1]);

        $this->post(route('register'), ['name' => 'Học viên E2E', 'email' => 'e2e@lms.test',
            'password' => 'password', 'password_confirmation' => 'password'])->assertRedirect(route('dashboard'));
        $student = User::where('email', 'e2e@lms.test')->firstOrFail();
        $this->post(route('courses.enroll', $course))->assertRedirect(route('learn.show', $course));

        $this->postJson(route('lessons.complete', $lessons[0]))
            ->assertOk()->assertJson(['progress' => 50, 'course_completed' => false, 'certificate_url' => null]);
        $this->postJson(route('lessons.complete', $lessons[1]))
            ->assertOk()->assertJson(['progress' => 100, 'course_completed' => true, 'certificate_url' => null]);
        $this->assertDatabaseCount('certificates', 0);

        $this->post(route('exams.start', $exam))->assertRedirect();
        $attempt = ExamAttempt::firstOrFail();
        Livewire::actingAs($student)->test(TakeExam::class, ['attempt' => $attempt])
            ->call('selectOption', $correct->id)->call('submit');

        $this->assertTrue($attempt->fresh()->passed);
        $certificate = Certificate::whereBelongsTo($student)->whereBelongsTo($course)->firstOrFail();
        Storage::disk('public')->assertExists($certificate->file_path);
        $this->get(route('certificates.verify', $certificate->code))->assertOk()
            ->assertSee('CHỨNG CHỈ HỢP LỆ')->assertSee($student->name);
        $this->get(route('certificates.download', $certificate))->assertOk();
        $other = User::factory()->create(['role' => 'student']);
        $this->actingAs($other)->get(route('certificates.download', $certificate))->assertForbidden();
    }
}
