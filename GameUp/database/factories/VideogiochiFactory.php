<?php

namespace Database\Factories;

use App\Models\Contenuti;
use App\Models\Videogiochi;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideogiochiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Videogiochi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => function() {
                return Contenuti::factory()->create()->id;
            },
            'logo' => 'uploads/loghi/' . $this->faker->image(storage_path('app/uploads/loghi'), 128, 128, null, false),
            'autore_id' => 1,
            'titolo' => $this->faker->word(),
            'descrizione' => $this->faker->paragraph(),
            'prezzo' => $this->faker->randomFloat(2, 0, 100),
            'data_pubblicazione' => $this->faker->date(),
            'created_at' => $this->faker->datetime(),
            'updated_at' => $this->faker->datetime()
        ];
    }
}
