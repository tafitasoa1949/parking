<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'montant' => 'required|min:1',
            'date' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'montant.required' => 'Le champ montant est obligatoire.',
            'montant.min' => 'Le champ montant doit etre superieure à 1.',
            'date.required' => 'Le champ date est obligatoire.'
        ];
    }
}
