<?php

namespace Database\Factories;

use App\Models\Participation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Participation>
 */
class ParticipationFactory extends Factory
{
    protected $model = Participation::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'salutation' => $this->faker->randomElement(['Mr.', 'Ms.', 'Mrs.', 'Dr.']),
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date('Y-m-d', '-18 years'),
            'phone' => $this->faker->phoneNumber,
            'street' => $this->faker->streetAddress,
            'postal_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'campaign_id' => Campaign::factory(),

        ];
    }
}
