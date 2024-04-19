@extends('adminlte::page')

@section('title', 'Intranet | Registros De Alumnos')

@section('content_header')
    <h1>Listado de Alumnos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <button class="btn btn-success" onclick="window.location='{{ route('matricula.excel') }}'">
                    Exportar a Excel
                </button>
                <button class="btn btn-danger" id="export_pdf">
                    Exportar a PDF
                </button>
            </div>
            <div class="table-responsive" id="scroll-footer-table" style="margin-bottom: 20px;">
                <table class="table table-bordered" id="datatableAlumno">
                    <thead class="bg-warning">
                        <tr>
                            <th>MATRICULA</th>
                            <th>NOMBRE COMPLETO</th>
                            <th>CURSO</th>
                            <th>APODERADO</th>
                            <th>TELEFONO</th>
                            <th>TELEFONO EMERGENCIA</th>
                            <th>ACCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumnos as $alumno)
                            <tr>
                                <td>{{ $alumno->matricula }}</td>
                                <td>{{ $alumno->nombre_alumno }}</td>
                                <td>{{ $alumno->cursos->nombre }}</td>
                                <td>{{ $alumno->nombre_apoderado_principal }}</td>
                                <td>{{ $alumno->telefono_principal }}</td>
                                <td>{{ $alumno->telefono_emergencia_principal }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('alumno.show', $alumno->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('matricula.edit', $alumno->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                            onclick="confirmarEliminacionDelAlumno('{{ $alumno->id }}')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <div class="float-right d-none d-sm-inline">
        Intranet
    </div>
    <strong>Copyright © <a class="text-primary">nandresdev</a>.</strong>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            const datatable = $("#datatableAlumno").DataTable({
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Todos"],
                ],
                language: {
                    processing: "Traitement en cours...",
                    search: "Buscar",
                    lengthMenu: "Mostrar_MENU_ Registros",
                    info: "Mostrar desde _START_ hasta _END_ de _TOTAL_ registros",
                    infoEmpty: "Opcion no disponible",
                    infoFiltered: "",
                    infoPostFix: "",
                    loadingRecords: "Cargandos registros.",
                    zeroRecords: "No hay datos disponibles en la tabla",
                    emptyTable: "No hay datos disponibles en la tabla",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Ultimo",
                    },
                },
            });
        });
    </script>


    <script>
        function confirmarEliminacionDelAlumno(idAlumno) {
            Swal.fire({
                title: '¿Esta seguro?',
                text: "Este alumno se eliminara definitivamente de la plataforma",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarAlumno(idAlumno);
                    window.location.href = '{{ route('alumno.index') }}';
                }
            })
        }

        function eliminarAlumno(idAlumno) {
            var url = '{{ route('matricula.destroy', [':idAlumno']) }}';
            url = url.replace(':idAlumno', idAlumno);
            var csrf = '{{ csrf_token() }}';

            $.ajax({
                type: 'DELETE',
                datatype: 'json',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                success: function(data) {
                    if (data.estado == "eliminado") {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Eliminado!',
                            text: 'El alumno ' + data.nombre + ' se elimino con éxito',
                            confirmButtonColor: "#448aff",
                            confirmButtonText: "Confirmar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route('alumno.index') }}';
                            }
                        });
                    }
                },
                error: function(data) {}
            })
        }
    </script>



@stop
