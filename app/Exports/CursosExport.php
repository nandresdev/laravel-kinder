<?php

namespace App\Exports;

use App\Models\Curso;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CursosExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return Curso::select(
            'nombre',
            'jornada',
            'categoria',
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Jornada',
            'Tipo de Transición',
        ];
    }

    public function map($curso): array
    {
        return [
            $curso->nombre,
            $curso->jornada,
            $curso->categoria,
        ];
    }
}
