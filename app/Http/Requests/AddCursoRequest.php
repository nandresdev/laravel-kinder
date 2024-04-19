<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCursoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'jornada' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'nombre' => 'nombre',
            'jornada' => 'jornada',
            'categoria' => 'tipo de transición',

        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo :attribute es obligatorio.',
            'jornada.required' => 'El campo :attribute es obligatorio.',
            'categoria.required' => 'El campo :attribute es obligatorio.',
        ];
    }
}
