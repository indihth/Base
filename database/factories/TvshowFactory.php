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

            // Using Faker to copy random files from the source directory to the target one and return just the file name
            // The file path can be returned by ommiting the 'false' as the 3rd parameter
            'image' => $this->faker->file($sourceDir = 'public/images/default/', $targetDir = 'public/storage/images', false)
        ];

    }

}
