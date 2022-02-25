<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
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
            'company_id' => ['nullable', Rule::exists('companies', 'id')],
            'first_name' => ['required', 'max:25'],
            'last_name' => ['required', 'max:25'],
            'email' => ['nullable', 'max:50'],
            'phone' => ['nullable', 'max:50'],
            'address' => ['nullable', 'max:150'],
            'town_city' => ['nullable', 'max:50'],
            'region_county' => ['nullable', 'max:50'],
            'country_code' => ['nullable', 'max:2'],
            'post_code' => ['nullable', 'max:25'],
        ];
    }
}
