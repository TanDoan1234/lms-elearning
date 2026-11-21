<?php

namespace Tests\Feature\Ui;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

class CourseImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_data_science_category_uses_data_photo_not_database_photo(): void
    {
        $this->assertStringContainsString('category-data.jpg', $this->renderCover('khoa-hoc-du-lieu', 'Khoa học dữ liệu'));
        $this->assertStringContainsString('category-database.jpg', $this->renderCover('co-so-du-lieu', 'Cơ sở dữ liệu'));
    }

    private function renderCover(string $slug, string $name): string
    {
        $course = Course::factory()->create(['category_id' => Category::factory()->create(['slug' => $slug, 'name' => $name])->id, 'thumbnail' => null]);

        return Blade::render('<x-course-image :course="$course" />', ['course' => $course->load('category')]);
    }
}
