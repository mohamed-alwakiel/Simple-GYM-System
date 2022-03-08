<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\City;
use App\Models\Coach;
// use Illuminate\Support\Carbon;
use Spatie\Period\Period;
use App\Models\CoachSession;
use Illuminate\Http\Request;
use App\Models\TrainingSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Spatie\Period\PeriodCollections;
use App\Http\Requests\TrainingSessionRequest;
use App\Http\Requests\StoreTrainingSessionRequest;


class TrainingSessionController extends Controller
{
    public function sessionDataTables()
    {


        $sessions = TrainingSession::all();


        return view(
            'sessions.datatables',
            [
                'sessions' => $sessions,
            ]
        );
    }


    public function index()
    {

        $roleAdmin = auth()->user()->hasRole('admin');
        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleGymManager = auth()->user()->hasRole('gymManager');


        if($roleAdmin){
        Paginator::useBootstrapFive();
        $sessions = TrainingSession::paginate(10);
        }elseif($roleCityManager ){
            $sessions =Auth::user()->trainingSessions;
        }elseif($roleGymManager){
            $gym_id = Auth::user()->gym_id;
            $sessions = TrainingSession::find($gym_id);
        }

        return view(
            'sessions.index',
            [
                'sessions' => $sessions,
            ]
        );

    }

    public function create()
    {
        $sessions = TrainingSession::all();
        $coaches = Coach::all();
        $cities = DB::table("cities")->get();

        return view(
            'sessions.create',
            [
                'sessions' => $sessions,
                'coaches' => $coaches,
                'cities' => $cities,
            ]
        );
    }

    public function store(TrainingSessionRequest $request)
    {
        $started_at_date = explode('-', $request->started_at_date);
        $started_at_time = explode(':', $request->started_at_time);

        $finished_at_date = explode('-', $request->finished_at_date);
        $finished_at_time = explode(':', $request->finished_at_time);

        $started_at = Carbon::create((int)$started_at_date[0], (int)$started_at_date[1], (int)$started_at_date[2], (int)$started_at_time[0], (int)$started_at_time[1], 00);
        $finished_at = Carbon::create((int)$finished_at_date[0], (int)$finished_at_date[1], (int)$finished_at_date[2], (int)$finished_at_time[0], (int)$finished_at_time[1], 00);

        $selectedGym = $request->gym_id;

        $isSessionTimeValid = !($this->isSessionOverlap($started_at, $finished_at, $selectedGym));
        // dd($isSessionTimeValid);
        if ($isSessionTimeValid) {
            $requestedData =
                [
                    'gym_id' => $request->gym_id,
                    'name' => $request->name,
                    'day' => $request->day,
                    'started_at' => $started_at,
                    'finished_at' => $finished_at,
                ];

            $newSession =  TrainingSession::create($requestedData);
            foreach ($request->coach_id as $coach) {
                CoachSession::create(
                    array(
                        'training_session_id' => $newSession['id'],
                        'coach_id' => $coach,
                    )
                );
            }
            return redirect()->route('sessions.index');
        } else {
            return back()->with('error', 'Session date will Overlap another session, Choose different Date');
        }
    }

    public function edit($id)
    {
        $session = TrainingSession::find($id);
        $coaches = Coach::all();

        return view(
            'sessions.update',
            [
                'session' => $session,
                'coaches' => $coaches
            ]
        );
    }

    public function update($id, TrainingSessionRequest $request)
    {
        $formDAta = request()->all();

        $session = TrainingSession::find($id)->update($formDAta);

        $session = TrainingSession::find($id)->update($formDAta);
        $session = TrainingSession::find($id);

        $session->coaches()->sync($formDAta['coach_id']);
        return redirect()->route('sessions.index');
    }


    public function destroy($id)
    {


        $session = TrainingSession::find($id);
        $session->gyms()->dissociate();
        $session->coaches()->detach();
        $session->delete();


        return redirect()->route('sessions.index');
    }


    public function paginateFast(Request $request)
    {

        if ($request->ajax()) {
            Paginator::useBootstrapFive();
            $sessions = TrainingSession::paginate(10);

            return view(
                'sessions.index_child',
                [
                    'sessions' => $sessions,

                ]
            )->render();
        }
    }

    private function isSessionOverlap($started_at, $finished_at, $gym)
    {
        $newSessionTime = Period::make($started_at, $finished_at);
        // dd($newSessionTime);
        $gymSessions = TrainingSession::where('gym_id', $gym)->get();
        // dd($gymSessions);
        foreach ($gymSessions as $session) {
            // dd($session);
            $oldSession = Period::make(new Carbon($session->started_at), new Carbon($session->finished_at));
            // dd($newSessionTime,$oldSession);
            return $newSessionTime->overlapsWith($oldSession);
        }
        // dd('Nooooooooooooooo overlapssssss');
        return false;
    }

    public function getGymsBelongsToCity($id)
    {
        echo json_encode(DB::table('gyms')->where('city_id', $id)->get());
    }
}
