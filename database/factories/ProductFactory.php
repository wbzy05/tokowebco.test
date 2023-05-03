<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
    */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'product_categories_id' => fake()->numberBetween(1, 10),
            'name' => fake()->name(),
            'price' => fake()->randomNumber(5, true),
            'image' => Str::random(30) . '.jpg',
            'created_by' => fake()->numberBetween(1, 15)
        ];
    }
}
