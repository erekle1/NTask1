<?php


namespace App\Repositories;

use App\Contracts\ParticipationRepositoryInterface;
use App\Http\Requests\CampaignStepSubmissionRequest;
use App\Models\Campaign;
use App\Models\Participation;
use App\Models\StepField;
use Illuminate\Support\Facades\Session;

class ParticipationRepository
{
    public function getOrCreateParticipation(CampaignStepSubmissionRequest $request, Campaign $campaign): Participation
    {
        $participationId = Session::get('participationId');

        if ($participationId) {
            return Participation::findOrFail($participationId);
        } else {
            $participation = new Participation();
            $participation->email = $request->email; // Assuming email is always present in the first step
            $participation->campaign_id = $campaign->id; // Assuming there's a relationship between Participation and Campaign
            $participation->save();

            // Store Participation ID in session for subsequent steps
            Session::put('participationId', $participation->id);

            return $participation;
        }
    }

    protected function storeStepData (Participation $participation, $request)
    {
        // List of all the fields to potentially update
        $fieldsToUpdate = StepField::getAvailableInputs();

        foreach ($fieldsToUpdate as $field) {
            // Check if the field is present in the request and if the current value in the model is null or empty
            if ($request->filled($field) && (is_null($participation->$field) || $participation->$field === '')) {
                $participation->$field = $request->$field;
            }
        }

        $participation->save();

    }



}

