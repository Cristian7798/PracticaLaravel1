<?php

namespace Database\Factories\Model;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "price" => $this->faker->randomFloat(2, 2, 3),
            "stock" => $this->faker->randomNumber(2, 100),
        ];
    }
}
