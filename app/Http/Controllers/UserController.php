<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\GymManager;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id', 4)->get();

        return view('users.index', data: [
            'users' => $users,
        ]);
    }
    public function getUsers()
    {
        if (request()->ajax()) {

            $users = User::where('role_id', 4)->get();



            return DataTables::of($users)
                ->addIndexColumn()


                ->addColumn('name',function($row){
                    return $row->name;
                })
                ->addColumn('email',function($row){
                    return $row->email;
                })
                ->addColumn('national_id',function($row){
                    return $row->national_id;
                })



                ->addColumn('action', function($row){


                    $edit='<a href="'. route('users.edit', $row->id) .'" class="btn btn-primary">Update</a>';


                    $delete='
                     <form action="'.route('users.destroy', $row->id).'" method="post">

                            <button class="btn btn-danger" type="submit">
                                Delete
                            </button>
                        </form>
                    ';

                    return $edit . ' ' . $delete;

                })

                ->make(true);
        }
        return view('users.datatable');
//        return datatables()->of(Gym::with('city'))->toJson();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //fetch request data
        $request = request()->all();

        // $image = $request->img;



        //move uploaded image
        $img = $request['profileImg'];
        $imageName = time() . rand(1, 200) . '.' . $img->extension();

        $img->move(public_path('imgs//' . 'client'), $imageName);


        // store new data into data base
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['passwd']),
            'national_id' => $request['nationalId'],
            'profile_img' => $imageName,
            'date_of_birth' => $request['date_of_birth'],
            'gender' => $request['gender'],
            'role_type' => 'client',
            'role_id' => 4,
        ]);

        //redirection to posts.index
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($userId)
    {
        $user = User::find($userId);
        return view("users.edit", ['user' => $user,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        User::find($id)->update($request->all());
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $userId)
    {
        User::find($userId)->delete($request->all());
        return redirect()->route('users.index');
    }
}
