<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Asistencia</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Listado de Asistencia</h1>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Curso</th>
                <th>Nombre Alumno</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asistencias as $index => $asistencia)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $asistencia->cursos->nombre }}</td>
                    <td>{{ $asistencia->matriculas->nombre_alumno }}</td>
                    <td>{{ $asistencia->estado }}</td>
                    <td>{{ $asistencia->fecha }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
