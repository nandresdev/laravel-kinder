<?php

namespace App\Exports;

use App\Models\Matriculas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AlumnosExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{

    public function collection()
    {
        return Matriculas::select(
            'id_curso',
            'nombre_alumno',
            'nombre_apoderado_principal',
            'telefono_principal',
            'telefono_emergencia_principal',
            'nombre_apoderado_secundario',
            'telefono_secundario',
            'telefono_emergencia_secundario'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Curso',
            'Nombre Alumno',
            'Nombre Apoderado Principal',
            'Telefono Apoderado Principal',
            'Telefono Emergencia Apoderado Principal',
            'Nombre Apoderado Secundario',
            'Telefono Apoderado Secundario',
            'Telefono Emergencia Apoderado Secundario',
        ];
    }

    public function map($matricula): array
    {
        return [
            $matricula->cursos->nombre,
            $matricula->nombre_alumno,
            $matricula->nombre_apoderado_principal,
            $matricula->telefono_principal,
            $matricula->telefono_emergencia_principal,
            $matricula->nombre_apoderado_secundario,
            $matricula->telefono_secundario,
            $matricula->telefono_emergencia_secundario,
        ];
    }
}
