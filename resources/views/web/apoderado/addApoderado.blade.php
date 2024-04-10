@extends('adminlte::page')

@section('title', 'Intranet | Agregar Apoderado')

@section('content_header')
    <h1>Agregar Apoderado</h1>
@stop

@section('content')
    <div class="card-header">
    </div>

    <form id="formularioDeApoderado">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">RUT</label>
                <input type="text" class="form-control" id="rut" name="rut" value="{{ old('rut') }}"
                    placeholder="00.000.000-0">
                <div class="invalid-feedback" id="inputValidacionRut">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre Completo</label>
                <input type="name" class="form-control" id="nombre" placeholder="Nombre Completo" name="nombre"
                    value="{{ old('name') }}">
                <div class="invalid-feedback" id="inputValidacionNombre">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Teléfono</label>
                <input type="text" class="form-control" id="telefono" placeholder="+56 9 12345678" name="telefono"
                    value="{{ old('telefono') }}">
                <div class="invalid-feedback" id="inputValidacionTelefono">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Teléfono De Emergencia<span style="font-weight: 700; font-size:11px;">
                        (Opcional)</span></label>
                <input type="text" class="form-control" id="telefono_emergencia" placeholder="+56 9 12345678"
                    name="telefono_emergencia" value="{{ old('telefono_emergencia') }}">
                <div class="invalid-feedback" id="inputValidacionTelefonoEmergencia">
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="button" class="btn btn-warning" id="botonDeCreacion" onclick="registrarApoderado()"><i
                    class="fas fa-plus-circle" style="margin-right: 2px;"></i> Registrar Apoderado </button>
            <a href="{{ route('apoderado.index') }}" role="button" class="btn btn-secondary"><i
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
            if (typeof data.responseJSON.errors.rut !== 'undefined') {
                document.getElementById("rut").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionRut").innerHTML = data.responseJSON.errors.rut;
            } else {
                document.getElementById("nombre").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionRut").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.nombre !== 'undefined') {
                document.getElementById("nombre").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionNombre").innerHTML = data.responseJSON.errors.nombre;
            } else {
                document.getElementById("nombre").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionNombre").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.telefono !== 'undefined') {
                document.getElementById("telefono").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionTelefono").innerHTML = data.responseJSON.errors.telefono;
            } else {
                document.getElementById("telefono").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionTelefono").innerHTML = "";
            }

            if (typeof data.responseJSON.errors.telefono_emergencia !== 'undefined') {
                document.getElementById("telefono_emergencia").setAttribute("class", "form-control is-invalid");
                document.getElementById("inputValidacionTelefonoEmergencia").innerHTML = data.responseJSON.errors
                    .telefono_emergencia;
            } else {
                document.getElementById("telefono_emergencia").setAttribute("class", "form-control is-valid");
                document.getElementById("inputValidacionTelefonoEmergencia").innerHTML = "";
            }
        }

        function registrarApoderado() {
            document.getElementById("botonDeCreacion").removeAttribute("disabled");
            var datosFormulario = $("#formularioDeApoderado").serialize();
            $.ajax({
                type: 'POST',
                datatype: 'json',
                url: '{{ route('apoderado.store') }}',
                data: datosFormulario,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Creado!',
                        text: 'El apoderado ' + data.nombre + ' se creó con éxito',
                        confirmButtonColor: "#448aff",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route('apoderado.index') }}';
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
