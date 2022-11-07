<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tvshows>
 */
class TvshowsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Defining what type data will be created using the faker library
        return [
            'uuid' => $this->faker->uuid,
            'release_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),  // Formatting date
            'title' => $this->faker->word,
            'director' => $this->faker->name,
            'rating' => $this->faker->numberBetween($min = 1, $max = 5),        // Rating 1-5 stars
            'difficulty' => $this->faker->numberBetween($min = 1, $max = 10),   // Rating 1-10 stars
        ];
    }
}
