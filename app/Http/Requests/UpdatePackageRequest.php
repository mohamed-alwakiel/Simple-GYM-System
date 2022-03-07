<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price' =>'required | numeric',
            'number_of_sessions'=>'required | numeric'
        ];
    }

    public function messages()
    {
        return [
            'price.required' => 'price is required',
            'price.numeric' => 'price is number',
            'number_of_sessions.required' => 'number_of_sessions is required',
            'number_of_sessions.numeric' => 'number_of_sessions is number',

        ];
    }
}
