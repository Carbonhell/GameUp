<?php

namespace Database\Factories;

use App\Models\Contenuti;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContenutiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contenuti::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'visibile' => $this->faker->boolean(90)
        ];
    }
}
