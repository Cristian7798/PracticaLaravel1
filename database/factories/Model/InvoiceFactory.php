<?php

namespace Database\Factories\Model;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "client_id" => rand(1, 5),
            "subtotal"  => $this->faker->randomFloat(2,2, 3),
            "tax"   => $this->faker->randomFloat(2,3, 3),
            "total" => $this->faker->randomFloat(2,2, 3),
        ];
    }
}
