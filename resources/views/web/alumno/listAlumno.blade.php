@extends('adminlte::page')

@section('title', 'Intranet | Registros De Alumnos')

@section('content_header')
    <h1>Listado de Alumnos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <button class="btn btn-success" id="export_excel">
                    Exportar a Excel
                </button>
                <button class="btn btn-danger" id="export_pdf">
                    Exportar a PDF
                </button>
                <button class="btn btn-primary" id="toggle_columns" onclick="window.location='{{ route('alumno.create') }}'">
                    Nuevo Alumno
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
                            <th>ACCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alumnos as $alumno)
                            <tr>
                                <td>{{ $alumno->matricula }}</td>
                                <td>{{ $alumno->nombre }}</td>
                                <td>{{ $alumno->apoderados->nombre }}</td>
                                <td>{{ $alumno->cursos->nombre }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#alumnoModal{{ $alumno->id }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('alumno.edit', $alumno->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i>
                                            <a class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="alumnoModal{{ $alumno->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="alumnoModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="card-body">
                                            <strong>Ver Matricula</strong>
                                            <p class="text-muted">{{ $alumno->matricula }} </p>
                                            <hr>
                                            <strong>Nombre Completo</strong>
                                            <p class="text-muted">{{ $alumno->nombre }} </p>
                                            <hr>
                                            <strong>Apoderado</strong>
                                            <p class="text-muted">{{ $alumno->apoderados->nombre }}</p>
                                            <strong>Curso</strong>
                                            <p class="text-muted">{{ $alumno->cursos->nombre }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        function mostrarAlumno(alumnoId) {
            const alumnoDetail = $('#alumnoDetail' + alumnoId).html();
            $('#alumnoModalLabel').html('Detalles del alumno');
            $('#alumnoModalBody').html(alumnoDetail);
            $('#alumnoModal').modal('show');
        }
    </script>



@stop
