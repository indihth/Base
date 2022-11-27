<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Tvshow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actor::factory()
        ->times(5)
        ->create();

        foreach(Tvshow::all() as $tvshow) 
        {
            $actors = Actor::inRandomOrder()->take(rand(1,5))->pluck('id');
            $tvshow->actors()->attach($actors);
        }
    }
}
