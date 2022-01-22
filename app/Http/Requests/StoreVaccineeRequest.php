<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVaccineeRequest extends FormRequest
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
            'pwd' => 'boolean',
            'indigenous_member' => 'boolean',
            'last_name' => 'required|max:50',
            'first_name' => 'required|max:50',
            'middle_name' => 'nullable|max:50',
            'suffix' => "nullable|in: '',I,II,III,IV,JR,SR",
            'birthdate' => 'required|date',
            'sex' => 'required|in:M,F',
            'municipality' => 'required',
            'barangay' => 'required',
            'mobile_number' => 'required|max:11|min:11', //number validation
            // 'occupation' => 'nullable',
        ];
    }
}
