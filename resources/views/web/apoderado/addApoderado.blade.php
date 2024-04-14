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
                    onblur="cambiarCampoRutHaTexto(this)" onkeypress="return validarCampoRut(event)"
                    onfocus="cambiarCampoRutHaNumero(this)">
                <div class="invalid-feedback" id="inputValidacionRut">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre Completo</label>
                <input type="name" class="form-control" id="nombre" placeholder="Nombre Completo" name="nombre"
                    value="{{ old('nombre') }}">
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

        function cambiarCampoRutHaNumero(campo) {
            campo.setAttribute("maxlength", "9");
            switch (campo.value.length) {
                case 2:
                    var rutNumerico = campo.value.slice(1, 2);
                    campo.value = rutNumerico;
                    break;
                case 3:
                    var rutNumerico1 = campo.value.slice(0, 1);
                    var rutNumerico2 = campo.value.slice(2, 3);
                    campo.value = rutNumerico1 + rutNumerico2;
                    break;
                case 4:
                    var rutNumerico1 = campo.value.slice(0, 2);
                    var rutNumerico2 = campo.value.slice(3, 4);
                    campo.value = rutNumerico1 + rutNumerico2;
                    break;
                case 5:
                    var rutNumerico1 = campo.value.slice(0, 3);
                    var rutNumerico2 = campo.value.slice(4, 5);
                    campo.value = rutNumerico1 + rutNumerico2;
                    break;
                case 7:
                    var rutNumerico1 = campo.value.slice(0, 1);
                    var rutNumerico2 = campo.value.slice(2, 5);
                    var rutNumerico3 = campo.value.slice(6, 7);
                    campo.value = rutNumerico1 + rutNumerico2 + rutNumerico3;
                    break;
                case 8:
                    var rutNumerico1 = campo.value.slice(0, 2);
                    var rutNumerico2 = campo.value.slice(3, 6);
                    var rutNumerico3 = campo.value.slice(7, 8);
                    campo.value = rutNumerico1 + rutNumerico2 + rutNumerico3;
                    break;
                case 9:
                    var rutNumerico1 = campo.value.slice(0, 3);
                    var rutNumerico2 = campo.value.slice(4, 7);
                    var rutNumerico3 = campo.value.slice(8, 9);
                    campo.value = rutNumerico1 + rutNumerico2 + rutNumerico3;
                    break;
                case 11:
                    var rutNumerico1 = campo.value.slice(0, 1);
                    var rutNumerico2 = campo.value.slice(2, 5);
                    var rutNumerico3 = campo.value.slice(6, 9);
                    var rutNumerico4 = campo.value.slice(10, 11);
                    campo.value = rutNumerico1 + rutNumerico2 + rutNumerico3 + rutNumerico4;
                    break;
                case 12:
                    var rutNumerico1 = campo.value.slice(0, 2);
                    var rutNumerico2 = campo.value.slice(3, 6);
                    var rutNumerico3 = campo.value.slice(7, 10);
                    var rutNumerico4 = campo.value.slice(11, 12);
                    campo.value = rutNumerico1 + rutNumerico2 + rutNumerico3 + rutNumerico4;
                    break;
            }
        }

        function cambiarCampoRutHaTexto(campo) {
            campo.setAttribute("maxlength", "12");
            switch (campo.value.length) {
                case 1:
                    var rutNumerico = campo.value;
                    campo.value = "-" + rutNumerico;
                    break;
                case 2:
                    var rutNumerico1 = campo.value.slice(0, 1);
                    var rutNumerico2 = campo.value.slice(1, 2);
                    campo.value = rutNumerico1 + "-" + rutNumerico2;
                    break;
                case 3:
                    var rutNumerico1 = campo.value.slice(0, 2);
                    var rutNumerico2 = campo.value.slice(2, 3);
                    campo.value = rutNumerico1 + "-" + rutNumerico2;
                    break;
                case 4:
                    var rutNumerico1 = campo.value.slice(0, 3);
                    var rutNumerico2 = campo.value.slice(3, 4);
                    campo.value = rutNumerico1 + "-" + rutNumerico2;
                    break;
                case 5:
                    var rutNumerico1 = campo.value.slice(0, 1);
                    var rutNumerico2 = campo.value.slice(1, 4);
                    var rutNumerico3 = campo.value.slice(4, 5);
                    campo.value = rutNumerico1 + "." + rutNumerico2 + "-" + rutNumerico3;
                    break;
                case 6:
                    var rutNumerico1 = campo.value.slice(0, 2);
                    var rutNumerico2 = campo.value.slice(2, 5);
                    var rutNumerico3 = campo.value.slice(5, 6);
                    campo.value = rutNumerico1 + "." + rutNumerico2 + "-" + rutNumerico3;
                    break;
                case 7:
                    var rutNumerico1 = campo.value.slice(0, 3);
                    var rutNumerico2 = campo.value.slice(3, 6);
                    var rutNumerico3 = campo.value.slice(6, 7);
                    campo.value = rutNumerico1 + "." + rutNumerico2 + "-" + rutNumerico3;
                    break;
                case 8:
                    var rutNumerico1 = campo.value.slice(0, 1);
                    var rutNumerico2 = campo.value.slice(1, 4);
                    var rutNumerico3 = campo.value.slice(4, 7);
                    var rutNumerico4 = campo.value.slice(7, 8);
                    campo.value = rutNumerico1 + "." + rutNumerico2 + "." + rutNumerico3 + "-" + rutNumerico4;
                    break;
                case 9:
                    var rutNumerico1 = campo.value.slice(0, 2);
                    var rutNumerico2 = campo.value.slice(2, 5);
                    var rutNumerico3 = campo.value.slice(5, 8);
                    var rutNumerico4 = campo.value.slice(8, 9);
                    campo.value = rutNumerico1 + "." + rutNumerico2 + "." + rutNumerico3 + "-" + rutNumerico4;
                    break;
            }
        }

        function validarCampoRut(event) {
            var campoRut = document.getElementById("rut");
            if (event.key != 1 && event.key != 2 && event.key != 3 && event.key != 4 && event.key != 5 && event.key != 6 &&
                event.key != 7 && event.key != 8 && event.key != 9 && event.key != 0 && event.key != "k" && event.key != "K"
            ) {
                return false;
            } else {
                if (campoRut.value.length > 8) {
                    return false;
                } else {
                    return true;
                }
            }
        }

        document.getElementById('telefono').addEventListener('input', function() {
            let telefonoInput = this.value.trim();
            if (!telefonoInput.startsWith('+56 9')) {
                telefonoInput = '+56 9 ' + telefonoInput;
            }
            this.value = telefonoInput;
        });

        document.getElementById('telefono_emergencia').addEventListener('input', function() {
            let telefonoInput = this.value.trim();
            if (!telefonoInput.startsWith('+56 9')) {
                telefonoInput = '+56 9 ' + telefonoInput;
            }
            this.value = telefonoInput;
        });
    </script>
@stop
