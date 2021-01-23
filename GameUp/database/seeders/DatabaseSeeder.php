<?php

namespace Database\Seeders;

use App\Models\Videogiochi;
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
        $this->call(
            [
                VideogiochiSeeder::class
            ]
        );
    }
}
