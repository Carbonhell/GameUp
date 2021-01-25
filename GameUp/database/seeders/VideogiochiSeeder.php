<?php

namespace Database\Seeders;

use App\Models\Tags;
use App\Models\Videogiochi;
use App\Models\VideogiochiImmagini;
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
            ->count(5)
            ->has(VideogiochiImmagini::factory()->count(3), 'immagini')
            ->has(Tags::factory()->count(3))
            ->create();
    }
}
