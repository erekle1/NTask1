<?php

namespace Database\Factories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Campaign::class;


    public function definition()
    {
        return [
            'title'    => $this->faker->sentence,
            'end_date' => $this->faker->dateTimeBetween('+30 days', '+60 days'),
            'uuid'     => Str::uuid(),
        ];
    }
}
