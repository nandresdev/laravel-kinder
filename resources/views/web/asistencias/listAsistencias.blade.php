@extends('adminlte::page')

@section('title', 'Intranet | Registros De Asistencia')

@section('content_header')
    <h1>Listado de Asistencia</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <button class="btn btn-primary" id="toggle_columns"
                    onclick="window.location='{{ route('asistencia.create') }}'">
                    Generar Asistencia
                </button>
            </div>
            <div class="table-responsive" id="scroll-footer-table" style="margin-bottom: 20px;">
                <table class="table table-bordered" id="datatableAsistencia">
                    <thead class="bg-warning">
                        <tr>
                            <th>CURSO</th>
                            <th>FECHA</th>
                            <th>ACCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asistencias as $asistencia)
                            <tr>
                                <td>
                                    @isset($asistencia->cursos)
                                        {{ $asistencia->cursos->nombre }}
                                    @else
                                        Sin curso asignado
                                    @endisset
                                </td>
                                <td>{{ $asistencia->fecha }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('asistencia.show', ['fecha' => $asistencia->fecha, 'id_curso' => $asistencia->id_curso]) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                            onclick="confirmarEliminacionDeAsistencia('{{ $asistencia->fecha }}', '{{ $asistencia->id_curso }}')">
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
            const datatable = $("#datatableAsistencia").DataTable({
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
        function confirmarEliminacionDeAsistencia(fecha, id_curso) {
            Swal.fire({
                title: '¿Está seguro?',
                text: "Todas las asistencias para la fecha " + fecha + " serán eliminadas definitivamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarAsistencia(fecha, id_curso);
                }
            });
        }

        function eliminarAsistencia(fecha, id_curso) {
            const url = '{{ route('asistencia.destroy', ['fecha' => ':fecha', 'id_curso' => ':id_curso']) }}'
                .replace(':fecha', fecha)
                .replace(':id_curso', id_curso);
            const csrf = '{{ csrf_token() }}';

            $.ajax({
                type: 'DELETE',
                url: url,
                data: {
                    _token: csrf
                },
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Eliminada!',
                        text: 'Las asistencias se eliminaron con éxito',
                        confirmButtonColor: "#448aff",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                },
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al intentar eliminar las asistencias',
                        confirmButtonColor: "#448aff",
                        confirmButtonText: "Cerrar"
                    });
                }
            });
        }
    </script>


@stop
