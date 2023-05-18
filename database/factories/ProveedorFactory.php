<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proveedor>
 */
class ProveedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Proveedor::class;
    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'direccion' => $this->faker->sentence,
            'telefono' => $this->faker->sentence,
        ];
    }
}
