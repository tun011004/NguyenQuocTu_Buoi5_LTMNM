<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => ucfirst(fake()->words(2, true)),
            'price'       => fake()->numberBetween(10000, 500000),
            'category_id' => Category::factory(),
        ];
    }
}
