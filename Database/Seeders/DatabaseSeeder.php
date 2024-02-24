<?php


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Campaign;
use App\Models\Step;
use App\Models\StepField;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create 5 campaigns
       Campaign::factory(5)
            ->has(
                Step::factory()
                    ->count(rand(2, 5)) // Each campaign will have 2 to 5 steps
                    ->has(StepField::factory()->count(rand(3, 7)), 'fields'), // Each step will have 3 to 7 step fields
                'steps'
            )
            ->create()
            ->each(function ($campaign) {
                // For each campaign, create a random number of participations (1 to 10)
               Participation::factory(rand(1, 10))->create([
                    'campaign_id' => $campaign->id, // Associate the participation with the current campaign
                    // The 'data' field is already being randomly filled by the factory definition
                ]);
            });
    }
}