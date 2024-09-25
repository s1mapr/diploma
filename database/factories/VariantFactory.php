<?php

namespace Database\Factories;

use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variant>
 */
class VariantFactory extends Factory
{
    public function definition()
    {
        return [
            'test_id' => Test::inRandomOrder()->first()->id, // Привязка к случайному тесту
            'value' => $this->faker->sentence, // Генерация случайного варианта ответа
            'is_correct' => $this->faker->boolean, // Случайный выбор правильности ответа
        ];
    }
}
