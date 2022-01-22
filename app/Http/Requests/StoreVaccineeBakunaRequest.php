<?php

namespace App\Http\Requests;

use App\Models\Bakuna;
use App\Models\LotNumber;
use App\Models\Vaccinator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVaccineeBakunaRequest extends FormRequest
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
        $categories = array_values(Bakuna::CATEGORIES);
        // $vaccinators = Vaccinator::where('is_active', 1)->pluck('id')->toArray();
        $vaccinators = Vaccinator::all()->pluck('id')->toArray();
        $manufacturers = array_values(Bakuna::VACCINE_MANUFACTURER_NAMES);
        $lot_numbers = LotNumber::all()->pluck('code')->toArray();
        return [
            'category' => ['required', Rule::in($categories)],
            'philhealth_num' => 'nullable',
            'contact' => 'nullable',
            'guardian_pedia' => 'required_if:category,PA3,ROPP',
            'is_comorbidity' => 'boolean',
            'comorbidity' => 'required_if:is_comorbidity,1',
            'vaccination_date' => 'required|date',
            'vaccinator_id' => ['required', Rule::in($vaccinators)],
            'vaccine_shot' => 'required|in:1,2,3',
            'manufacturer_name' => ['required', Rule::in($manufacturers)],
            'lot_number_id' =>['required', Rule::in($lot_numbers)],
            // 'batch_number' => 'required',
            'remarks' => 'nullable',
        ];
    }
}
