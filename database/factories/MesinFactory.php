<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rand = rand(1,2);
        return [
            'kode_mesin' => $this->faker->uniqid("mesin"),
            'name' => $this->faker->name(),
            'status' => $rand ? "Active" : "Rusak",
            'keterangan' => $this->faker->sentence,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
