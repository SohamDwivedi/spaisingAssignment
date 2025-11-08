<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'stock' => $this->faker->numberBetween(10, 100),
        ];
    }
}
