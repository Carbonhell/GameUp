<?php

namespace Database\Factories;

use App\Models\Tags;
use App\Models\VideogiochiTags;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideogiochiTagsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VideogiochiTags::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tag_id' => Tags::factory()->create()->id,
            'created_at' => $this->faker->datetime(),
            'updated_at' => $this->faker->datetime()
        ];
    }
}
