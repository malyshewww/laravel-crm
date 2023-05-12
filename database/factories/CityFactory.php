<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = City::class;
    public function definition()
    {
        return [
            'name' => 'Afghanistan'
        ];
    }
}
