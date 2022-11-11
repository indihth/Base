<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tvshow>
 */
class TvshowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => '1',
            'uuid' => $this->faker->uuid,
            'release_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),      // Formatting date
            'title' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),   // Creates 2 words
            'description' => $this->faker->text($maxNbChars = 400),                     // 250 characters of text
            'director' => $this->faker->name,
            'rating' => $this->faker->numberBetween($min = 1, $max = 5),                // Rating 1-5 stars
            'difficulty' => $this->faker->numberBetween($min = 1, $max = 10),           // Rating 1-10 stars

            // Seed images from storage folder
            // https://kodementor.com/how-to-seeds-images-with-faker-in-laravel/

        ];
    }
}
