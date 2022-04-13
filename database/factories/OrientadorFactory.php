<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orientador>
 */
class OrientadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $cursos = ['CC', 'ES'];
        return [
            //
            'nome' => $this->faker->name(),
            'curso' => $cursos[array_rand($cursos)],
            'email' => $this->faker->email()
        ];
    }
}
