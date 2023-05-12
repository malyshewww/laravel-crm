<?php

namespace Database\Factories;

use App\Models\Claim;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    protected $model = Person::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_type' => 'person',
            'person_surname' => $this->faker->name(),
            'person_name' => $this->faker->name(),
            'person_patronymic' => $this->faker->title(),
            'claim_id' => Claim::get()->random()->id
        ];
    }
}
