@extends('adminlte::page')

@section('title', 'Dashboard - Estudiantes Matriculados')

@section('content_header')
    <h1>Dashboard - Panel de Estudiantes</h1>
@stop

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-users mr-2"></i>Estudiantes Matriculados</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Identificación</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Grado</th>
                            <th>Sede</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alumnos as $alumno)
                            <tr>
                                <td>{{ $alumno->tipo_identi }} {{ $alumno->num_identi }}</td>
                                <td>{{ $alumno->primer_nombre }} {{ $alumno->segundo_nombre }}</td>
                                <td>{{ $alumno->primer_apellido }} {{ $alumno->segundo_apellido }}</td>
                                <td>{{ $alumno->grado }} - {{ $alumno->grupo }}</td>
                                <td>{{ $alumno->sede }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalAlumno{{ $alumno->num_identi }}" title="Ver toda la información">
                                        <i class="fas fa-eye"></i> Ver Detalles
                                    </button>
                                    <a href="{{ route('matriculas.edit', $alumno->num_identi) }}" class="btn btn-sm btn-warning" title="Editar información">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                </td>
                            </tr>
                            
                            <!-- Modal Detalle Alumno -->
                            <div class="modal fade" id="modalAlumno{{ $alumno->num_identi }}" tabindex="-1" role="dialog" aria-labelledby="modalAlumnoLabel{{ $alumno->num_identi }}" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                            <h5 class="modal-title" id="modalAlumnoLabel{{ $alumno->num_identi }}">
                                                <i class="fas fa-user-graduate mr-2"></i> Detalles del Estudiante: {{ $alumno->primer_nombre }} {{ $alumno->primer_apellido }}
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <div class="row m-0">
                                                <!-- Columna Información Personal -->
                                                <div class="col-md-4 p-4 border-right">
                                                    <h4 class="text-info border-bottom pb-2"><i class="fas fa-address-card mr-2"></i>Información Personal</h4>
                                                    <dl class="row mt-3 mb-0">
                                                        <dt class="col-sm-5">Identificación</dt>
                                                        <dd class="col-sm-7">{{ $alumno->tipo_identi }} {{ $alumno->num_identi }}</dd>
                                                        <dt class="col-sm-5">Nombres</dt>
                                                        <dd class="col-sm-7">{{ $alumno->primer_nombre }} {{ $alumno->segundo_nombre }}</dd>
                                                        <dt class="col-sm-5">Apellidos</dt>
                                                        <dd class="col-sm-7">{{ $alumno->primer_apellido }} {{ $alumno->segundo_apellido }}</dd>
                                                        <dt class="col-sm-5">Fecha Nac.</dt>
                                                        <dd class="col-sm-7">{{ $alumno->fecha_nacimiento }} (Edad: {{ $alumno->edad }})</dd>
                                                        <dt class="col-sm-5">Género</dt>
                                                        <dd class="col-sm-7">{{ $alumno->genero }}</dd>
                                                        <dt class="col-sm-5">RH / Sangre</dt>
                                                        <dd class="col-sm-7">{{ $alumno->grupo_sanguineo }} {{ $alumno->rh }}</dd>
                                                        <dt class="col-sm-5">Sisbén</dt>
                                                        <dd class="col-sm-7">Niv: {{ $alumno->nivel_sisben }} / Ptos: {{ $alumno->puntaje_sisben }}</dd>
                                                        <dt class="col-sm-5">EPS</dt>
                                                        <dd class="col-sm-7">{{ $alumno->eps }}</dd>
                                                    </dl>
                                                </div>

                                                <!-- Columna Contacto y Ubicación -->
                                                <div class="col-md-4 p-4 border-right">
                                                    <h4 class="text-info border-bottom pb-2"><i class="fas fa-map-marker-alt mr-2"></i>Contacto y Matrícula</h4>
                                                    <dl class="row mt-3 mb-0">
                                                        <dt class="col-sm-5">Sede</dt>
                                                        <dd class="col-sm-7">{{ $alumno->sede }}</dd>
                                                        <dt class="col-sm-5">Jornada</dt>
                                                        <dd class="col-sm-7">{{ $alumno->jornada }}</dd>
                                                        <dt class="col-sm-5">Grado/Grupo</dt>
                                                        <dd class="col-sm-7">{{ $alumno->grado }} - {{ $alumno->grupo }}</dd>
                                                        <dt class="col-sm-5">Dirección</dt>
                                                        <dd class="col-sm-7">{{ $alumno->direccion }}, {{ $alumno->barrio }} (Estrato {{ $alumno->estrato }})</dd>
                                                        <dt class="col-sm-5">Ciudad/Dep.</dt>
                                                        <dd class="col-sm-7">{{ $alumno->ciudad }}, {{ $alumno->departamento }}</dd>
                                                        <dt class="col-sm-5">Teléfono</dt>
                                                        <dd class="col-sm-7">{{ $alumno->telefono }}</dd>
                                                        <dt class="col-sm-5">Celular</dt>
                                                        <dd class="col-sm-7">{{ $alumno->celular }}</dd>
                                                        <dt class="col-sm-5">Email</dt>
                                                        <dd class="col-sm-7" style="word-wrap: break-word;">{{ $alumno->email }}</dd>
                                                    </dl>
                                                </div>

                                                <!-- Columna Responsable y Acudiente -->
                                                <div class="col-md-4 p-4">
                                                    <h4 class="text-info border-bottom pb-2"><i class="fas fa-user-friends mr-2"></i>Responsables</h4>
                                                    @if($alumno->responsable)
                                                        <h6 class="font-weight-bold mt-3 text-secondary">Acudiente Principal</h6>
                                                        <dl class="row mb-2">
                                                            <dt class="col-sm-4">Nombre</dt>
                                                            <dd class="col-sm-8">{{ $alumno->responsable->nombre_acudiente }}</dd>
                                                            <dt class="col-sm-4">Cédula</dt>
                                                            <dd class="col-sm-8">{{ $alumno->responsable->cedula_acudiente }} ({{ $alumno->responsable->lugar_expediciona }})</dd>
                                                            <dt class="col-sm-4">Teléfono</dt>
                                                            <dd class="col-sm-8">{{ $alumno->responsable->telefono_acudiente }}</dd>
                                                            <dt class="col-sm-4">Correo</dt>
                                                            <dd class="col-sm-8" style="word-wrap: break-word;">{{ $alumno->responsable->correo_acudiente }}</dd>
                                                        </dl>
                                                        
                                                        @if($alumno->responsable->nombre_padre)
                                                            <h6 class="font-weight-bold mt-3 text-secondary">Padre</h6>
                                                            <dl class="row mb-2">
                                                                <dt class="col-sm-4">Nombre</dt>
                                                                <dd class="col-sm-8">{{ $alumno->responsable->nombre_padre }}</dd>
                                                                <dt class="col-sm-4">Cédula</dt>
                                                                <dd class="col-sm-8">{{ $alumno->responsable->cedula_padre }} ({{ $alumno->responsable->lugar_expedicionp }})</dd>
                                                                <dt class="col-sm-4">Teléfono</dt>
                                                                <dd class="col-sm-8">{{ $alumno->responsable->telefono_padre }}</dd>
                                                                <dt class="col-sm-4">Correo</dt>
                                                                <dd class="col-sm-8" style="word-wrap: break-word;">{{ $alumno->responsable->correo_padre }}</dd>
                                                            </dl>
                                                        @endif
                                                        
                                                        @if($alumno->responsable->nombre_madre)
                                                            <h6 class="font-weight-bold mt-3 text-secondary">Madre</h6>
                                                            <dl class="row mb-2">
                                                                <dt class="col-sm-4">Nombre</dt>
                                                                <dd class="col-sm-8">{{ $alumno->responsable->nombre_madre }}</dd>
                                                                <dt class="col-sm-4">Cédula</dt>
                                                                <dd class="col-sm-8">{{ $alumno->responsable->cedula_madre }} ({{ $alumno->responsable->lugar_expedicionm }})</dd>
                                                                <dt class="col-sm-4">Teléfono</dt>
                                                                <dd class="col-sm-8">{{ $alumno->responsable->telefono_madre }}</dd>
                                                                <dt class="col-sm-4">Correo</dt>
                                                                <dd class="col-sm-8" style="word-wrap: break-word;">{{ $alumno->responsable->correo_madre }}</dd>
                                                            </dl>
                                                        @endif
                                                    @else
                                                        <p class="text-muted mt-3">No hay información de responsables registrada.</p>
                                                    @endif
                                                    
                                                    @if($alumno->historialAcademico)
                                                        <h4 class="text-info border-bottom pb-2 mt-4"><i class="fas fa-history mr-2"></i>Historial Académico Completo</h4>
                                                        
                                                        @if($alumno->historialAcademico->ha_año)
                                                        <h6 class="font-weight-bold mt-3 text-secondary">Último Año</h6>
                                                        <dl class="row mb-2">
                                                            <dt class="col-sm-4">Año</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_año }}</dd>
                                                            <dt class="col-sm-4">Grado</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_grado }}</dd>
                                                            <dt class="col-sm-4">Institución</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_institucion }}</dd>
                                                            <dt class="col-sm-4">Localidad</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_localidad }}</dd>
                                                            <dt class="col-sm-4">Categor.</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_categoria }}</dd>
                                                        </dl>
                                                        @endif

                                                        @if($alumno->historialAcademico->ha_año1)
                                                        <h6 class="font-weight-bold mt-3 text-secondary">Año Anterior (1)</h6>
                                                        <dl class="row mb-2">
                                                            <dt class="col-sm-4">Año</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_año1 }}</dd>
                                                            <dt class="col-sm-4">Grado</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_grado1 }}</dd>
                                                            <dt class="col-sm-4">Institución</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_institucion1 }}</dd>
                                                            <dt class="col-sm-4">Localidad</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_localidad1 }}</dd>
                                                            <dt class="col-sm-4">Categor.</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_categoria1 }}</dd>
                                                        </dl>
                                                        @endif

                                                        @if($alumno->historialAcademico->ha_año2)
                                                        <h6 class="font-weight-bold mt-3 text-secondary">Año Anterior (2)</h6>
                                                        <dl class="row mb-2">
                                                            <dt class="col-sm-4">Año</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_año2 }}</dd>
                                                            <dt class="col-sm-4">Grado</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_grado2 }}</dd>
                                                            <dt class="col-sm-4">Institución</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_institucion2 }}</dd>
                                                            <dt class="col-sm-4">Localidad</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_localidad2 }}</dd>
                                                            <dt class="col-sm-4">Categor.</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_categoria2 }}</dd>
                                                        </dl>
                                                        @endif

                                                        @if($alumno->historialAcademico->ha_año3)
                                                        <h6 class="font-weight-bold mt-3 text-secondary">Año Anterior (3)</h6>
                                                        <dl class="row mb-2">
                                                            <dt class="col-sm-4">Año</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_año3 }}</dd>
                                                            <dt class="col-sm-4">Grado</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_grado3 }}</dd>
                                                            <dt class="col-sm-4">Institución</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_institucion3 }}</dd>
                                                            <dt class="col-sm-4">Localidad</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_localidad3 }}</dd>
                                                            <dt class="col-sm-4">Categor.</dt>
                                                            <dd class="col-sm-8">{{ $alumno->historialAcademico->ha_categoria3 }}</dd>
                                                        </dl>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <!-- Fila de Datos Adicionales si los hay -->
                                            <div class="row m-0 bg-light border-top">
                                                <div class="col-12 p-4">
                                                    <h5 class="text-info"><i class="fas fa-plus-circle mr-2"></i>Datos Adicionales</h5>
                                                    <div class="d-flex flex-wrap mt-2">
                                                        @if($alumno->limitaciones) <span class="badge badge-warning p-2 mr-2 mb-2">Limitación: {{ $alumno->limitaciones }}</span> @endif
                                                        @if($alumno->VDCA == 'si') <span class="badge badge-danger p-2 mr-2 mb-2">Victima de Conflicto Armado</span> @endif
                                                        @if($alumno->ESDD == 'si') <span class="badge badge-danger p-2 mr-2 mb-2">Desplazado</span> @endif
                                                        @if($alumno->HDDDGA == 'si') <span class="badge badge-danger p-2 mr-2 mb-2">Hijo de Desmovilizados</span> @endif
                                                        @if($alumno->municipio_expulsor) <span class="badge badge-secondary p-2 mr-2 mb-2">Mun. Expulsor: {{ $alumno->municipio_expulsor }}</span> @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-info-circle fa-2x mb-3 d-block"></i>
                                    No hay estudiantes matriculados en el sistema en este momento.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Estilos personalizados para mejorar el modal */
        .modal-xl {
            max-width: 1140px;
        }
        .modal-body dl dt {
            color: #6c757d;
            font-weight: 600;
        }
        .modal-body dl dd {
            margin-bottom: 0.5rem;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Inicialización de tooltips si es necesario
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop