@extends('adminlte::page')

@section('title', 'Intranet | Informe De Asistencia')

@section('content_header')
    <h1>Informe De Asistencia</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="invoice p-3 mb-3">
                    <button class="btn btn-success"
                        onclick="window.location='{{ route('asistencia.excel', ['fecha' => $fecha, 'id_curso' => $id_curso]) }}'">
                        Exportar a Excel
                    </button>
                    <button class="btn btn-danger"
                        onclick="window.location='{{ route('asistencia.pdf', ['fecha' => $fecha, 'id_curso' => $id_curso]) }}'">
                        Exportar a PDF
                    </button>
                    <br><br>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>CURSO</th>
                                        <th>NOMBRE ALUMNO</th>
                                        <th>ESTADO</th>
                                        <th>FECHA</th>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('asistencia.index') }}" role="button" class="btn btn-secondary"><i
                        class="fas fa-arrow-alt-circle-left" style="margin-right: 2px;"></i> Volver</a>
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
