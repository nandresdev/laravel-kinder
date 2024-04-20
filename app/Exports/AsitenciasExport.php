<?php

namespace App\Exports;

use App\Models\Asistencia;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AsitenciasExport implements WithHeadings, WithMapping, ShouldAutoSize, FromCollection
{

    use Exportable;

    private $fecha;
    private $id_curso;

    public function __construct($fecha, $id_curso)
    {
        $this->fecha = $fecha;
        $this->id_curso = $id_curso;
    }

    public function collection()
    {
        return Asistencia::with(['cursos', 'matriculas'])
            ->where('fecha', $this->fecha)
            ->where('id_curso', $this->id_curso)
            ->get();
    }
    public function headings(): array
    {
        return [
            'Curso',
            'Nombre Alumno',
            'Estado',
            'Fecha',
        ];
    }

    public function map($asistencia): array
    {
        return [
            $asistencia->cursos->nombre,
            $asistencia->matriculas->nombre_alumno,
            $asistencia->estado,
            $asistencia->fecha,
        ];
    }
}
