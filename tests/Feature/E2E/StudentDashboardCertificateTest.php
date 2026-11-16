<?php

namespace Tests\Feature\E2E;

use App\Models\Course;
use App\Models\Exam;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\User;
use App\Services\CertificateService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StudentDashboardCertificateTest extends TestCase
{
    use RefreshDatabase;

    private function courseWithLesson(): array
    {
        $course = Course::factory()->create(['price' => 0, 'status' => 'published']);
        $section = Section::create(['course_id' => $course->id, 'title' => 'Chương 1', 'position' => 1]);
        $lesson = Lesson::create(['section_id' => $section->id, 'title' => 'Bài 1', 'type' => 'video', 'position' => 1]);

        return [$course, $lesson];
    }

    public function test_completed_course_with_certificate_shows_view_certificate_button_opening_pdf_inline(): void
    {
        Storage::fake('public');
        [$course, $lesson] = $this->courseWithLesson();
        $student = User::factory()->create(['role' => 'student']);
        $student->enrolledCourses()->attach($course->id, ['status' => 'active', 'price_paid' => 0, 'enrolled_at' => now()]);
        $student->completedLessons()->attach($lesson->id, ['completed_at' => now()]);
        $certificate = app(CertificateService::class)->issueIfEligible($student, $course);
        $this->assertNotNull($certificate);

        $this->actingAs($student)->get(route('student.dashboard'))
            ->assertOk()->assertSee('Xem chứng chỉ')->assertSee($certificate->code)
            ->assertSee(route('certificates.download', [$certificate, 'inline' => 1]), false);

        $this->actingAs($student)->get(route('certificates.download', [$certificate, 'inline' => 1]))
            ->assertOk()->assertHeader('content-disposition', 'inline; filename='.$certificate->code.'.pdf');
        $this->actingAs($student)->get(route('certificates.download', $certificate))
            ->assertOk()->assertHeader('content-disposition', 'attachment; filename='.$certificate->code.'.pdf');
    }

    public function test_finished_lessons_without_passed_final_exam_prompts_final_exam(): void
    {
        [$course, $lesson] = $this->courseWithLesson();
        $exam = Exam::create(['course_id' => $course->id, 'title' => 'Thi cuối khóa', 'duration_minutes' => 30,
            'pass_score' => 60, 'max_attempts' => 3, 'shuffle_questions' => false, 'is_final' => true, 'status' => 'published']);
        $student = User::factory()->create(['role' => 'student']);
        $student->enrolledCourses()->attach($course->id, ['status' => 'active', 'price_paid' => 0, 'enrolled_at' => now()]);
        $student->completedLessons()->attach($lesson->id, ['completed_at' => now()]);

        $this->actingAs($student)->get(route('student.dashboard'))
            ->assertOk()->assertDontSee('Xem chứng chỉ')->assertSee('Làm bài thi cuối khóa')
            ->assertSee(route('exams.show', $exam), false);
    }
}
