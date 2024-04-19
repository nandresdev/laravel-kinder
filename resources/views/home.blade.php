@extends('adminlte::page')

@section('title', 'Intranet | Inicio')

@section('content_header')
@stop

@section('content')
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $cantidadUsuarios }}</h3>
                <p>Usuarios</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('usuario.index') }}" class="small-box-footer">
                Más información <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $cantidadAlumnos }}</h3>
                <p>Alumnos</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-restroom"></i>
            </div>
            <a href="{{ route('alumno.index') }}" class="small-box-footer">
                Más información <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $cantidadCursos }}</h3>
                <p>Cursos</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-sitemap"></i>
            </div>
            <a href="{{ route('curso.index') }}" class="small-box-footer">
                Más información <i class="fas fa-arrow-circle-right"></i>
            </a>
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
@stop

@section('js')
    <script></script>
@stop
