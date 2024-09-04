<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
    public function definition()
    {
        return [
            'sku' => fake()->unique()->regexify('PROD-[0-9]{3}'),
            'nombre' => fake()->word,
            'tipo' => fake()->randomElement(['Grano', 'Legumbre', 'Aceite', 'Lácteo', 'Bebida']),
            'etiquetas' => implode(',', fake()->words(3)),
            'precio' => fake()->randomFloat(2, 1, 100),
            'unidad_medida' => fake()->randomElement(['kg', 'litro', 'unidad']),
            'created_at' => now(),
        ];
    }
}
