<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddApoderadoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'rut' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'telefono_emergencia' => 'nullable|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'rut' => 'rut',
            'nombre' => 'nombre completo',
            'telefono' => 'teléfono',
            'telefono_emergencia' => 'teléfono de emergencia ',

        ];
    }

    public function messages()
    {
        return [
            'rut.required' => 'El campo :attribute es obligatorio.',
            'nombre.required' => 'El campo :attribute es obligatorio.',
            'telefono.required' => 'El campo :attribute es obligatorio.',
        ];
    }
}
