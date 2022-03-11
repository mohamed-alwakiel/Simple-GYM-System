<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoachRequest extends FormRequest
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
        
        $id = request()->all()['id'] ?? '';

        $validation = [
            'name' => ['required', 'min:3'],
            'gym_id' => ['required'],

        ];


        return $validation;
    }
}
