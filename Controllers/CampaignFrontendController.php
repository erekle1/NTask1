<?php


namespace App\Http\Controllers;

use App\Http\Requests\CampaignStepSubmissionRequest;
use App\Models\Participation;
use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignFrontendController extends Controller
{
    /**
     * Displays the template file for a given campaign step
     * based on current step id stored in session
     */

    protected $participationRepository;

    public function __construct(ParticipationRepository $participationRepository)
    {
        $this->participationRepository = $participationRepository;
    }


    public function display(Request $request, Campaign $campaign)
    {

        // Check if campaign has ended
        if ($campaign->end_date < now()) {
            return view('campaigns.expired'); // Assuming you have an expired.blade.php view
        }

        $currentStep = session('currentStep', 1);
        $step = $campaign->steps()->where('order_num', $currentStep)->firstOrFail();

        // Store current step in session for later use
        session(['currentStep' => $currentStep]);

        return view('campaigns.steps.' . $step->fileName, ['campaign_title' => $campaign->title]);
    }

    /**
     * Handles submit of form on campaign steps
     * validates input based on StepFields
     * stores data in Participation (enrich if not the first step)
     */
    public function submit(CampaignStepSubmissionRequest $request, Campaign $campaign)
    {
        $currentStep = session('currentStep', 1);

        // Retrieve or create Participation based on session data or create a new one
        $participation = $this->participationRepository->getOrCreateParticipation($request, $campaign);

        // Store current step data in Participation
        $this->participationRepository->storeStepData($participation, $request->validated());

        // Check if there's a next step
        $nextStep = $campaign->steps()->where('order_num', '>', $currentStep)->first();

        if ($nextStep) {
            // Proceed to next step
            session(['currentStep' => $currentStep + 1]);
            return redirect()->route('campaign.display', $campaign->uuid);
        } else {
            // Final step: Complete the participation process
            session()->forget(['currentStep', 'participationData', 'participationId']);
            return view('campaigns.complete'); // Assuming you have a complete.blade.php view
        }
    }
}
