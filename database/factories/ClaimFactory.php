<?php

namespace Database\Factories;

use App\Models\Claim;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClaimFactory extends Factory
{
    protected $model = Claim::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date_start' => $this->faker->date,
            'date_end' => $this->faker->dateTimeBetween($date_start = '-30 days', $date_end = 'now'),
            'comment' => $this->faker->text,
            // 'manager' => User::all()->random()->id
        ];
    }
}
