<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url' => $this->faker->imageUrl(400, 300, 'animals', true),
            'imageable_id' => null, 
            'imageable_type' => null, 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
