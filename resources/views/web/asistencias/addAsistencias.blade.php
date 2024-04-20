@extends('adminlte::page')

@section('title', 'Intranet | Nueva Asistencia')

@section('content_header')
    <h1>Nueva Asistencia</h1>
@stop

@section('content')
    <div class="card-header">
    </div>

    <form id="formularioDeAsistencia">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label>Curso</label>
                        <select class="form-control" id="campoCurso" name="id_curso" onchange="actualizarTabla()">
                            <option value="">--Seleccionar Curso--</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="inputValidacionCurso">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>Fecha</label>
                        <input type="date" class="form-control" id="campoFecha" name="fecha">
                        <div class="invalid-feedback" id="inputValidacionFecha">
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="table-responsive" id="scroll-footer-table" style="margin-bottom: 20px;">
                <table class="table table-bordered" id="datatableAsistencia">
                    <thead class="bg-warning">
                        <tr>
                            <th>ESTADO</th>
                            <th>NOMBRE ALUMNO</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-warning" id="botonDeCreacion" onclick="registrarAsistencia()"><i
                    class="fas fa-plus-circle" style="margin-right: 2px;"></i> Registrar Asistencia </button>
            <a href="{{ route('asistencia.index') }}" role="button" class="btn btn-secondary"><i
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

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function validarCampos(data) {

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

            if (typeof data.responseJSON.errors.fecha !== 'undefined') {
                document.getElementById("campoFecha").classList.remove('is-valid');
                document.getElementById("campoFecha").classList.add('is-invalid');
                document.getElementById("inputValidacionFecha").innerHTML = data.responseJSON.errors.fecha;
                document.getElementById("inputValidacionFecha").style.display = "block";
            } else {
                document.getElementById("campoFecha").classList.remove('is-invalid');
                document.getElementById("campoFecha").classList.add('is-valid');
                document.getElementById("inputValidacionFecha").innerHTML = "";
                document.getElementById("inputValidacionFecha").style.display = "none";
            }

        }
    </script>
    <script>
        function actualizarTabla() {
            var cursoSeleccionado = $('#campoCurso').val();
            var formData = new FormData();
            formData.append('id_curso', cursoSeleccionado);

            $.ajax({
                    url: '{{ route('asistencia.obtenerAlumnosPorCurso') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                .then(data => {
                    var tableBody = $('#datatableAsistencia tbody');
                    tableBody.empty();

                    data.forEach(alumno => {
                        var newRow = $('<tr>');
                        newRow.html(
                            `<td><input type="checkbox" id="${alumno.id}" name="alumnos_seleccionados[]" onchange="actualizarEstado(this)"></td><td>${alumno.nombre_alumno}</td>`
                        );
                        tableBody.append(newRow);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        function actualizarEstado(checkbox) {
            var estado = checkbox.checked ? 'Presente' : 'Ausente';
            var estadoSelect = $(checkbox).closest('tr').find('select[name="estado[]"]');
            estadoSelect.val(estado);
        }

        function registrarAsistencia() {
            document.getElementById("botonDeCreacion").removeAttribute("disabled");
            var formData = new FormData(document.getElementById("formularioDeAsistencia"));

            var checkboxes = document.querySelectorAll('input[name="alumnos_seleccionados[]"]');
            checkboxes.forEach(function(checkbox) {
                var idAlumno = checkbox.id;
                var estado = checkbox.checked ? 'Presente' : 'Ausente';
                formData.append('id_alumno[]', idAlumno);
                formData.append('estado[]', estado);
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('asistencia.store') }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Creado!',
                        text: 'La asistencia se creó con éxito',
                        confirmButtonColor: "#448aff",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route('asistencia.index') }}';
                        }
                    });
                },
                error: function(data) {
                    console.log(data);
                    validarCampos(data);
                    document.getElementById("botonDeCreacion").removeAttribute("disabled");
                }
            });
        }
    </script>
@stop
