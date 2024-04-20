<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listado de Alumnos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
        }

        .nombre-columna {
            width: 15%;
        }
    </style>
</head>
<body>
    <h1>Listado de Alumnos</h1>
    <table>
        <thead>
            <tr>
                <th class="nombre-columna">NOMBRE COMPLETO</th>
                <th class="nombre-columna">CURSO</th>
                <th class="nombre-columna">APODERADO PRINCIPAL</th>
                <th class="nombre-columna">TELEFONO PRINCIPAL</th>
                <th class="nombre-columna">TELEFONO EMERGENCIA PRINCIPAL</th>
                <th class="nombre-columna">APODERADO SECUNDARIO</th>
                <th class="nombre-columna">TELEFONO SECUNDARIO</th>
                <th class="nombre-columna">TELEFONO EMERGENCIA SECUNDARIO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->nombre_alumno }}</td>
                    <td>{{ $alumno->cursos->nombre }}</td>
                    <td>{{ $alumno->nombre_apoderado_principal }}</td>
                    <td>{{ $alumno->telefono_principal }}</td>
                    <td>{{ $alumno->telefono_emergencia_principal }}</td>
                    <td>{{ $alumno->nombre_apoderado_secundario }}</td>
                    <td>{{ $alumno->telefono_secundario }}</td>
                    <td>{{ $alumno->telefono_emergencia_secundario }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
