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
            'release_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),  // Formatting date
            'title' => $this->faker->word,
            'description' => $this->faker->text($maxNbChars = 250),             // 250 characters of text
            'director' => $this->faker->name,
            'rating' => $this->faker->numberBetween($min = 1, $max = 5),        // Rating 1-5 stars
            'difficulty' => $this->faker->numberBetween($min = 1, $max = 10),   // Rating 1-10 stars

        ];
    }
}
