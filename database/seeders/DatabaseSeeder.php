<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

        // Network seeder calls TvshowSeeder
        $this->call(NetworkSeeder::class);
        // $this->call(TvshowSeeder::class);
        
        // ActorSeeder calls Tvshowseeder itself so no need for both
        $this->call(ActorSeeder::class);
    }
}
