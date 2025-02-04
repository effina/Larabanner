<?php

namespace effina\Larabanner\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use effina\Larabanner\Models\Larabanner;

class LarabannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Larabanner::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'contents' => $this->faker->randomHtml(),
            'display_days' => $this->faker->randomElements(['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'],
                $this->faker->numberBetween(1, 7)),
            'display_start_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'display_stop_date' => $this->faker->optional(0.7)->dateTimeBetween('+1 month', '+2 months'),
        ];
    }

    /**
     * Indicate that the banner is currently active.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function active(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'display_start_date' => now()->subDay(),
                'display_stop_date' => now()->addDays(7),
            ];
        });
    }

    /**
     * Indicate that the banner has expired.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function expired(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'display_start_date' => now()->subDays(14),
                'display_stop_date' => now()->subDay(),
            ];
        });
    }
}
