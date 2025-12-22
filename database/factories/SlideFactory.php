<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slide>
 */
class SlideFactory extends Factory
{
    public function definition(): array
    {
        return [
            'image_url' => '/uploads/' . $this->faker->lexify('slide-????????') . '.jpg',
            'active' => $this->faker->boolean(95),
        ];
    }
}
