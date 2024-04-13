<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAlumnoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'id_apoderado' => 'required',
            'id_curso' => 'required',
            'matricula' => 'nullable|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'nombre' => 'nombre completo',
            'id_apoderado' => 'apoderado',
            'id_curso' => 'curso',

        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo :attribute es obligatorio.',
            'id_apoderado.required' => 'El campo :attribute es obligatorio.',
            'id_curso.required' => 'El campo :attribute es obligatorio.',
        ];
    }
}
