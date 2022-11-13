<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    ///////////////////////////////////////
    // I tried seeding users but ran into problems, I think because off having 
    // installed Breeze already which added a lot of functionality which clashes 
    // with directly adding users into the database
    ///////////////////////////////////////

    public function definition()
    {
        // return [
        //     'name' => $this->faker->userName,       
        //     'email' => $this->faker->safeEmail,     // generates an @example.com email
        //     'password' => bcrypt('password'),       // generates a bcrypted (hashed) password
        // ];
    }
}
