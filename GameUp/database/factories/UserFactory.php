<?php

namespace Database\Factories;

use App\Data\Utenza;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->word(),
            'password' => \Hash::make($this->faker->word),
            'email' => $this->faker->email,
            'avatar' => 'storage/uploads/avatars/' . $this->faker->image(
                    storage_path('app/public/uploads/avatars'),
                    128,
                    128,
                    null,
                    false
                ),
            'ruolo' => $this->faker->randomElement([Utenza::ROLE_CLIENT, Utenza::ROLE_DEVELOPER]),
            'created_at' => $this->faker->datetime(),
            'updated_at' => $this->faker->datetime()
        ];
    }
}
