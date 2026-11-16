<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<Course> */ class CourseFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->randomElement([
            'Laravel thực hành cho sinh viên', 'PHP hướng đối tượng căn bản', 'JavaScript và DOM',
            'Thiết kế cơ sở dữ liệu quan hệ', 'Kiểm thử ứng dụng Web', 'Xây dựng REST API',
        ]);

        return ['instructor_id' => User::factory()->state(['role' => 'instructor']), 'category_id' => Category::factory(), 'title' => $title, 'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(1, 9999), 'short_description' => "Khóa học $title với bài giảng và thực hành theo dự án.", 'description' => 'Nội dung được thiết kế cho sinh viên công nghệ thông tin, kết hợp kiến thức nền tảng, ví dụ minh họa và bài tập thực hành.', 'price' => fake()->randomElement([0, 299000, 499000, 799000]), 'level' => fake()->randomElement(['beginner', 'intermediate', 'advanced']), 'status' => 'published'];
    }
}
