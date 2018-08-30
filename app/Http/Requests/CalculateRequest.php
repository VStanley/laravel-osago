<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateRequest extends FormRequest
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
            'location.required' => 'Выберите место проживания',
            'region.required' => 'Выберите регион',
            'autoCategory.required'  => 'Выберите категорию авто',
            'autoPower.required'  => 'Выберите мощность авто',
            'usePeriod.required'  => 'Выберите период использования',
            'bonusSmall.required'  => 'Выберите коэффициент бонус-малус',

            'ageDriver.required'  => 'Введите возраст водителя',
            'experienceDriver.required'  => 'Введите стаж водителя',

            'ageDriver1.required'  => 'Введите возраст водителя',
            'experienceDriver1.required'  => 'Введите стаж водителя',

            'ageDriver2.required'  => 'Введите возраст водителя',
            'experienceDriver2.required'  => 'Введите стаж водителя',
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
            'location' => 'required',
            'region' => 'required',
            'autoCategory' => 'required',
            'autoPower' => 'required',
            'usePeriod' => 'required',
            'bonusSmall' => 'required',

            //            1водитель
            'ageDriver' => 'sometimes|required|numeric',
            'experienceDriver' => 'sometimes|required|numeric',

            //            2водитель
            'ageDriver1' => 'sometimes|required|numeric',
            'experienceDriver1' => 'sometimes|required|numeric',
            'bonusSmall1' => 'sometimes|required',

            //            3водитель
            'ageDriver2' => 'sometimes|required|numeric',
            'experienceDriver2' => 'sometimes|required|numeric',
            'bonusSmall2' => 'sometimes|required',
        ];
    }
}
