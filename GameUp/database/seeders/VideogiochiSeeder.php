<?php

namespace Database\Seeders;

use App\Models\Contenuti;
use App\Models\Videogiochi;
use Illuminate\Database\Seeder;

class VideogiochiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Videogiochi::factory()
            ->count(10)
            ->create();
    }
}
