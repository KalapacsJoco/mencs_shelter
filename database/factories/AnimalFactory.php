<?php

namespace Database\Factories;

use App\Models\Animal;
use App\Models\Breed;
use App\Models\Image;
use App\Models\Shelter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    protected $model = Animal::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $breed = Breed::inRandomOrder()->first();
        return [
            'name' => $this->faker->firstName(),
            'age' => $this->faker->numberBetween(1, 10),
            'color' => $this->faker->randomElement(['white', 'black', 'brown', 'yellow', 'mixed', 'green']),
            'sex' => $this->faker->randomElement(['male', 'female']),
            'status' => 'available',
            'vaccines' => null,
            'message' => $this->faker->sentence(),
            'shelter_id' => Shelter::inRandomOrder()->first()->id ?? 1,
            'species_id' => $breed->species_id,
            'breed_id' => $breed->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * This method will generate the pictures after the factory has created the random animals
     */

     public function configure()
     {
         return $this->afterCreating(function (Animal $animal) {
             \App\Models\Image::factory(rand(1, 3))
                 ->for($animal, 'imageable')
                 ->create();
         });
     }
}
