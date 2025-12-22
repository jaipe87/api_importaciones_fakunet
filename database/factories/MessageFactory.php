<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'firstName' => $this->faker->firstName(),
            'lastName' => $this->faker->lastName(),
            'phone' => $this->faker->numerify('+51 9########'),
            'email' => $this->faker->safeEmail(),
            'content' => $this->faker->paragraph(),
            'date' => $this->faker->dateTimeThisYear(),
            'read' => false,
        ];
    }
}
