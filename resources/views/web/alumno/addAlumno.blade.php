@extends('adminlte::page')

@section('title', 'Intranet | Agregar Alumno')

@section('content_header')
    <h1>Agregar Alumno</h1>
@stop

@section('content')
    <div class="card-header">
    </div>

    <form id="formularioDeAlumno">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Nombre</label>
                <input type="name" class="form-control" id="campoNombre" placeholder="Nombre" name="nombre"
                    value="{{ old('nombre') }}">
                <div class="invalid-feedback" id="inputValidacionNombre">
                </div>
            </div>
            <div class="form-group">
                <label>Apoderado</label>
                <select class="form-control" id="campoApoderado" name="id_apoderado">
                    <option value="">--Seleccionar Apoderado--</option>
                    @foreach ($apoderados as $apoderado)
                        @if (old('id_apoderado') == $apoderado->id)
                            <option selected value="{{ $apoderado->id }}">
                                {{ $apoderado->nombre }}</option>
                        @else
                            <option value="{{ $apoderado->id }}">
                                {{ $apoderado->nombre }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback" id="inputValidacionApoderado">
                </div>
            </div>
            <div class="form-group">
                <label>Curso</label>
                <select class="form-control" id="campoCurso" name="id_curso">
                    <option value="">--Seleccionar Curso--</option>
                    @foreach ($cursos as $curso)
                        @if (old('id_curso') == $curso->id)
                            <option selected value="{{ $curso->id }}">
                                {{ $curso->nombre }}</option>
                        @else
                            <option value="{{ $curso->id }}">
                                {{ $curso->nombre }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback" id="inputValidacionCurso">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-warning" id="botonDeCreacion" onclick="registrarAlumno()"><i
                    class="fas fa-plus-circle" style="margin-right: 2px;"></i> Registrar Alumno </button>
            <a href="{{ route('alumno.index') }}" role="button" class="btn btn-secondary"><i
                    class="fas fa-arrow-alt-circle-left" style="margin-right: 2px;"></i> Volver</a>
        </div>
    </form>
@stop

@section('footer')
    <div class="float-right d-none d-sm-inline">
        Intranet
    </div>
    <strong>Copyright © <a class="text-primary">nandresdev</a>.</strong>
@stop

@section('css')
    <style>
        .input-error-icon {
            border-color: #dc3545;
        }

        .input-success-icon {
            border-color: #28a745;
        }
    </style>

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function validarCampos(data) {
            if (typeof data.responseJSON.errors.nombre !== 'undefined') {
                document.getElementById("campoNombre").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionNombre").innerHTML = data.responseJSON.errors.nombre;
            } else {
                document.getElementById("campoNombre").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionNombre").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.id_apoderado !== 'undefined') {
                document.getElementById("campoApoderado").classList.remove('input-success-icon');
                document.getElementById("campoApoderado").classList.add('input-error-icon');
                document.getElementById("inputValidacionApoderado").innerHTML = data.responseJSON.errors.id_apoderado;
                document.getElementById("inputValidacionApoderado").style.display = "block";
            } else {
                document.getElementById("campoApoderado").classList.remove('input-error-icon');
                document.getElementById("campoApoderado").classList.add('input-success-icon');
                document.getElementById("inputValidacionApoderado").innerHTML = "";
                document.getElementById("inputValidacionApoderado").style.display = "none";
            }

            if (typeof data.responseJSON.errors.id_curso !== 'undefined') {
                document.getElementById("campoCurso").classList.remove('input-success-icon');
                document.getElementById("campoCurso").classList.add('input-error-icon');
                document.getElementById("inputValidacionCurso").innerHTML = data.responseJSON.errors.id_curso;
                document.getElementById("inputValidacionCurso").style.display = "block";
            } else {
                document.getElementById("campoCurso").classList.remove('input-error-icon');
                document.getElementById("campoCurso").classList.add('input-success-icon');
                document.getElementById("inputValidacionCurso").innerHTML = "";
                document.getElementById("inputValidacionCurso").style.display = "none";
            }
        }

        function registrarAlumno() {
            document.getElementById("botonDeCreacion").removeAttribute("disabled");
            var datosFormulario = $("#formularioDeAlumno").serialize();
            $.ajax({
                type: 'POST',
                datatype: 'json',
                url: '{{ route('alumno.store') }}',
                data: datosFormulario,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Creado!',
                        text: 'El alumno ' + data.nombre + ' se creó con éxito',
                        confirmButtonColor: "#448aff",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route('alumno.index') }}';
                        }
                    });
                },
                error: function(data) {
                    console.log(data)
                    validarCampos(data)
                    document.getElementById("botonDeCreacion").removeAttribute("disabled");

                }
            })
        }
    </script>
@stop
