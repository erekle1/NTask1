<?php

namespace App\Http\Requests;

use App\Models\StepField;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Step;
use Carbon\Carbon;
use App\Models\Campaign;

class CampaignStepSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $campaign = $this->getCampaignFromRoute();
        $step = $this->getCurrentStep($campaign);

        return $this->generateValidationRulesForStep($step);
    }

    protected function getCampaignFromRoute()
    {
        $campaignUuid = $this->route('campaignUuid');
        return Campaign::where('uuid', $campaignUuid)->firstOrFail();
    }

    protected function getCurrentStep(Campaign $campaign)
    {
        $currentStep = session('currentStep', 1);
        return $campaign->steps()->where('order_num', $currentStep)->firstOrFail();
    }

    protected function generateValidationRulesForStep(Step $step)
    {
        $currentStep = session('currentStep', 1);

        // Retrieve available inputs from the StepField model
        $availableInputs = StepField::getAvailableInputs();

        // Filter step fields to include only those available in the predefined array
        $filteredFields = $step->fields->whereIn('input', $availableInputs);

        // Generate validation rules for the filtered fields
        return $filteredFields->pluck('input', 'input')->mapWithKeys(function ($input) use ($currentStep) {
            return $this->ruleForInput($input, $currentStep);
        })->toArray();
    }

    protected function ruleForInput($input, $currentStep)
    {
        if ($input === 'email' && $currentStep == 1) {
            return [$input => 'required|email'];
        } elseif ($input === 'date_of_birth') {
            return [$input => ['required', 'date', 'before:' . Carbon::now()->subYears(18)->toDateString()]];
        }

        return [$input => 'required'];
    }


    public function messages()
    {
        return [
            'date_of_birth.before' => 'You must be 18 years or older.',
        ];
    }


}
