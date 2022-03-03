<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Support\Carbon;
use App\Models\TrainingSession;
use App\Http\Requests\TrainingSessionRequest;
use App\Http\Requests\StoreTrainingSessionRequest;
use App\Http\Controllers\TrainingSessionController;
use App\Http\Requests\UpdateTrainingSessionRequest;

class TrainingSessionController extends Controller
{


    public function index()
    {
        $sessions = TrainingSession::all();


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

        // dd($requestedData);

        TrainingSession::create($requestedData);
        // CoachesSessions::create();

        return redirect()->route('sessions.index');
    }


    public function show($id)
    {
        $sessions = TrainingSession::find($id);


        return view('$sessions.show', [
            '$sessions' => $sessions
        ]);
    }


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

        return redirect()->route('sessions.index');
    }


    public function destroy($id)
    {
        $session = TrainingSession::find($id);

        $session->delete();


        return redirect()->route('sessions.index');
    }
}
