<?php


use App\Models\Participation;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{

    public function index()
    {
        $participations = Participation::latest()->paginate(20);
        // Return view with participations
        return view('participations.index', compact('participations'));
    }

}
