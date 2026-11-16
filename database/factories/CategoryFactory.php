<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @extends Factory<Category> */ class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement(['Lập trình Web', 'Cơ sở dữ liệu', 'Khoa học dữ liệu', 'Mạng máy tính', 'An toàn thông tin', 'Phát triển phần mềm']);

        return ['name' => $name, 'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(1, 9999), 'description' => "Các khóa học thực hành thuộc lĩnh vực $name."];
    }
}
