<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingSessionRequest extends FormRequest
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
            'gym_id' => ['required'],
            'name' => ['required', 'min:3'],
            'day' => ['required'],
            'started_at_date' => ['required'],
            'started_at_time' => ['required'],
            'finished_at_date' => ['required'],
            'finished_at_time' => ['required'],
        ];


        return $validation;
    }
}
