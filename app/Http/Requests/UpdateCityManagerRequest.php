<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCityManagerRequest extends FormRequest
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
        $mgrID = $this->request->get("id");

        return [
            'name' => ['required', 'string', 'min:4'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $mgrID],
            'national_id' => ['required', 'min:14', 'max:14', 'unique:users,national_id,' . $mgrID]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()      
    {
        return [
            'natioal_id.min' => 'national ID must be 14 digits',
            'natioal_id.max' => 'national ID must be 14 digits',
        ];
    }
}
