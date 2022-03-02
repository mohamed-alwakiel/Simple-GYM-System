<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|email',
            'nationalId' => 'required|numeric|min:1',
            'date_of_birth' => 'required|date',
        ];
    }
}
