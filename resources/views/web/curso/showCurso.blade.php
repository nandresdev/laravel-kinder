@extends('adminlte::page')

@section('title', 'Intranet | Registros De Alumnos')

@section('content_header')
    <h1>{{ $curso->nombre }}</h1>
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
                <button class="btn btn-primary" id="toggle_columns">
                    Integrar Nuevo Alumno
                </button>
            </div>
            <div class="table-responsive" id="scroll-footer-table" style="margin-bottom: 20px;">
                <table class="table table-bordered" id="dataTableAlumno">
                    <thead class="bg-warning">
                        <tr>
                            <th>NOMBRE COMPLETO</th>
                            <th>ACCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
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
            const datatable = $("#dataTableAlumno").DataTable({
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

@stop
