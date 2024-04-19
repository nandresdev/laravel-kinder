<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMatriculaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'nombre_alumno' => 'required|string|max:255',
            'nombre_apoderado_principal' => 'required|string|max:255',
            'telefono_principal' => 'required|string|max:255',
            'telefono_emergencia_principal' => 'nullable|string|max:255',
            'nombre_apoderado_secundario' => 'required|string|max:255',
            'telefono_secundario' => 'required|string|max:255',
            'telefono_emergencia_secundario' => 'nullable|string|max:255',
            'matricula' => 'nullable|file|max:255',
            'id_curso' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'nombre_alumno' => 'nombre completo del alumno',
            'rut_apoderado' => 'rut del apoderado',
            'nombre_apoderado_principal' => 'nombre completo del apoderado principal',
            'telefono_principal' => 'telefono del apoderado principal',
            'nombre_apoderado_secundario' => 'nombre completo del apoderado secundario',
            'telefono_secundario' => 'telefono del apoderado secundario',
            'id_curso' => 'curso',
        ];
    }

    public function messages()
    {
        return [
            'nombre_alumno.required' => 'El campo :attribute es obligatorio.',
            'rut_apoderado.required' => 'El campo :attribute es obligatorio.',
            'nombre_apoderado_principal.required' => 'El campo :attribute es obligatorio.',
            'telefono_principal.required' => 'El campo :attribute es obligatorio.',
            'nombre_apoderado_secundario.required' => 'El campo :attribute es obligatorio.',
            'telefono_secundario.required' => 'El campo :attribute es obligatorio.',
            'id_curso.required' => 'El campo :attribute es obligatorio.',

        ];
    }
}
