<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeadCalfRegisterSroreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cow_id' => [
                'required',
            ],
            'death_date' => [
                'required',
            ],
            'cause_of_death' => [
                'required'
            ],
            'carcass_amount' => [
                'required'
            ]
        ];
    }
}
