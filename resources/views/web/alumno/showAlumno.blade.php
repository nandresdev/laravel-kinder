@extends('adminlte::page')

@section('title', 'Intranet | Información Del Alumno')

@section('content_header')
    <h1>Información Del Alumno</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="invoice p-3 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                {{ $alumno->nombre_alumno }}
                                <label class="float-right">{{ $alumno->cursos->nombre }}</label>
                            </h4>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NOMBRE APODERADO</th>
                                        <th>TELEFONO</th>
                                        <th>TELEFONO EMERGENCIA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $alumno->nombre_apoderado_principal }}</td>
                                        <td>{{ $alumno->telefono_principal }}</td>
                                        <td>
                                            @if ($alumno->telefono_emergencia_principal)
                                                {{ $alumno->telefono_emergencia_principal }}
                                            @else
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>{{ $alumno->nombre_apoderado_secundario }}</td>
                                        <td>{{ $alumno->telefono_secundario }}</td>
                                        <td>
                                            @if ($alumno->telefono_emergencia_secundario)
                                                {{ $alumno->telefono_emergencia_secundario }}
                                            @else
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('alumno.index') }}" role="button" class="btn btn-secondary"><i
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
