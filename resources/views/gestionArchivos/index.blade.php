@extends('adminlte::page')
 
@section('title', 'Gestión de Archivos')
 
@section('content_header')
    <h1><i class="fas fa-folder-open mr-2"></i>Gestión de Archivos</h1>
@stop
 
@section('content')
 
{{-- Alertas --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif
 
<div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="archivosTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="subir-tab" data-toggle="pill" href="#subir" role="tab">
                    <i class="fas fa-upload mr-1"></i> Subir Archivo
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ver-tab" data-toggle="pill" href="#ver" role="tab">
                    <i class="fas fa-eye mr-1"></i> Ver y Descargar
                </a>
            </li>
        </ul>
    </div>
 
    <div class="card-body">
        <div class="tab-content" id="archivosTabsContent">
 
            {{-- ===================== PESTAÑA 1: SUBIR ===================== --}}
            <div class="tab-pane fade show active" id="subir" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <form action="{{ route('gestionArchivos.store') }}" method="POST" enctype="multipart/form-data" id="formSubir">
                            @csrf
 
                            {{-- Tipo de documento --}}
                            <div class="form-group">
                                <label for="tipo_archivo"><i class="fas fa-tag mr-1"></i> Tipo de Documento <span class="text-danger">*</span></label>
                                <select class="form-control @error('tipo_archivo') is-invalid @enderror" id="tipo_archivo" name="tipo_archivo" required>
                                    <option value="">-- Seleccione un tipo --</option>
                                    <option value="tarjetaIdentidad" {{ old('tipo_archivo') == 'tarjetaIdentidad' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                                    <option value="RegistroCivil" {{ old('tipo_archivo') == 'RegistroCivil' ? 'selected' : '' }}>Registro Civil</option>
                                    <option value="CedulaAcudiente" {{ old('tipo_archivo') == 'CedulaAcudiente' ? 'selected' : '' }}>Cedula de ciudadania del acudiente</option>
                                    <option value="afiliacionEpsSisben" {{ old('tipo_archivo') == 'afiliacionEpsSisben' ? 'selected' : '' }}>Afiliación EPS o Sisben</option>
                                    <option value="carnetVacunacion" {{ old('tipo_archivo') == 'carnetVacunacion' ? 'selected' : '' }}>Carnet de vacunación</option>
                                    <option value="certificadoUltimosGrados" {{ old('tipo_archivo') == 'certificadoUltimosGrados' ? 'selected' : '' }}>Certificado de último grados</option>
                                    <option value="reciboPublico" {{ old('tipo_archivo') == 'reciboPublico' ? 'selected' : '' }}>Recibo Público reciente del lugar de residencia</option>
                                    <option value="formularioMatricula" {{ old('tipo_archivo') == 'formularioMatricula' ? 'selected' : '' }}>Formulario de matrícula diligenciado e impreso</option>
                                    <option value="fotos" {{ old('tipo_archivo') == 'fotos' ? 'selected' : '' }}>Fotos</option>
                                    <option value="otro" {{ old('tipo_archivo') == 'otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                                @error('tipo_archivo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
 
                            {{-- Número Tarjeta de Identidad --}}
                            <div class="form-group">
                                <label for="tarjetaIdentidad"><i class="fas fa-id-card mr-1"></i> Número Tarjeta de Identidad <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('tarjetaIdentidad') is-invalid @enderror"
                                       id="tarjetaIdentidad"
                                       name="tarjetaIdentidad"
                                       placeholder="Ej: 1020304050"
                                       value="{{ old('tarjetaIdentidad') }}"
                                       maxlength="15"
                                       pattern="[0-9]+"
                                       required>
                                @error('tarjetaIdentidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
 
                            {{-- Archivo PDF --}}
                            <div class="form-group">
                                <label for="archivo"><i class="fas fa-file-pdf mr-1 text-danger"></i> Archivo PDF <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file"
                                           class="custom-file-input @error('archivo') is-invalid @enderror"
                                           id="archivo"
                                           name="archivo"
                                           accept="application/pdf"
                                           required>
                                    <label class="custom-file-label" for="archivo" id="archivoLabel">Seleccionar PDF...</label>
                                </div>
                                @error('archivo')
                                    <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Solo se permiten archivos PDF. Tamaño máximo: 10 MB.</small>
                            </div>
 
                            {{-- Preview nombre archivo --}}
                            <div id="previewArchivo" class="alert alert-info d-none">
                                <i class="fas fa-file-pdf mr-1 text-danger"></i>
                                <span id="nombreArchivo"></span>
                            </div>
 
                            <hr>
 
                            <div class="d-flex justify-content-between">
                                <button type="reset" class="btn btn-secondary" id="btnLimpiar">
                                    <i class="fas fa-broom mr-1"></i> Limpiar
                                </button>
                                <button type="submit" class="btn btn-primary" id="btnSubir">
                                    <i class="fas fa-upload mr-1"></i> Subir Archivo
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
 
            {{-- ===================== PESTAÑA 2: VER Y DESCARGAR ===================== --}}
            <div class="tab-pane fade" id="ver" role="tabpanel">
 
                {{-- Filtro por cédula --}}
                <div class="row mb-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <input type="text" id="filtrotarjetaIdentidad" class="form-control" placeholder="Buscar por número de tarjeta de identidad...">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" id="btnBuscar">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" id="filtroTipo">
                            <option value="">-- Todos los tipos --</option>
                            <option value="tarjetaIdentidad">Tarjeta de identidad</option>
                            <option value="RegistroCivil">Registro civil</option>
                            <option value="CedulaAcudiente">Cedula de ciudadania del acudiente</option>
                            <option value="afiliacionEpsSisben">Afiliación EPS o Sisben</option>
                            <option value="carnetVacunacion">Carnet de vacunación</option>
                            <option value="certificadoUltimosGrados">Certificado de último grado aprobado</option>
                            <option value="reciboPublico">Recibo Público reciente del lugar de residencia</option>
                            <option value="formularioMatricula">Formulario de matrícula diligenciado e impreso</option>
                            <option value="fotos">Fotos</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-secondary btn-block" id="btnLimpiarFiltro">
                            <i class="fas fa-times"></i> Limpiar
                        </button>
                    </div>
                </div>
 
                {{-- Tabla de archivos --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tablaArchivos">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th><i class="fas fa-tag mr-1"></i>Tipo</th>
                                <th><i class="fas fa-id-card mr-1"></i>Tarjeta de identidad</th>
                                <th><i class="fas fa-file-pdf mr-1"></i>Archivo</th>
                                <th><i class="fas fa-calendar mr-1"></i>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($archivos as $archivo)
                            <tr data-tarjeta-identidad="{{ $archivo->tarjetaIdentidad }}" data-tipo="{{ $archivo->tipo_archivo }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ ucfirst(str_replace('_', ' ', $archivo->tipo_archivo)) }}
                                    </span>
                                </td>
                                <td>{{ $archivo->tarjetaIdentidad }}</td>
                                <td>
                                    <i class="fas fa-file-pdf text-danger mr-1"></i>
                                    {{ $archivo->nombre_original }}
                                </td>
                                <td>{{ $archivo->fecha_creacion->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        {{-- Ver PDF --}}
                                        <button type="button"
                                                class="btn btn-sm btn-info btnVerPdf"
                                                data-url="{{ route('gestionArchivos.ver', $archivo->id) }}"
                                                title="Ver PDF">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        {{-- Descargar --}}
                                        <a href="{{ route('gestionArchivos.descargar', $archivo->id) }}"
                                           class="btn btn-sm btn-success"
                                           title="Descargar">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        {{-- Eliminar --}}
                                        <button type="button"
                                                class="btn btn-sm btn-danger btnEliminar"
                                                data-id="{{ $archivo->id }}"
                                                data-nombre="{{ $archivo->nombre_original }}"
                                                title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr id="sinRegistros">
                                <td colspan="6" class="text-center text-muted">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    No hay archivos subidos aún.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
 
                {{-- Paginación --}}
                <div class="d-flex justify-content-end">
                    {{ $archivos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
 
{{-- ===================== MODAL VISOR PDF ===================== --}}
<div class="modal fade" id="modalVisorPdf" tabindex="-1" role="dialog" aria-labelledby="modalVisorPdfLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="modalVisorPdfLabel">
                    <i class="fas fa-file-pdf text-danger mr-2"></i> Visor de PDF
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <iframe id="pdfVisor" src="" width="100%" height="600px" style="border:none;"></iframe>
            </div>
            <div class="modal-footer">
                <a id="btnDescargarModal" href="#" class="btn btn-success">
                    <i class="fas fa-download mr-1"></i> Descargar
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
 
{{-- ===================== MODAL CONFIRMAR ELIMINACIÓN ===================== --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle mr-2"></i>Confirmar Eliminación</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar el archivo <strong id="nombreArchivoEliminar"></strong>?</p>
                <p class="text-danger"><small><i class="fas fa-exclamation-circle"></i> Esta acción no se puede deshacer.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form id="formEliminar" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash mr-1"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
 
@stop
 
@section('css')
<style>
    .custom-file-label::after { content: "Examinar"; }
    #pdfVisor { background: #525659; }
    .table td { vertical-align: middle; }
    .nav-tabs .nav-link { font-weight: 500; }
</style>
@stop
 
@section('js')
<script>
const baseUrl = "{{ url('gestionArchivos') }}";
$(document).ready(function () {
 
    // ── Mostrar nombre del archivo seleccionado ──
    $('#archivo').on('change', function () {
        const file = this.files[0];
        if (file) {
            $('#archivoLabel').text(file.name);
            $('#nombreArchivo').text(file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)');
            $('#previewArchivo').removeClass('d-none');
        }
    });
 
    // ── Limpiar formulario ──
    $('#btnLimpiar').on('click', function () {
        $('#archivoLabel').text('Seleccionar PDF...');
        $('#previewArchivo').addClass('d-none');
    });
 
    // ── Ver PDF en modal ──
    $(document).on('click', '.btnVerPdf', function () {
        const url = $(this).data('url');
        $('#pdfVisor').attr('src', url);
        $('#btnDescargarModal').attr('href', url.replace('/ver/', '/descargar/'));
        $('#modalVisorPdf').modal('show');
    });
 
    // Limpiar iframe al cerrar modal
    $('#modalVisorPdf').on('hidden.bs.modal', function () {
        $('#pdfVisor').attr('src', '');
    });
 
    // ── Eliminar archivo ──
    $(document).on('click', '.btnEliminar', function () {
        const id     = $(this).data('id');
        const nombre = $(this).data('nombre');
        $('#nombreArchivoEliminar').text(nombre);
        $('#formEliminar').attr('action', baseUrl + '/' + id);  // ← usa baseUrl
        $('#modalEliminar').modal('show');
    });
 
    // ── Filtro por cédula y tipo ──
    function filtrarTabla() {
        const tarjetaIdentidad = $('#filtrotarjetaIdentidad').val().trim().toLowerCase();
        const tipo = $('#filtroTipo').val().toLowerCase();
        let visibles = 0;

        // jQuery convierte data-tarjeta-identidad → .data('tarjeta-identidad')
        $('#tablaArchivos tbody tr[data-tarjeta-identidad]').each(function () {
            const fTarjeta = $(this).data('tarjeta-identidad').toString().toLowerCase();
            const fTipo    = $(this).data('tipo').toString().toLowerCase();
            const matchC   = tarjetaIdentidad === '' || fTarjeta.includes(tarjetaIdentidad);
            const matchT   = tipo === '' || fTipo === tipo;

            if (matchC && matchT) {
                $(this).show();
                visibles++;
            } else {
                $(this).hide();
            }
        });

        $('#sinFiltro').remove();
        if (visibles === 0 && $('#tablaArchivos tbody tr[data-tarjeta-identidad]').length > 0) {
            $('#tablaArchivos tbody').append(
                '<tr id="sinFiltro"><td colspan="6" class="text-center text-muted">' +
                '<i class="fas fa-search mr-1"></i>No se encontraron archivos con ese filtro.</td></tr>'
            );
        }
    }
 
    $('#btnBuscar').on('click', filtrarTabla);
    $('#filtrotarjetaIdentidad').on('keyup', function (e) { if (e.key === 'Enter') filtrarTabla(); });
    $('#filtroTipo').on('change', filtrarTabla);
 
    $('#btnLimpiarFiltro').on('click', function () {
        $('#filtrotarjetaIdentidad').val('');
        $('#filtroTipo').val('');
        $('#tablaArchivos tbody tr').show();
        $('#sinFiltro').remove();
    });
 
    // ── Solo números en cédula ──
    $('#tarjetaIdentidad').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
 
});
</script>
@stop