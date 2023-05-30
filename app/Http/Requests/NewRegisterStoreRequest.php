<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewRegisterStoreRequest extends FormRequest
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
            'title' => [
                'required',
            ],
            'group_id' => [
                'required'
            ],
            // 'mobile_number' => [
            //     'required',
            //     'numeric'
            // ],
            'date_of_birth' => [
                'required'
            ],
            'calving_lactation' => [
                'required'
            ]
        ];
    }
}
