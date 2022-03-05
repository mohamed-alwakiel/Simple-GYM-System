<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\CoachSession;
use Illuminate\Support\Carbon;
use App\Models\TrainingSession;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\TrainingSessionRequest;
use App\Http\Requests\StoreTrainingSessionRequest;

class TrainingSessionController extends Controller
{
    public function sessionDataTables() {


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

        return view(
            'sessions.create',
            [
                'sessions' => $sessions,
                'coaches' => $coaches
            ]
        );
    }


    public function store(TrainingSessionRequest $request)
    {
        $requestedData = request()->all();

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
    }


    // public function show($id)
    // {
    //     $sessions= TrainingSession::find($id);


    //     return view('$sessions.show', [
    //         '$sessions' => $sessions
    //     ]);
    // }


    public function edit($id)
    {
        $session = TrainingSession::find($id);

        return view('sessions.update', [
            'session' => $session
        ]);
    }

    public function update($id, TrainingSessionRequest $request)
    {
        $formDAta = request()->all();

        $session = TrainingSession::find($id)->update($formDAta);

        $session = TrainingSession::find($id)->update($formDAta);

        return redirect()->route('sessions.index');
    }


    public function destroy($id)
    {
        $session = TrainingSession::find($id);

        $session->delete();


        return redirect()->route('sessions.index');
    }
}
