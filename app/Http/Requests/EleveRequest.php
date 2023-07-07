<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EleveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'Nom' => 'bail|required|between:4,250|alpha',
            'Prenom' => 'bail|required|between:4,250|alpha',
            'dateNaiss' => 'bail|required|date|before:today-4years',
            'LieuNaiss'=>'bail|required|max:250|alpha',
            'sexe'=>'bail|required|in:mas,fem',
            'profile'=>'bail|required|in:0,1'
        ];
    }
}
