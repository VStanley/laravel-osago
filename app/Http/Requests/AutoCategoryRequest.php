<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutoCategoryRequest extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'price.numeric' => 'Только гребаные цифры',
            'price.required' => 'Цена не должна быть пустой'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price' => 'required|numeric'
        ];
    }
}
