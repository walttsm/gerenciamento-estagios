<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class registroCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'data_orientacao' => [
                'required',
            ],
            'assunto' => [
                'required',
            ],
            'prox_assunto' => [
                'required',
            ],
            'observacao' => [
                'required',
            ],
        ];

        return $rules;
    }
}
