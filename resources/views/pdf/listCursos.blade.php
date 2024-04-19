<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Listado de Curso</title>
    <style>
    </style>
</head>

<body>
    <h1>Listado de Curso</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Jornada</th>
                <th>Tipo De Transición</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($cursos as $curso)
                <tr>
                    <td>{{ $curso->nombre }}</td>
                    <td>{{ $curso->jornada }}</td>
                    <td>{{ $curso->categoria }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
