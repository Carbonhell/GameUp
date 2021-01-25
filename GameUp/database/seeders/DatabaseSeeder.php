<?php

namespace Database\Seeders;

use App\Data\Utenza;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // generate root admin
        User::factory()
            ->create(
                [
                    'username' => 'admin',
                    'password' => \Hash::make('root'),
                    'ruolo' => Utenza::ROLE_ADMIN
                ]
            );
        $this->call(
            [
                VideogiochiSeeder::class
            ]
        );
    }
}
