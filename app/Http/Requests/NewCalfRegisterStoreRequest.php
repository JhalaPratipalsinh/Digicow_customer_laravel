<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewCalfRegisterStoreRequest extends FormRequest
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
            'breed_id' => [
                'required',
            ],
            'calf_name' => [
                'required',
            ],
            // 'mobile_number' => [
            //     'required',
            // ],
            'sex' => [
                'required'
            ],
            'calf_weight' => [
                'required'
            ]
        ];
    }
}
