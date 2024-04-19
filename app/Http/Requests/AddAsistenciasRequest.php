<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAsistenciasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_curso' => 'required|string|max:255',
            'id_alumno' => 'required|array',
            'id_alumno.*' => 'required|string|max:255',
            'id_user' => 'nullable|string|max:255',
            'estado' => 'required|array',
            'estado.*' => 'required|string|max:255',
            'fecha' => 'required|date',
        ];
    }

    public function attributes()
    {
        return [
            'id_curso' => 'curso',
            'fecha' => 'fecha',
        ];
    }

    public function messages()
    {
        return [
            'id_curso.required' => 'El campo :attribute es obligatorio.',
            'fecha.required' => 'El campo :attribute es obligatorio.',
        ];
    }
}
