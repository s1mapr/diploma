<?php

namespace Database\Factories;

use App\Models\Teacher;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    public function definition()
    {
        return [
            'teacher_id' => Teacher::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'image_url' => $this->faker->imageUrl(),
            'video_url' => $this->faker->url,
            'status' => $this->faker->numberBetween(1, 3),
            'type' => $this->faker->numberBetween(1, 2),
            'connection_code' => Str::random(8),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
