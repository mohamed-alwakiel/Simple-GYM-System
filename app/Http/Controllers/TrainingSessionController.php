<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Gym;
use App\Models\City;
// use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Coach;
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

        $sessions = $this->getSessionsCoachesAndGymsData()[0];
        return view(
            'sessions.index',
            [
                'sessions' => $sessions,
            ]
        );
    }

    public function create()
    {


        $sessions = $this->getSessionsCoachesAndGymsData()[0];
        $coaches = $this->getSessionsCoachesAndGymsData()[1];
        $gyms = $this->getSessionsCoachesAndGymsData()[2];



        return view(
            'sessions.create',
            [
                'sessions' => $sessions,
                'coaches' => $coaches,
                'gyms' => $gyms,
            ]
        );
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

    public function update($id)
    {
        $formDAta = request()->all();


        $start=$formDAta['started_at'];
        $end=$formDAta['finished_at'];
       $checkOverlap= $this->CheckOverlap($start,$end);

    if ($checkOverlap==0) {
        $session = TrainingSession::find($id)->update($formDAta);

        return redirect()->route('sessions.index');
    } else {
        return back()->with('error', 'Session date will Overlap another session, Choose different Date');
    }

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

    public function store(TrainingSessionRequest $request)
    {

            $start=$request['started_at'];
            $end=$request['finished_at'];
           $checkOverlap= $this->CheckOverlap($start,$end);

        if ($checkOverlap==0) {
            $requestedData =
                [
                    'gym_id' => $request->gym_id,
                    'name' => $request->name,
                    'day' => $request->day,
                    'started_at' => $start,
                    'finished_at' => $end,
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

    public function getGymsBelongsToCity($id)
    {
        echo json_encode(DB::table('gyms')->where('city_id', $id)->get());
    }
// ========================> to retrieve data from database<=============================//

    public function getSessionsCoachesAndGymsData()
    {

        $roleAdmin = auth()->user()->hasRole('admin');
        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleGymManager = auth()->user()->hasRole('gymManager');



        if ($roleAdmin) {
            $sessions = TrainingSession::all();
            $coaches = Coach::all();
            $gyms = Gym::all();
        } elseif ($roleCityManager) {
            $sessions = Auth::user()->city->trainingSessions;
            $coaches = Auth::user()->city->coaches;
            $gyms = Auth::user()->city->gyms;
        } elseif ($roleGymManager) {
            $sessions = Auth::user()->gym->trainingSessions;
            $coaches = Auth::user()->gym->coaches;
            $gyms = Auth::user()->gym;
        }

        return [$sessions, $coaches, $gyms];
    }


// ========================> to check time overlap<=============================//
    public function CheckOverlap($start,$end)
    {


        $sessions = $this->getSessionsCoachesAndGymsData()[0];
        $start = date('Y-m-d H:i:s',strtotime($start));
        $end = date('Y-m-d H:i:s',strtotime($end));
        $errors=0;
        foreach ($sessions as $session) {
            $oldStart = date('Y-m-d H:i:s',strtotime($session->started_at));
            $oldEnd =  date('Y-m-d H:i:s',strtotime($session->finished_at));


            if (
                ($this->betweenForStart($start, $oldStart, $oldEnd)||
                $this->betweenForEdnd($end, $oldStart, $oldEnd))

                ||
                ($this->betweenForStart($oldStart, $start, $end)
                    || $this->betweenForEdnd($oldEnd, $start, $end))


            ) {
                $errors++;

            }
        }
            return $errors;




    }
    function betweenForStart($start, $oldstart, $oldend)
    {
        return $start >= $oldstart && $start < $oldend;
    }

    function betweenForEdnd($end, $oldstart, $oldend)
    {
        return $end > $oldstart && $end <= $oldend;
    }
}
