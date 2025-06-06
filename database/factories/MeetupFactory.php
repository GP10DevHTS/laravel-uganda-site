<?php

namespace Database\Factories;

use App\Models\Meetup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetupFactory extends Factory
{
    protected $model = Meetup::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Associate with a user
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'date' => $this->faker->dateTimeBetween('+1 week', '+1 month')->format('Y-m-d'),
            'time' => $this->faker->time('H:i:s'),
            'location' => $this->faker->city,
            'image_url' => null, //$this->faker->imageUrl(),
            'event_url' => null, //$this->faker->url,
            'is_featured' => $this->faker->boolean(20), // 20% chance of being featured
        ];
    }
}
