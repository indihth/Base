<?php

namespace Database\Seeders;

use App\Models\tvshow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TvshowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // defines how many rows of data will be created by the factory
        tvshow::factory()->times(50)->create();
    }
}
