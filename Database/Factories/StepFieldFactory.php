<?php

namespace Database\Factories;

use App\Models\Step;
use App\Models\StepField;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StepField>
 */
class StepFieldFactory extends Factory
{
    protected $model = StepField::class;

    public function definition()
    {
        return [
            'step_id' => \App\Models\Step::factory(), // Automatically creates a Step (and thus a Campaign)
            'input' => $this->faker->randomElement(StepField::getAvailableInputs()), // Select a random input from the list
        ];
    }
}
