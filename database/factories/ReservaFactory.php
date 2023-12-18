<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserva>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "Cantidad_comensales"=>fake()->randomElement([1,2,3,4]),
            "Fecha"=>fake()->date(),
            "Horario"=>fake()->time(),
            "Email"=>fake()->address(),
            "LocalId"=>fake()->randomElement([1,2])
        ];
    }
}
