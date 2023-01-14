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
            'id' => time(),
            'name' => $this->faker->name(),
            'alamat' => $this->faker->streetAddress(),
            'no_telp' => $this->faker->phoneNumber(),
            'status' => $rand ? "Active" : "Non-Active",
            'kode_mesin' => "",
            'id_user' => $rand ? "123456" : "",
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
