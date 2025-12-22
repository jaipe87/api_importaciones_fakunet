<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->bothify('PRD-####')), 
            'name' => $this->faker->words(3, true),
            'brand_id' => fn () => Brand::factory()->create()->id,
            'category_id' => fn () => Category::factory()->create()->id,
            'description' => $this->faker->optional()->paragraphs(2, true),
            'features' => [
                'color' => $this->faker->safeColorName(),
                'size' => $this->faker->randomElement(['S','M','L']),
            ],
            'stock' => (string) $this->faker->numberBetween(0, 1000),
            'image_url' => $this->faker->optional()->imageUrl(640, 480, 'products', true),
            // 'status' se omite para usar el default de DB
            'pdf_url' => $this->faker->optional()->url(),
        ];
    }
}
