<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required|100',
            'email' => 'nullable|50',
            'phone' => 'nullable|50',
            'address' => 'nullable|150',
            'town_city' => 'nullable|50',
            'region_county' => 'nullable|50',
            'country_code' => 'nullable|2',
            'post_code' => 'nullable|25',
        ];
    }
}
