<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'photo'=>['max:5000'],
            'nom' => ['required', 'string', 'max:255'],
            'postnom' => ['required', 'string', 'max:255'],
            'sexe' => ['required'],
            'etat_civil' => ['required'],
            'paroisses_id' => ['required'],
            'departement_id' => ['required'],
            'qualite_id' => ['required'],
            'groupe_utilisateur_id' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'telephone' => ['required', 'max:10', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
