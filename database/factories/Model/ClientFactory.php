<?php

namespace Database\Factories\Model;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            "identification_number" => $this->faker->unique()->randomNumber(6),
        ];
    }
}
