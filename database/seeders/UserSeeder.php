<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    ///////////////////////////////////////
    // I tried seeding users but ran into problems, I think because off having 
    // installed Breeze already which added a lot of functionality which clashes 
    // with directly adding users into the database
    ///////////////////////////////////////

    // public function run()
    // {
    //     // Defines how many rows of data the factory will create
    //     UserSeeder::factory()->times(20)->create();
    // }
}
