<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test>
 */
class TestFactory extends Factory
{
    public function definition()
    {
        return [
            'lesson_id' => Lesson::inRandomOrder()->first()->id, // Привязка к случайному уроку
            'content' => $this->faker->sentence, // Генерация случайного содержимого теста
        ];
    }
}
