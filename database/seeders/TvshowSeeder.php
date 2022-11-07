<?php

namespace Database\Seeders;

use App\Models\Tvshow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TvshowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Defines how many rows of data the factory will create
        Tvshow::factory()->times(20)->create();
    }
}
