<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class rpodeditRequest extends FormRequest
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
        $rules = [
            'mes' => [
                'required',
                'distinct',
                'integer',
                'min : 1',
                'max : 12',
            ],
            'horas_mes' => [
                'required',
                'integer',
                'min : 0',
            ],
        ];

        return $rules;
    }
}
