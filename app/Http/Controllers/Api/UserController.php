<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 4)->get();
        return   UserResource::collection($users);
    }

    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $data=$request->validate([
            'name' => 'required|string|min:3',
            'email' => ['required','email',Rule::unique('users')->ignore($user->id)],
            'date_of_birth' => 'required|date',
            'national_id' => ['required','digits_between:14,14',Rule::unique('users')->ignore($user->id)],
        ]);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'national_id' => $data['national_id'],
            'date_of_birth' =>$data['date_of_birth'],
        ]);
        $response=[
            'message'=>'data updated successfully',
            'user'=>$user,
        ];
        return response($response);

    }

}
