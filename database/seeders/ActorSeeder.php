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

        // loops through each tv show and attaches an actor to each
        foreach(Tvshow::all() as $tvshow) 
        {
            // uses a random number between 1-5 to select an actor
            $actors = Actor::inRandomOrder()->take(rand(1,5))->pluck('id');

            // attaches that actor to a tvshow
            $tvshow->actors()->attach($actors);
        }
    }
}
