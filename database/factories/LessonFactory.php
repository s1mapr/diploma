<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'estimation' => $this->faker->randomFloat(2, 1, 5), // Пример оценки
            'status' => $this->faker->numberBetween(1, 2), // Пример статуса
            'course_id' => Course::inRandomOrder()->first()->id, // Случайный курс
        ];
    }
}
