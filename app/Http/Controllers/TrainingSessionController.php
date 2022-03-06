<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Coach;
use App\Models\CoachSession;
use Illuminate\Support\Carbon;
use App\Models\TrainingSession;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\TrainingSessionRequest;
use App\Http\Requests\StoreTrainingSessionRequest;
use App\Models\Gym;

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
        Paginator::useBootstrapFive();
        $sessions = TrainingSession::paginate(10);


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
        $gyms = Gym::all();
        return view(
            'sessions.create',
            [
                'sessions' => $sessions,
                'coaches' => $coaches,
                'gyms' => $gyms
            ]
        );
    }


    public function store(TrainingSessionRequest $request)
    {
        $requestedData = request()->all();




        if ($this->checkSessionTime($requestedData)) {

            $session =  TrainingSession::create($requestedData);
            foreach ($requestedData['coach_id'] as $coach) {
                CoachSession::create(
                    array(
                        'training_session_id' => $session['id'],
                        'coach_id' => $coach,
                    )

                );
            }
            return redirect()->route('sessions.index');
        } else {
            return redirect()->route('sessions.create');
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

    public function checkSessionTime($requestedData)
    {

        $sessions = TrainingSession::all();
        $start = $requestedData['started_at'];
        $end = $requestedData['finished_at'];
        foreach ($sessions as $session) {

            $oldStart = $session->started_at;
            $oldEnd = $session->finished_at;
            if (


                ($this->betweenForStart($start, $oldStart, $oldEnd) &&
                    $this->betweenForEdnd($end, $oldStart, $oldEnd))

                &&

                ($this->betweenForStart($oldStart, $start, $end)
                    && $this->betweenForEdnd($oldEnd, $start, $end))


            ) {

                return false;
            } else return true;
        }
    }

    public function betweenForStart($start, $oldstart, $oldend)
    {
        return $start >= $oldstart && $start < $oldend;
    }

    public function betweenForEdnd($end, $oldstart, $oldend)
    {
        return $end > $oldstart && $end <= $oldend;
    }
}
