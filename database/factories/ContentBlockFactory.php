<?php

namespace Database\Factories;

use App\Enums\ContentTypes;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContentBlock>
 */
class ContentBlockFactory extends Factory
{
    public function definition()
    {
        $type = $this->faker->randomElement(ContentTypes::toValuesArray());

        $content = match ($type) {
            ContentTypes::TEXT->value => $this->faker->text(4000),
            ContentTypes::IMAGE->value => $this->faker->imageUrl(640, 480, 'cats'),
            ContentTypes::VIDEO->value => $this->faker->url,
        };

        return [
            'lesson_id' => Lesson::inRandomOrder()->first()->id,
            'content' => $content,
            'type' => $type,
        ];
    }
}
