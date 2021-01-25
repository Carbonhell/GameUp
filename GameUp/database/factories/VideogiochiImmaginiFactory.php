<?php

namespace Database\Factories;

use App\Models\VideogiochiImmagini;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideogiochiImmaginiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VideogiochiImmagini::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'immagine' => 'storage/uploads/videogiochi_immagini/' . $this->faker->image(
                    storage_path('app/public/uploads/videogiochi_immagini'),
                    128,
                    128,
                    null,
                    false
                ),
            'created_at' => $this->faker->datetime(),
            'updated_at' => $this->faker->datetime()
        ];
    }
}
