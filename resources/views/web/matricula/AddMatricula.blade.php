@extends('adminlte::page')

@section('title', 'Intranet | Nueva Matrícula')

@section('content_header')
    <h1>Nueva Matrícula</h1>
@stop

@section('content')
    <div class="card-header">
    </div>

    <form id="formularioDeMatricula">
        @csrf
        <div class="card-body">
            <h5 class="">Información Del Alumno</h5>
            <br>
            <div class="form-group">
                <label>Alumno</label>
                <input type="name" class="form-control" id="campoNombreAlumno" placeholder="Nombre Completo Del Alumno"
                    name="nombre_alumno" value="{{ old('nombre_alumno') }}">
                <div class="invalid-feedback" id="inputValidacionNombreAlumno">
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
                            <option value="{{ $curso->id }}">{{ $curso->nombre }}
                            </option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback" id="inputValidacionCurso">
                </div>
            </div>
            <hr>
            <h5 class="">Apoderado Principal</h5>
            <br>
            <div class="form-group">
                <label>Nombre Completo Del Apoderado Principal</label>
                <input type="name" class="form-control" id="campoNombreApoderadoPrincipal"
                    placeholder="Nombre Completo Del Apoderado Principal" name="nombre_apoderado_principal"
                    value="{{ old('nombre_apoderado_principal') }}">
                <div class="invalid-feedback" id="inputValidacionNombreApoderadoPrincipal">
                </div>
            </div>
            <div class="form-group">
                <label>Teléfono Del Apoderado Principal</label>
                <input type="text" class="form-control" id="campoTelefonoApoderadoPrincipal" placeholder="+56 9 12345678"
                    name="telefono_principal" value="{{ old('telefono_principal') }}">
                <div class="invalid-feedback" id="inputValidacionTelefonoApoderadoPrincipal">
                </div>
            </div>
            <div class="form-group">
                <label>Teléfono De Emergencia Del Apoderado Principal<span style="font-weight: 700; font-size:11px;">
                        (Opcional)</span></label>
                <input type="text" class="form-control" id="campoTelefonoEmergenciaApoderadoPrincipal"
                    placeholder="+56 9 12345678" name="telefono_emergencia_principal"
                    value="{{ old('telefono_emergencia_principal') }}">
                <div class="invalid-feedback" id="inputValidacionTelefonoEmergenciaApoderadoPrincipal">
                </div>
            </div>
            <hr>
            <h5 class="">Apoderado Secundario</h5>
            <br>
            <div class="form-group">
                <label>Nombre Completo Del Apoderado Secundario</label>
                <input type="name" class="form-control" id="campoNombreApoderadoSecundario"
                    placeholder="Nombre Completo Del Apoderado Secundario" name="nombre_apoderado_secundario"
                    value="{{ old('nombre_apoderado_secundario') }}">
                <div class="invalid-feedback" id="inputValidacionNombreApoderadoSecundario">
                </div>
            </div>
            <div class="form-group">
                <label>Teléfono Del Apoderado Secundario</label>
                <input type="text" class="form-control" id="campoTelefonoApoderadoSecundario"
                    placeholder="+56 9 12345678" name="telefono_secundario" value="{{ old('telefono_secundario') }}">
                <div class="invalid-feedback" id="inputValidacionTelefonoApoderadoSecundario">
                </div>
            </div>
            <div class="form-group">
                <label>Teléfono De Emergencia Del Apoderado Secundario<span style="font-weight: 700; font-size:11px;">
                        (Opcional)</span></label>
                <input type="text" class="form-control" id="campoTelefonoEmergenciaApoderadoSecundario"
                    placeholder="+56 9 12345678" name="telefono_emergencia_secundario"
                    value="{{ old('telefono_emergencia_secundario') }}">
                <div class="invalid-feedback" id="inputValidacionTelefonoEmergenciaApoderadoSecundario">
                </div>
            </div>
            <hr>
        </div>

        <div class="card-footer">
            <button type="button" class="btn btn-warning" id="botonDeCreacion" onclick="registrarMatricula()"><i
                    class="fas fa-plus-circle" style="margin-right: 2px;"></i> Registrar Matrícula </button>
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

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function validarCampos(data) {
            if (typeof data.responseJSON.errors.nombre_alumno !== 'undefined') {
                document.getElementById("campoNombreAlumno").classList.remove('is-valid');
                document.getElementById("campoNombreAlumno").classList.add('is-invalid');
                document.getElementById("inputValidacionNombreAlumno").innerHTML = data.responseJSON.errors.nombre_alumno;
            } else {
                document.getElementById("campoNombreAlumno").classList.remove('is-invalid');
                document.getElementById("campoNombreAlumno").classList.add('is-valid');
                document.getElementById("inputValidacionNombreAlumno").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.id_curso !== 'undefined') {
                document.getElementById("campoCurso").classList.remove('is-valid');
                document.getElementById("campoCurso").classList.add('is-invalid');
                document.getElementById("inputValidacionCurso").innerHTML = data.responseJSON.errors.id_curso;
                document.getElementById("inputValidacionCurso").style.display = "block";
            } else {
                document.getElementById("campoCurso").classList.remove('is-invalid');
                document.getElementById("campoCurso").classList.add('is-valid');
                document.getElementById("inputValidacionCurso").innerHTML = "";
                document.getElementById("inputValidacionCurso").style.display = "none";
            }

            if (typeof data.responseJSON.errors.nombre_apoderado_principal !== 'undefined') {
                document.getElementById("campoNombreApoderadoPrincipal").classList.remove('is-valid');
                document.getElementById("campoNombreApoderadoPrincipal").classList.add('is-invalid');
                document.getElementById("inputValidacionNombreApoderadoPrincipal").innerHTML = data.responseJSON.errors.nombre_apoderado_principal;
            } else {
                document.getElementById("campoNombreApoderadoPrincipal").classList.remove('is-invalid');
                document.getElementById("campoNombreApoderadoPrincipal").classList.add('is-valid');
                document.getElementById("inputValidacionNombreApoderadoPrincipal").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.telefono_principal !== 'undefined') {
                document.getElementById("campoTelefonoApoderadoPrincipal").classList.remove('is-valid');
                document.getElementById("campoTelefonoApoderadoPrincipal").classList.add('is-invalid');
                document.getElementById("inputValidacionTelefonoApoderadoPrincipal").innerHTML = data.responseJSON.errors.telefono_principal;
            } else {
                document.getElementById("campoTelefonoApoderadoPrincipal").classList.remove('is-invalid');
                document.getElementById("campoTelefonoApoderadoPrincipal").classList.add('is-valid');
                document.getElementById("inputValidacionTelefonoApoderadoPrincipal").innerHTML = "";
            }

            document.getElementById("campoTelefonoEmergenciaApoderadoPrincipal").setAttribute("class",
                "form-control is-valid");
            document.getElementById("inputValidacionTelefonoEmergenciaApoderadoPrincipal").innerHTML = "";


            if (typeof data.responseJSON.errors.nombre_apoderado_secundario !== 'undefined') {
                document.getElementById("campoNombreApoderadoSecundario").classList.remove('is-valid');
                document.getElementById("campoNombreApoderadoSecundario").classList.add('is-invalid');
                document.getElementById("inputValidacionNombreApoderadoSecundario").innerHTML = data.responseJSON.errors.nombre_apoderado_secundario;
            } else {
                document.getElementById("campoNombreApoderadoSecundario").classList.remove('is-invalid');
                document.getElementById("campoNombreApoderadoSecundario").classList.add('is-valid');
                document.getElementById("inputValidacionNombreApoderadoSecundario").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.telefono_secundario !== 'undefined') {
                document.getElementById("campoTelefonoApoderadoSecundario").classList.remove('is-valid');
                document.getElementById("campoTelefonoApoderadoSecundario").classList.add('is-invalid');
                document.getElementById("inputValidacionTelefonoApoderadoSecundario").innerHTML = data.responseJSON.errors.telefono_secundario;
            } else {
                document.getElementById("campoTelefonoApoderadoSecundario").classList.remove('is-invalid');
                document.getElementById("campoTelefonoApoderadoSecundario").classList.add('is-valid');
                document.getElementById("inputValidacionTelefonoApoderadoSecundario").innerHTML = "";
            }

            document.getElementById("campoTelefonoEmergenciaApoderadoSecundario").setAttribute("class",
                "form-control is-valid");
            document.getElementById("inputValidacionTelefonoEmergenciaApoderadoSecundario").innerHTML = "";

        }

        function registrarMatricula() {
            document.getElementById("botonDeCreacion").removeAttribute("disabled");
            const datosFormulario = $("#formularioDeMatricula").serialize();
            $.ajax({
                type: 'POST',
                datatype: 'json',
                url: '{{ route('matricula.store') }}',
                data: datosFormulario,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Creado!',
                        text: 'La matricula se creó con éxito',
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

        document.getElementById('campoTelefonoApoderadoPrincipal').addEventListener('input', function() {
            let telefonoInput = this.value.trim();
            if (!telefonoInput.startsWith('+56 9')) {
                telefonoInput = '+56 9 ' + telefonoInput;
            }
            this.value = telefonoInput;
        });

        document.getElementById('campoTelefonoEmergenciaApoderadoPrincipal').addEventListener('input', function() {
            let telefonoInput = this.value.trim();
            if (!telefonoInput.startsWith('+56 9')) {
                telefonoInput = '+56 9 ' + telefonoInput;
            }
            this.value = telefonoInput;
        });

        document.getElementById('campoTelefonoApoderadoSecundario').addEventListener('input', function() {
            let telefonoInput = this.value.trim();
            if (!telefonoInput.startsWith('+56 9')) {
                telefonoInput = '+56 9 ' + telefonoInput;
            }
            this.value = telefonoInput;
        });

        document.getElementById('campoTelefonoEmergenciaApoderadoSecundario').addEventListener('input', function() {
            let telefonoInput = this.value.trim();
            if (!telefonoInput.startsWith('+56 9')) {
                telefonoInput = '+56 9 ' + telefonoInput;
            }
            this.value = telefonoInput;
        });
    </script>
@stop
