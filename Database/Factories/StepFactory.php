<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Step;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Step>
 */
class StepFactory extends Factory
{
    protected $model = Step::class;

    public function definition()
    {
        return [
            'campaign_id' => Campaign::factory(), // This will automatically create a Campaign when a Step is generated
            'title'       => $this->faker->sentence,
            'order_num'   => $this->faker->unique()->numberBetween(1, 100),
            'fileName'    => $this->faker->word . '.blade.php',
        ];
    }
}
