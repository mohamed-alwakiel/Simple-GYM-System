<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
            'email' => ['required','email',Rule::unique('users')->ignore($this->id)],
            'national_id' => ['required','digits_between:14,14',Rule::unique('users')->ignore($this->id)],
            'date_of_birth' => 'required|date',
        ];
    }
}
