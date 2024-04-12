@extends('adminlte::page')

@section('title', 'Intranet | Agregar Curso')

@section('content_header')
    <h1>Agregar Curso</h1>
@stop

@section('content')
    <div class="card-header">
    </div>

    <form id="formularioDeCurso">
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
                <label>Jornada</label>
                <input type="text" class="form-control" id="campoJornada" placeholder="Jornada" name="jornada"
                    value="{{ old('jornada') }}">
                <div class="invalid-feedback" id="inputValidacionJornada">
                </div>
            </div>
            <div class="form-group">
                <label>Tipo De Transición</label>
                <input type="text" class="form-control" id="campoCategoria" placeholder="Tipo De Transición"
                    name="categoria" value="{{ old('categoria') }}">
                <div class="invalid-feedback" id="inputValidacionCategoria">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-warning" id="botonDeCreacion" onclick="registrarCurso()"><i
                    class="fas fa-plus-circle" style="margin-right: 2px;"></i> Registrar Curso </button>
            <a href="{{ route('curso.index') }}" role="button" class="btn btn-secondary"><i
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

            if (typeof data.responseJSON.errors.jornada !== 'undefined') {
                document.getElementById("campoJornada").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionJornada").innerHTML = data.responseJSON.errors.jornada;
            } else {
                document.getElementById("campoJornada").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionJornada").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.categoria !== 'undefined') {
                document.getElementById("campoCategoria").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionCategoria").innerHTML = data.responseJSON.errors.categoria;
            } else {
                document.getElementById("campoCategoria").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionCategoria").innerHTML = "";
            }
        }

        function registrarCurso() {
            document.getElementById("botonDeCreacion").removeAttribute("disabled");
            var datosFormulario = $("#formularioDeCurso").serialize();
            $.ajax({
                type: 'POST',
                datatype: 'json',
                url: '{{ route('curso.store') }}',
                data: datosFormulario,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Creado!',
                        text: 'El curso ' + data.nombre + ' se creó con éxito',
                        confirmButtonColor: "#448aff",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route('curso.index') }}';
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
