<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            // validate data from user
            'name' => 'required|max:50|min:3',
            'email' => 'required|unique:users|email',
            'national_id' => 'required|unique:users|digits_between:14,14',
            'passwd' => 'required|min:6|max:20',
            'confirmPassword' => 'required|same:passwd',
            'profileImg' => 'image|mimes:jpg,jpeg',
            'date_of_birth' => 'required|date',
            'gym_id' =>'exists:gyms,id',
            'city_id' =>'exists:cities,id',
        ];
    }


}
