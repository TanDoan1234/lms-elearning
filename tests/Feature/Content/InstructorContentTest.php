<?php

namespace Tests\Feature\Content;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class InstructorContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_instructor_can_build_course_sections_and_lessons(): void
    {
        Storage::fake('public');
        $instructor = User::factory()->create(['role' => 'instructor']);
        $category = Category::factory()->create();
        $this->actingAs($instructor)->post(route('instructor.courses.store'), ['title' => 'Laravel thực chiến', 'category_id' => $category->id, 'level' => 'beginner', 'price' => 0, 'status' => 'draft', 'thumbnail' => UploadedFile::fake()->image('cover.jpg')])->assertRedirect();
        $course = Course::first();
        $this->assertSame('laravel-thuc-chien', $course->slug);
        Storage::disk('public')->assertExists($course->thumbnail);
        $this->actingAs($instructor)->post(route('instructor.courses.sections.store', $course), ['title' => 'Bắt đầu'])->assertRedirect();
        $section = Section::first();
        $this->actingAs($instructor)->post(route('instructor.sections.lessons.store', $section), ['title' => 'Giới thiệu', 'type' => 'video', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 5])->assertRedirect();
        $this->assertDatabaseHas('lessons', ['section_id' => $section->id, 'title' => 'Giới thiệu']);
    }

    public function test_instructor_cannot_edit_another_instructors_course(): void
    {
        $owner = User::factory()->create(['role' => 'instructor']);
        $other = User::factory()->create(['role' => 'instructor']);
        $course = Course::factory()->create(['instructor_id' => $owner]);
        $this->actingAs($other)->get(route('instructor.courses.edit', $course))->assertForbidden();
    }

    public function test_lesson_upload_is_deleted_with_lesson(): void
    {
        Storage::fake('public');
        $instructor = User::factory()->create(['role' => 'instructor']);
        $course = Course::factory()->create(['instructor_id' => $instructor]);
        $section = Section::create(['course_id' => $course->id, 'title' => 'Chương', 'position' => 1]);
        $lesson = Lesson::create(['section_id' => $section->id, 'title' => 'Video', 'type' => 'video', 'video_path' => 'lessons/videos/old.mp4', 'position' => 1]);
        Storage::disk('public')->put($lesson->video_path, 'video');
        $this->actingAs($instructor)->delete(route('instructor.lessons.destroy', $lesson))->assertRedirect(route('instructor.courses.show', $course));
        Storage::disk('public')->assertMissing('lessons/videos/old.mp4');
    }
}
