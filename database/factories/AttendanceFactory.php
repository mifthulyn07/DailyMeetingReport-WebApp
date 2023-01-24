<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => fake()->numberBetween(1, 50),
            'date' => fake()->dateTimeBetween('2023-01-01', '2023-12-31'),
            'clockin' => fake()->dateTimeBetween('07:30:00', '08:30:00'),
            'desc_clockin' => fake()->sentence(), 
            'status_clockin' => fake()->randomElement(['present', 'absence']),
            'lateness_clockin' => fake()->time(),
            'clockout' => fake()->dateTimeBetween('16:15:00', '17:15:00'),
            'desc_clockout' => fake()->sentence(),
            'status_clockout' => fake()->randomElement(['present', 'absence']),
            'lateness_clockout' => fake()->time(),
        ];
    }
}
