@extends('adminlte::page')

@section('title', 'Editar Matrícula')

@section('content_header')
    <h1><i class="fas fa-clipboard-list mr-2"></i>Editar Matrícula</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form id="matricula-form" method="POST" action="{{ route('matriculas.update', $alumno->num_identi) }}">
            @csrf
            @method('PUT')

            <div class="card card-outline card-primary mb-3">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="font-weight-bold text-primary" id="lote-label">
                            <i class="fas fa-layer-group mr-1"></i> Sección 1 de 7
                        </span>
                        <span class="badge badge-primary px-3 py-2" id="preguntas-label">
                            Preguntas 1 – 10
                        </span>
                    </div>
                    <div class="progress" style="height: 10px; border-radius: 5px;">
                        <div id="progress-bar"
                             class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                             role="progressbar"
                             style="width: 14.2857%;">
                        </div>
                    </div>
                    <small class="text-muted mt-1 d-block text-right" id="pct-label">14% completado</small>
                </div>
            </div>

            <div id="lote-1" class="lote">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-user mr-2 text-primary"></i>Datos del alumno</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label><span class="badge badge-primary mr-1">1</span> Jornada escolar <span class="text-danger">*</span></label>
                            <select id="p1" name="jornada" class="form-control" onchange="guardar(1, this.value)" value="{{ $alumno->jornada ?? '' }}">
                                <option value="">-- Selecciona --</option>
                                <option>Mañana</option>
                                <option>Tarde</option>
                                <option>Noche</option>
                                <option>Mixta</option>
                            </select>
                            <small class="text-danger d-none" id="err1">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-primary mr-1">2</span> Sede escolar <span class="text-danger">*</span></label>
                            <input type="text" id="p2" name="sede" class="form-control" placeholder="Ej: A1" oninput="guardar(2, this.value)" value="{{ $alumno->sede ?? '' }}">
                            <small class="text-danger d-none" id="err2">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-primary mr-1">3</span> Tipo de identificación <span class="text-danger">*</span></label>
                            <select id="p3" name="tipo_identi" class="form-control" onchange="guardar(3, this.value)" value="{{ $alumno->tipo_identi ?? '' }}">
                                <option value="">-- Selecciona --</option>
                                <option>CC</option>
                                <option>TI</option>
                                <option>CE</option>
                                <option>Pasaporte</option>
                                <option>NIT</option>
                            </select>
                            <small class="text-danger d-none" id="err3">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-primary mr-1">4</span> Número de identificación <span class="text-danger">*</span></label>
                            <input type="text" id="p4" name="num_identi" class="form-control" placeholder="Ej: 1234567890" oninput="guardar(4, this.value)" value="{{ $alumno->num_identi ?? '' }}">
                            <small class="text-danger d-none" id="err4">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-primary mr-1">5</span> Fecha de nacimiento <span class="text-danger">*</span></label>
                            <input type="date" id="p5" name="fecha_nacimiento" class="form-control" onchange="guardar(5, this.value)" value="{{ $alumno->fecha_nacimiento ?? '' }}">
                            <small class="text-danger d-none" id="err5">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-primary mr-1">6</span> Grado al que va a matricularse <span class="text-danger">*</span></label>
                            <input type="text" id="p6" name="grado" class="form-control" placeholder="Ej: Noveno" oninput="guardar(6, this.value)" value="{{ $alumno->grado ?? '' }}">
                            <small class="text-danger d-none" id="err6">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-primary mr-1">7</span> Grupo al que va a matricularse <span class="text-danger">*</span></label>
                            <input type="text" id="p7" name="grupo" class="form-control" placeholder="Ej: 10-A" oninput="guardar(7, this.value)" value="{{ $alumno->grupo ?? '' }}">
                            <small class="text-danger d-none" id="err7">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-primary mr-1">8</span> Ciudad de residencia <span class="text-danger">*</span></label>
                            <input type="text" id="p8" name="ciudad" class="form-control" placeholder="Ej: Bogotá" oninput="guardar(8, this.value)" value="{{ $alumno->ciudad ?? '' }}">
                            <small class="text-danger d-none" id="err8">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-primary mr-1">9</span> Departamento de residencia <span class="text-danger">*</span></label>
                            <input type="text" id="p9" name="departamento" class="form-control" placeholder="Ej: Cundinamarca" oninput="guardar(9, this.value)" value="{{ $alumno->departamento ?? '' }}">
                            <small class="text-danger d-none" id="err9">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-primary mr-1">10</span> Primer apellido del alumno <span class="text-danger">*</span></label>
                            <input type="text" id="p10" name="primer_apellido" class="form-control" placeholder="Ej: Pérez" oninput="guardar(10, this.value)" value="{{ $alumno->primer_apellido ?? '' }}">
                            <small class="text-danger d-none" id="err10">Este campo es obligatorio.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div id="lote-2" class="lote d-none">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-user-graduate mr-2 text-success"></i>Datos personales y de salud</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label><span class="badge badge-success mr-1">11</span> Segundo apellido del alumno <span class="text-danger">*</span></label>
                            <input type="text" id="p11" name="segundo_apellido" class="form-control" placeholder="Ej: García" oninput="guardar(11, this.value)" value="{{ $alumno->segundo_apellido ?? '' }}">
                            <small class="text-danger d-none" id="err11">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-success mr-1">12</span> Primer nombre del alumno <span class="text-danger">*</span></label>
                            <input type="text" id="p12" name="primer_nombre" class="form-control" placeholder="Ej: Juan" oninput="guardar(12, this.value)" value="{{ $alumno->primer_nombre ?? '' }}">
                            <small class="text-danger d-none" id="err12">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-success mr-1">13</span> Segundo nombre del alumno <span class="text-danger">*</span></label>
                            <input type="text" id="p13" name="segundo_nombre" class="form-control" placeholder="Ej: David" oninput="guardar(13, this.value)" value="{{ $alumno->segundo_nombre ?? '' }}">
                            <small class="text-danger d-none" id="err13">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-success mr-1">14</span> Género del alumno <span class="text-danger">*</span></label>
                            <select id="p14" name="genero" class="form-control" onchange="guardar(14, this.value)" value="{{ $alumno->genero ?? '' }}">
                                <option value="">-- Selecciona --</option>
                                <option>Masculino</option>
                                <option>Femenino</option>
                                <option>Otro</option>
                            </select>
                            <small class="text-danger d-none" id="err14">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-success mr-1">15</span> Edad del alumno <span class="text-danger">*</span></label>
                            <input type="number" id="p15" name="edad" class="form-control" min="1" max="99" placeholder="Ej: 15" oninput="guardar(15, this.value)" value="{{ $alumno->edad ?? '' }}">
                            <small class="text-danger d-none" id="err15">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-success mr-1">16</span> Grupo sanguíneo <span class="text-danger">*</span></label>
                            <select id="p16" name="grupo_sanguineo" class="form-control" onchange="guardar(16, this.value)" value="{{ $alumno->grupo_sanguineo ?? '' }}">
                                <option value="">-- Selecciona --</option>
                                <option>A</option>
                                <option>B</option>
                                <option>AB</option>
                                <option>O</option>
                            </select>
                            <small class="text-danger d-none" id="err16">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-success mr-1">17</span> RH <span class="text-danger">*</span></label>
                            <select id="p17" name="rh" class="form-control" onchange="guardar(17, this.value)" value="{{ $alumno->rh ?? '' }}">
                                <option value="">-- Selecciona --</option>
                                <option>Positivo</option>
                                <option>Negativo</option>
                            </select>
                            <small class="text-danger d-none" id="err17">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-success mr-1">18</span> Puntaje SISBÉN <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" id="p18" name="puntaje_sisben" class="form-control" placeholder="Ej: 45.20" oninput="guardar(18, this.value)" value="{{ $alumno->puntaje_sisben ?? '' }}">
                            <small class="text-danger d-none" id="err18">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-success mr-1">19</span> Nivel SISBÉN <span class="text-danger">*</span></label>
                            <input type="text" id="p19" name="nivel_sisben" class="form-control" placeholder="Ej: Nivel 1" oninput="guardar(19, this.value)" value="{{ $alumno->nivel_sisben ?? '' }}">
                            <small class="text-danger d-none" id="err19">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-success mr-1">20</span> EPS del alumno <span class="text-danger">*</span></label>
                            <input type="text" id="p20" name="eps" class="form-control" placeholder="Ej: Sura" oninput="guardar(20, this.value)" value="{{ $alumno->eps ?? '' }}">
                            <small class="text-danger d-none" id="err20">Este campo es obligatorio.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div id="lote-3" class="lote d-none">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-hospital-symbol mr-2 text-info"></i>Datos de contacto y salud</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">21</span> Correo electrónico del alumno <span class="text-danger">*</span></label>
                            <input type="email" id="p21" name="email" class="form-control" placeholder="correo@ejemplo.com" oninput="guardar(21, this.value)" value="{{ $alumno->email ?? '' }}">
                            <small class="text-danger d-none" id="err21">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">22</span> ARS / IPS (si aplica)</label>
                            <input type="text" id="p22" name="ars_ips" class="form-control" placeholder="Ej: Salud Total" oninput="guardar(22, this.value)" value="{{ $alumno->ars_ips ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">23</span> Localidad de residencia <span class="text-danger">*</span></label>
                            <input type="text" id="p23" name="localidad" class="form-control" placeholder="Ej: Suba" oninput="guardar(23, this.value)" value="{{ $alumno->localidad ?? '' }}">
                            <small class="text-danger d-none" id="err23">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">24</span> Estrato social <span class="text-danger">*</span></label>
                            <select id="p24" name="estrato" class="form-control" onchange="guardar(24, this.value)" value="{{ $alumno->estrato ?? '' }}">
                                <option value="">-- Selecciona --</option>
                                <option>1</option><option>2</option><option>3</option>
                                <option>4</option><option>5</option><option>6</option>
                            </select>
                            <small class="text-danger d-none" id="err24">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">25</span> Barrio de residencia <span class="text-danger">*</span></label>
                            <input type="text" id="p25" name="barrio" class="form-control" placeholder="Ej: La Floresta" oninput="guardar(25, this.value)" value="{{ $alumno->barrio ?? '' }}">
                            <small class="text-danger d-none" id="err25">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">26</span> Dirección de residencia <span class="text-danger">*</span></label>
                            <input type="text" id="p26" name="direccion" class="form-control" placeholder="Ej: Calle 12 # 34-56" oninput="guardar(26, this.value)" value="{{ $alumno->direccion ?? '' }}">
                            <small class="text-danger d-none" id="err26">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">27</span> Teléfono fijo de contacto <span class="text-danger">*</span></label>
                            <input type="tel" id="p27" name="telefono" class="form-control" placeholder="Ej: 1234567" oninput="guardar(27, this.value)" value="{{ $alumno->telefono ?? '' }}">
                            <small class="text-danger d-none" id="err27">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">28</span> Teléfono móvil del alumno <span class="text-danger">*</span></label>
                            <input type="tel" id="p28" name="celular" class="form-control" placeholder="Ej: 3001234567" oninput="guardar(28, this.value)" value="{{ $alumno->celular ?? '' }}">
                            <small class="text-danger d-none" id="err28">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">29</span> Víctima del conflicto armado <span class="text-danger">*</span></label>
                            <div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="p29_si" name="VDCA" class="custom-control-input" value="Sí" onchange="guardar(29, this.value)">
                                    <label class="custom-control-label" for="p29_si">Sí</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="p29_no" name="VDCA" class="custom-control-input" value="No" onchange="guardar(29, this.value)">
                                    <label class="custom-control-label" for="p29_no">No</label>
                                </div>
                            </div>
                            <small class="text-danger d-none" id="err29">Selecciona una opción.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">30</span> En situación de desplazamiento <span class="text-danger">*</span></label>
                            <div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="p30_si" name="ESDD" class="custom-control-input" value="Sí" onchange="guardar(30, this.value)">
                                    <label class="custom-control-label" for="p30_si">Sí</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="p30_no" name="ESDD" class="custom-control-input" value="No" onchange="guardar(30, this.value)">
                                    <label class="custom-control-label" for="p30_no">No</label>
                                </div>
                            </div>
                            <small class="text-danger d-none" id="err30">Selecciona una opción.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div id="lote-4" class="lote d-none">
                <div class="card card-outline card-secondary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-history mr-2 text-secondary"></i>Información de desplazamiento y salud</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label><span class="badge badge-secondary mr-1">31</span> Hijos de desvinculados de grupos armados <span class="text-danger">*</span></label>
                            <div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="p31_si" name="HDDDGA" class="custom-control-input" value="Sí" onchange="guardar(31, this.value)">
                                    <label class="custom-control-label" for="p31_si">Sí</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="p31_no" name="HDDDGA" class="custom-control-input" value="No" onchange="guardar(31, this.value)">
                                    <label class="custom-control-label" for="p31_no">No</label>
                                </div>
                            </div>
                            <small class="text-danger d-none" id="err31">Selecciona una opción.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-secondary mr-1">32</span> Municipio expulsor <span class="text-danger">*</span></label>
                            <input type="text" id="p32" name="municipio_expulsor" class="form-control" placeholder="Ej: Villavicencio" oninput="guardar(32, this.value)" value="{{ $alumno->municipio_expulsor ?? '' }}">
                            <small class="text-danger d-none" id="err32">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-secondary mr-1">33</span> Departamento expulsor <span class="text-danger">*</span></label>
                            <input type="text" id="p33" name="departamento_expulsor" class="form-control" placeholder="Ej: Meta" oninput="guardar(33, this.value)" value="{{ $alumno->departamento_expulsor ?? '' }}">
                            <small class="text-danger d-none" id="err33">Este campo es obligatorio.</small>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-secondary mr-1">34</span> Limitaciones o capacidades excepcionales <span class="text-muted">(Opcional)</span></label>
                            <textarea id="p34" name="limitaciones" class="form-control" rows="3" placeholder="Describe las limitaciones" oninput="guardar(34, this.value)" >{{ $alumno->limitaciones ?? '' }}</textarea>
                        </div>

                        <hr>
                        <h5 class="mb-3">Historia académica 1</h5>
                        <div class="form-group">
                            <label><span class="badge badge-secondary mr-1">35</span> Año cursado</label>
                            <input type="text" id="p35" name="ha_año" class="form-control" placeholder="Ej: 2023" oninput="guardar(35, this.value)" value="{{ $alumno->historialAcademico->ha_año ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-secondary mr-1">36</span> Grado cursado</label>
                            <input type="text" id="p36" name="ha_grado" class="form-control" placeholder="Ej: Noveno" oninput="guardar(36, this.value)" value="{{ $alumno->historialAcademico->ha_grado ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-secondary mr-1">37</span> Institución</label>
                            <input type="text" id="p37" name="ha_institucion" class="form-control" placeholder="Nombre del colegio" oninput="guardar(37, this.value)" value="{{ $alumno->historialAcademico->ha_institucion ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-secondary mr-1">38</span> Localidad</label>
                            <input type="text" id="p38" name="ha_localidad" class="form-control" placeholder="Ej: Engativá" oninput="guardar(38, this.value)" value="{{ $alumno->historialAcademico->ha_localidad ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-secondary mr-1">39</span> Colegio público o privado</label>
                            <select id="p39" name="ha_categoria" class="form-control" onchange="guardar(39, this.value)" value="{{ $alumno->historialAcademico->ha_categoria ?? '' }}">
                                <option value="">-- Selecciona --</option>
                                <option>Público</option>
                                <option>Privado</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><span class="badge badge-secondary mr-1">40</span> Año cursado 2</label>
                            <input type="text" id="p40" name="ha_año1" class="form-control" placeholder="Ej: 2022" oninput="guardar(40, this.value)" value="{{ $alumno->historialAcademico->ha_año1 ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div id="lote-5" class="lote d-none">
                <div class="card card-outline card-dark">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-school mr-2 text-dark"></i>Historia académica adicional</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label><span class="badge badge-dark mr-1">41</span> Grado cursado 2</label>
                            <input type="text" id="p41" name="ha_grado1" class="form-control" placeholder="Ej: Octavo" oninput="guardar(41, this.value)" value="{{ $alumno->historialAcademico->ha_grado1 ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-dark mr-1">42</span> Institución 2</label>
                            <input type="text" id="p42" name="ha_institucion1" class="form-control" placeholder="Nombre del colegio" oninput="guardar(42, this.value)" value="{{ $alumno->historialAcademico->ha_institucion1 ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-dark mr-1">43</span> Localidad 2</label>
                            <input type="text" id="p43" name="ha_localidad1" class="form-control" placeholder="Ej: Kennedy" oninput="guardar(43, this.value)" value="{{ $alumno->historialAcademico->ha_localidad1 ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-dark mr-1">44</span> Colegio público o privado 2</label>
                            <select id="p44" name="ha_categoria1" class="form-control" onchange="guardar(44, this.value)" value="{{ $alumno->historialAcademico->ha_categoria1 ?? '' }}">
                                <option value="">-- Selecciona --</option>
                                <option>Público</option>
                                <option>Privado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-dark mr-1">45</span> Año cursado 3</label>
                            <input type="text" id="p45" name="ha_año2" class="form-control" placeholder="Ej: 2021" oninput="guardar(45, this.value)" value="{{ $alumno->historialAcademico->ha_año2 ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-dark mr-1">46</span> Grado cursado 3</label>
                            <input type="text" id="p46" name="ha_grado2" class="form-control" placeholder="Ej: Séptimo" oninput="guardar(46, this.value)" value="{{ $alumno->historialAcademico->ha_grado2 ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-dark mr-1">47</span> Institución 3</label>
                            <input type="text" id="p47" name="ha_institucion2" class="form-control" placeholder="Nombre del colegio" oninput="guardar(47, this.value)" value="{{ $alumno->historialAcademico->ha_institucion2 ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-dark mr-1">48</span> Localidad 3</label>
                            <input type="text" id="p48" name="ha_localidad2" class="form-control" placeholder="Ej: Suba" oninput="guardar(48, this.value)" value="{{ $alumno->historialAcademico->ha_localidad2 ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-dark mr-1">49</span> Colegio público o privado 3</label>
                            <select id="p49" name="ha_categoria2" class="form-control" onchange="guardar(49, this.value)" value="{{ $alumno->historialAcademico->ha_categoria2 ?? '' }}">
                                <option value="">-- Selecciona --</option>
                                <option>Público</option>
                                <option>Privado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-dark mr-1">50</span> Año cursado 4</label>
                            <input type="text" id="p50" name="ha_año3" class="form-control" placeholder="Ej: 2020" oninput="guardar(50, this.value)" value="{{ $alumno->historialAcademico->ha_año3 ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div id="lote-6" class="lote d-none">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-building mr-2 text-info"></i>Historia académica 4 y responsable</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">51</span> Grado cursado 4</label>
                            <input type="text" id="p51" name="ha_grado3" class="form-control" placeholder="Ej: Sexto" oninput="guardar(51, this.value)" value="{{ $alumno->historialAcademico->ha_grado3 ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">52</span> Institución 4</label>
                            <input type="text" id="p52" name="ha_institucion3" class="form-control" placeholder="Nombre del colegio" oninput="guardar(52, this.value)" value="{{ $alumno->historialAcademico->ha_institucion3 ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">53</span> Localidad 4</label>
                            <input type="text" id="p53" name="ha_localidad3" class="form-control" placeholder="Ej: Chapinero" oninput="guardar(53, this.value)" value="{{ $alumno->historialAcademico->ha_localidad3 ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">54</span> Colegio público o privado 4</label>
                            <select id="p54" name="ha_categoria3" class="form-control" onchange="guardar(54, this.value)" value="{{ $alumno->historialAcademico->ha_categoria3 ?? '' }}">
                                <option value="">-- Selecciona --</option>
                                <option>Público</option>
                                <option>Privado</option>
                            </select>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">55</span> Nombre completo del padre <span class="text-danger">*</span></label>
                            <input type="text" id="p55" name="nombre_padre" class="form-control" placeholder="Ej: Carlos López" oninput="guardar(55, this.value)" value="{{ $alumno->responsable->nombre_padre ?? '' }}">
                            <small class="text-danger d-none" id="err55">Este campo es obligatorio.</small>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">56</span> Documento del padre <span class="text-danger">*</span></label>
                            <input type="text" id="p56" name="cedula_padre" class="form-control" placeholder="Ej: 1234567890" oninput="guardar(56, this.value)" value="{{ $alumno->responsable->cedula_padre ?? '' }}">
                            <small class="text-danger d-none" id="err56">Este campo es obligatorio.</small>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">57</span> Lugar expedición documento padre <span class="text-danger">*</span></label>
                            <input type="text" id="p57" name="lugar_expedicionp" class="form-control" placeholder="Ej: Bogotá" oninput="guardar(57, this.value)" value="{{ $alumno->responsable->lugar_expedicionp ?? '' }}">
                            <small class="text-danger d-none" id="err57">Este campo es obligatorio.</small>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">58</span> Teléfono del padre <span class="text-danger">*</span></label>
                            <input type="tel" id="p58" name="telefono_padre" class="form-control" placeholder="Ej: 3001234567" oninput="guardar(58, this.value)" value="{{ $alumno->responsable->telefono_padre ?? '' }}">
                            <small class="text-danger d-none" id="err58">Este campo es obligatorio.</small>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">59</span> Correo electrónico del padre <span class="text-danger">*</span></label>
                            <input type="email" id="p59" name="correo_padre" class="form-control" placeholder="correo@ejemplo.com" oninput="guardar(59, this.value)" value="{{ $alumno->responsable->correo_padre ?? '' }}">
                            <small class="text-danger d-none" id="err59">Este campo es obligatorio.</small>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-info mr-1">60</span> Nombre completo de la madre <span class="text-danger">*</span></label>
                            <input type="text" id="p60" name="nombre_madre" class="form-control" placeholder="Ej: Ana Martínez" oninput="guardar(60, this.value)" value="{{ $alumno->responsable->nombre_madre ?? '' }}">
                            <small class="text-danger d-none" id="err60">Este campo es obligatorio.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div id="lote-7" class="lote d-none">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-user-tie mr-2 text-warning"></i>Responsable del alumno</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label><span class="badge badge-warning mr-1">61</span> Documento de la madre <span class="text-danger">*</span></label>
                            <input type="text" id="p61" name="cedula_madre" class="form-control" placeholder="Ej: 0987654321" oninput="guardar(61, this.value)" value="{{ $alumno->responsable->cedula_madre ?? '' }}">
                            <small class="text-danger d-none" id="err61">Este campo es obligatorio.</small>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-warning mr-1">62</span> Lugar expedición documento madre <span class="text-danger">*</span></label>
                            <input type="text" id="p62" name="lugar_expedicionm" class="form-control" placeholder="Ej: Medellín" oninput="guardar(62, this.value)" value="{{ $alumno->responsable->lugar_expedicionm ?? '' }}">
                            <small class="text-danger d-none" id="err62">Este campo es obligatorio.</small>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-warning mr-1">63</span> Teléfono de la madre <span class="text-danger">*</span></label>
                            <input type="tel" id="p63" name="telefono_madre" class="form-control" placeholder="Ej: 3009876543" oninput="guardar(63, this.value)" value="{{ $alumno->responsable->telefono_madre ?? '' }}">
                            <small class="text-danger d-none" id="err63">Este campo es obligatorio.</small>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-warning mr-1">64</span> Correo electrónico de la madre <span class="text-danger">*</span></label>
                            <input type="email" id="p64" name="correo_madre" class="form-control" placeholder="correo@ejemplo.com" oninput="guardar(64, this.value)" value="{{ $alumno->responsable->correo_madre ?? '' }}">
                            <small class="text-danger d-none" id="err64">Este campo es obligatorio.</small>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-warning mr-1">65</span> Nombre completo del acudiente <span class="text-danger">*</span></label>
                            <input type="text" id="p65" name="nombre_acudiente" class="form-control" placeholder="Ej: Luis Gómez" oninput="guardar(65, this.value)" value="{{ $alumno->responsable->nombre_acudiente ?? '' }}">
                            <small class="text-danger d-none" id="err65">Este campo es obligatorio.</small>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-warning mr-1">66</span> Documento del acudiente <span class="text-danger">*</span></label>
                            <input type="text" id="p66" name="cedula_acudiente" class="form-control" placeholder="Ej: 1122334455" oninput="guardar(66, this.value)" value="{{ $alumno->responsable->cedula_acudiente ?? '' }}">
                            <small class="text-danger d-none" id="err66">Este campo es obligatorio.</small>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-warning mr-1">67</span> Lugar expedición documento acudiente <span class="text-danger">*</span></label>
                            <input type="text" id="p67" name="lugar_expediciona" class="form-control" placeholder="Ej: Cali" oninput="guardar(67, this.value)" value="{{ $alumno->responsable->lugar_expediciona ?? '' }}">
                            <small class="text-danger d-none" id="err67">Este campo es obligatorio.</small>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-warning mr-1">68</span> Teléfono del acudiente <span class="text-danger">*</span></label>
                            <input type="tel" id="p68" name="telefono_acudiente" class="form-control" placeholder="Ej: 3123456789" oninput="guardar(68, this.value)" value="{{ $alumno->responsable->telefono_acudiente ?? '' }}">
                            <small class="text-danger d-none" id="err68">Este campo es obligatorio.</small>
                        </div>
                        <div class="form-group">
                            <label><span class="badge badge-warning mr-1">69</span> Correo electrónico del acudiente <span class="text-danger">*</span></label>
                            <input type="email" id="p69" name="correo_acudiente" class="form-control" placeholder="correo@ejemplo.com" oninput="guardar(69, this.value)" value="{{ $alumno->responsable->correo_acudiente ?? '' }}">
                            <small class="text-danger d-none" id="err69">Este campo es obligatorio.</small>
                        </div>
                    </div>
                </div>
            </div>

            <div id="resumen" class="d-none">
                <div class="card card-outline card-success">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-check-circle fa-5x text-success mb-3"></i>
                        <h3 class="font-weight-bold">¡Formulario completado!</h3>
                        <p class="text-muted">Todas tus respuestas han sido registradas correctamente.</p>
                        <button type="button" class="btn btn-success btn-lg px-5 mt-2" onclick="enviarFormulario()">
                            <i class="fas fa-paper-plane mr-2"></i>Enviar Matrícula
                        </button>
                    </div>
                </div>
            </div>

            <div id="nav-btns" class="d-flex justify-content-between mb-4">
                <button type="button" class="btn btn-secondary px-4 d-none" id="btn-anterior" onclick="cambiarLote(-1)">
                    <i class="fas fa-arrow-left mr-2"></i>Anterior
                </button>
                <button type="button" class="btn btn-primary px-4 ml-auto" id="btn-siguiente" onclick="cambiarLote(1)">
                    Siguiente <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@stop

@section('js')
<script>
const respuestas = {};
let loteActual = 1;
const totalLotes = 7;
const opcionales = [22, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54];

function guardar(id, val) {
    respuestas[id] = val;
}

function guardarCheck(id) {
    const checks = document.querySelectorAll(`input[name="p${id}"]:checked`);
    respuestas[id] = Array.from(checks).map(c => c.value).join(', ');
}

function validarLote(n) {
    let valido = true;
    const inicio = (n - 1) * 10 + 1;
    const fin = n * 10;
    for (let id = inicio; id <= fin; id++) {
        const err = document.getElementById('err' + id);
        if (!err) continue;
        const val = respuestas[id];
        if (!opcionales.includes(id) && (!val || val.trim() === '')) {
            err.classList.remove('d-none');
            valido = false;
        } else {
            err.classList.add('d-none');
        }
    }
    if (!valido) {
        const primerError = document.querySelector(`#lote-${n} .text-danger:not(.d-none)`);
        if (primerError) primerError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    return valido;
}

function actualizarUI() {
    const inicio = (loteActual - 1) * 10 + 1;
    const fin = Math.min(loteActual * 10, 69);
    const pct = Math.round((loteActual / totalLotes) * 100);
    document.getElementById('lote-label').innerHTML = `<i class="fas fa-layer-group mr-1"></i> Sección ${loteActual} de ${totalLotes}`;
    document.getElementById('preguntas-label').textContent = `Preguntas ${inicio} – ${fin}`;
    document.getElementById('progress-bar').style.width = pct + '%';
    document.getElementById('pct-label').textContent = pct + '% completado';
    document.getElementById('btn-anterior').classList.toggle('d-none', loteActual === 1);
    const btnSig = document.getElementById('btn-siguiente');
    if (loteActual === totalLotes) {
        btnSig.innerHTML = 'Finalizar <i class="fas fa-check ml-2"></i>';
        btnSig.classList.replace('btn-primary', 'btn-success');
    } else {
        btnSig.innerHTML = 'Siguiente <i class="fas fa-arrow-right ml-2"></i>';
        btnSig.classList.replace('btn-success', 'btn-primary');
    }
}

function cambiarLote(dir) {
    if (dir === 1 && !validarLote(loteActual)) return;
    document.getElementById('lote-' + loteActual).classList.add('d-none');
    loteActual += dir;
    if (loteActual > totalLotes) {
        document.getElementById('nav-btns').classList.add('d-none');
        document.getElementById('resumen').classList.remove('d-none');
        document.getElementById('progress-bar').style.width = '100%';
        document.getElementById('pct-label').textContent = '100% completado';
        document.getElementById('lote-label').innerHTML = '<i class="fas fa-check-circle mr-1 text-success"></i> Completado';
        document.getElementById('preguntas-label').textContent = '69 / 69';
        window.scrollTo({ top: 0, behavior: 'smooth' });
        return;
    }
    document.getElementById('lote-' + loteActual).classList.remove('d-none');
    actualizarUI();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function enviarFormulario() {
    document.getElementById('matricula-form').submit();
}

actualizarUI();
</script>
<script>
$(document).ready(function() {
    const v1 = "{{ $alumno->jornada ?? '' }}";
    if(document.getElementById('p1')) { document.getElementById('p1').value = v1; respuestas[1] = v1; }
    const v2 = "{{ $alumno->sede ?? '' }}";
    if(document.getElementById('p2')) { document.getElementById('p2').value = v2; respuestas[2] = v2; }
    const v3 = "{{ $alumno->tipo_identi ?? '' }}";
    if(document.getElementById('p3')) { document.getElementById('p3').value = v3; respuestas[3] = v3; }
    const v4 = "{{ $alumno->num_identi ?? '' }}";
    if(document.getElementById('p4')) { document.getElementById('p4').value = v4; respuestas[4] = v4; }
    const v5 = "{{ $alumno->fecha_nacimiento ?? '' }}";
    if(document.getElementById('p5')) { document.getElementById('p5').value = v5; respuestas[5] = v5; }
    const v6 = "{{ $alumno->grado ?? '' }}";
    if(document.getElementById('p6')) { document.getElementById('p6').value = v6; respuestas[6] = v6; }
    const v7 = "{{ $alumno->grupo ?? '' }}";
    if(document.getElementById('p7')) { document.getElementById('p7').value = v7; respuestas[7] = v7; }
    const v8 = "{{ $alumno->ciudad ?? '' }}";
    if(document.getElementById('p8')) { document.getElementById('p8').value = v8; respuestas[8] = v8; }
    const v9 = "{{ $alumno->departamento ?? '' }}";
    if(document.getElementById('p9')) { document.getElementById('p9').value = v9; respuestas[9] = v9; }
    const v10 = "{{ $alumno->primer_apellido ?? '' }}";
    if(document.getElementById('p10')) { document.getElementById('p10').value = v10; respuestas[10] = v10; }
    const v11 = "{{ $alumno->segundo_apellido ?? '' }}";
    if(document.getElementById('p11')) { document.getElementById('p11').value = v11; respuestas[11] = v11; }
    const v12 = "{{ $alumno->primer_nombre ?? '' }}";
    if(document.getElementById('p12')) { document.getElementById('p12').value = v12; respuestas[12] = v12; }
    const v13 = "{{ $alumno->segundo_nombre ?? '' }}";
    if(document.getElementById('p13')) { document.getElementById('p13').value = v13; respuestas[13] = v13; }
    const v14 = "{{ $alumno->genero ?? '' }}";
    if(document.getElementById('p14')) { document.getElementById('p14').value = v14; respuestas[14] = v14; }
    const v15 = "{{ $alumno->edad ?? '' }}";
    if(document.getElementById('p15')) { document.getElementById('p15').value = v15; respuestas[15] = v15; }
    const v16 = "{{ $alumno->grupo_sanguineo ?? '' }}";
    if(document.getElementById('p16')) { document.getElementById('p16').value = v16; respuestas[16] = v16; }
    const v17 = "{{ $alumno->rh ?? '' }}";
    if(document.getElementById('p17')) { document.getElementById('p17').value = v17; respuestas[17] = v17; }
    const v18 = "{{ $alumno->puntaje_sisben ?? '' }}";
    if(document.getElementById('p18')) { document.getElementById('p18').value = v18; respuestas[18] = v18; }
    const v19 = "{{ $alumno->nivel_sisben ?? '' }}";
    if(document.getElementById('p19')) { document.getElementById('p19').value = v19; respuestas[19] = v19; }
    const v20 = "{{ $alumno->eps ?? '' }}";
    if(document.getElementById('p20')) { document.getElementById('p20').value = v20; respuestas[20] = v20; }
    const v21 = "{{ $alumno->email ?? '' }}";
    if(document.getElementById('p21')) { document.getElementById('p21').value = v21; respuestas[21] = v21; }
    const v22 = "{{ $alumno->ars_ips ?? '' }}";
    if(document.getElementById('p22')) { document.getElementById('p22').value = v22; respuestas[22] = v22; }
    const v23 = "{{ $alumno->localidad ?? '' }}";
    if(document.getElementById('p23')) { document.getElementById('p23').value = v23; respuestas[23] = v23; }
    const v24 = "{{ $alumno->estrato ?? '' }}";
    if(document.getElementById('p24')) { document.getElementById('p24').value = v24; respuestas[24] = v24; }
    const v25 = "{{ $alumno->barrio ?? '' }}";
    if(document.getElementById('p25')) { document.getElementById('p25').value = v25; respuestas[25] = v25; }
    const v26 = "{{ $alumno->direccion ?? '' }}";
    if(document.getElementById('p26')) { document.getElementById('p26').value = v26; respuestas[26] = v26; }
    const v27 = "{{ $alumno->telefono ?? '' }}";
    if(document.getElementById('p27')) { document.getElementById('p27').value = v27; respuestas[27] = v27; }
    const v28 = "{{ $alumno->celular ?? '' }}";
    if(document.getElementById('p28')) { document.getElementById('p28').value = v28; respuestas[28] = v28; }
    const v32 = "{{ $alumno->municipio_expulsor ?? '' }}";
    if(document.getElementById('p32')) { document.getElementById('p32').value = v32; respuestas[32] = v32; }
    const v33 = "{{ $alumno->departamento_expulsor ?? '' }}";
    if(document.getElementById('p33')) { document.getElementById('p33').value = v33; respuestas[33] = v33; }
    const v34 = "{{ $alumno->limitaciones ?? '' }}";
    if(document.getElementById('p34')) { document.getElementById('p34').value = v34; respuestas[34] = v34; }
    const v35 = "{{ $alumno->historialAcademico->ha_año ?? '' }}";
    if(document.getElementById('p35')) { document.getElementById('p35').value = v35; respuestas[35] = v35; }
    const v36 = "{{ $alumno->historialAcademico->ha_grado ?? '' }}";
    if(document.getElementById('p36')) { document.getElementById('p36').value = v36; respuestas[36] = v36; }
    const v37 = "{{ $alumno->historialAcademico->ha_institucion ?? '' }}";
    if(document.getElementById('p37')) { document.getElementById('p37').value = v37; respuestas[37] = v37; }
    const v38 = "{{ $alumno->historialAcademico->ha_localidad ?? '' }}";
    if(document.getElementById('p38')) { document.getElementById('p38').value = v38; respuestas[38] = v38; }
    const v39 = "{{ $alumno->historialAcademico->ha_categoria ?? '' }}";
    if(document.getElementById('p39')) { document.getElementById('p39').value = v39; respuestas[39] = v39; }
    const v40 = "{{ $alumno->historialAcademico->ha_año1 ?? '' }}";
    if(document.getElementById('p40')) { document.getElementById('p40').value = v40; respuestas[40] = v40; }
    const v41 = "{{ $alumno->historialAcademico->ha_grado1 ?? '' }}";
    if(document.getElementById('p41')) { document.getElementById('p41').value = v41; respuestas[41] = v41; }
    const v42 = "{{ $alumno->historialAcademico->ha_institucion1 ?? '' }}";
    if(document.getElementById('p42')) { document.getElementById('p42').value = v42; respuestas[42] = v42; }
    const v43 = "{{ $alumno->historialAcademico->ha_localidad1 ?? '' }}";
    if(document.getElementById('p43')) { document.getElementById('p43').value = v43; respuestas[43] = v43; }
    const v44 = "{{ $alumno->historialAcademico->ha_categoria1 ?? '' }}";
    if(document.getElementById('p44')) { document.getElementById('p44').value = v44; respuestas[44] = v44; }
    const v45 = "{{ $alumno->historialAcademico->ha_año2 ?? '' }}";
    if(document.getElementById('p45')) { document.getElementById('p45').value = v45; respuestas[45] = v45; }
    const v46 = "{{ $alumno->historialAcademico->ha_grado2 ?? '' }}";
    if(document.getElementById('p46')) { document.getElementById('p46').value = v46; respuestas[46] = v46; }
    const v47 = "{{ $alumno->historialAcademico->ha_institucion2 ?? '' }}";
    if(document.getElementById('p47')) { document.getElementById('p47').value = v47; respuestas[47] = v47; }
    const v48 = "{{ $alumno->historialAcademico->ha_localidad2 ?? '' }}";
    if(document.getElementById('p48')) { document.getElementById('p48').value = v48; respuestas[48] = v48; }
    const v49 = "{{ $alumno->historialAcademico->ha_categoria2 ?? '' }}";
    if(document.getElementById('p49')) { document.getElementById('p49').value = v49; respuestas[49] = v49; }
    const v50 = "{{ $alumno->historialAcademico->ha_año3 ?? '' }}";
    if(document.getElementById('p50')) { document.getElementById('p50').value = v50; respuestas[50] = v50; }
    const v51 = "{{ $alumno->historialAcademico->ha_grado3 ?? '' }}";
    if(document.getElementById('p51')) { document.getElementById('p51').value = v51; respuestas[51] = v51; }
    const v52 = "{{ $alumno->historialAcademico->ha_institucion3 ?? '' }}";
    if(document.getElementById('p52')) { document.getElementById('p52').value = v52; respuestas[52] = v52; }
    const v53 = "{{ $alumno->historialAcademico->ha_localidad3 ?? '' }}";
    if(document.getElementById('p53')) { document.getElementById('p53').value = v53; respuestas[53] = v53; }
    const v54 = "{{ $alumno->historialAcademico->ha_categoria3 ?? '' }}";
    if(document.getElementById('p54')) { document.getElementById('p54').value = v54; respuestas[54] = v54; }
    const v55 = "{{ $alumno->responsable->nombre_padre ?? '' }}";
    if(document.getElementById('p55')) { document.getElementById('p55').value = v55; respuestas[55] = v55; }
    const v56 = "{{ $alumno->responsable->cedula_padre ?? '' }}";
    if(document.getElementById('p56')) { document.getElementById('p56').value = v56; respuestas[56] = v56; }
    const v57 = "{{ $alumno->responsable->lugar_expedicionp ?? '' }}";
    if(document.getElementById('p57')) { document.getElementById('p57').value = v57; respuestas[57] = v57; }
    const v58 = "{{ $alumno->responsable->telefono_padre ?? '' }}";
    if(document.getElementById('p58')) { document.getElementById('p58').value = v58; respuestas[58] = v58; }
    const v59 = "{{ $alumno->responsable->correo_padre ?? '' }}";
    if(document.getElementById('p59')) { document.getElementById('p59').value = v59; respuestas[59] = v59; }
    const v60 = "{{ $alumno->responsable->nombre_madre ?? '' }}";
    if(document.getElementById('p60')) { document.getElementById('p60').value = v60; respuestas[60] = v60; }
    const v61 = "{{ $alumno->responsable->cedula_madre ?? '' }}";
    if(document.getElementById('p61')) { document.getElementById('p61').value = v61; respuestas[61] = v61; }
    const v62 = "{{ $alumno->responsable->lugar_expedicionm ?? '' }}";
    if(document.getElementById('p62')) { document.getElementById('p62').value = v62; respuestas[62] = v62; }
    const v63 = "{{ $alumno->responsable->telefono_madre ?? '' }}";
    if(document.getElementById('p63')) { document.getElementById('p63').value = v63; respuestas[63] = v63; }
    const v64 = "{{ $alumno->responsable->correo_madre ?? '' }}";
    if(document.getElementById('p64')) { document.getElementById('p64').value = v64; respuestas[64] = v64; }
    const v65 = "{{ $alumno->responsable->nombre_acudiente ?? '' }}";
    if(document.getElementById('p65')) { document.getElementById('p65').value = v65; respuestas[65] = v65; }
    const v66 = "{{ $alumno->responsable->cedula_acudiente ?? '' }}";
    if(document.getElementById('p66')) { document.getElementById('p66').value = v66; respuestas[66] = v66; }
    const v67 = "{{ $alumno->responsable->lugar_expediciona ?? '' }}";
    if(document.getElementById('p67')) { document.getElementById('p67').value = v67; respuestas[67] = v67; }
    const v68 = "{{ $alumno->responsable->telefono_acudiente ?? '' }}";
    if(document.getElementById('p68')) { document.getElementById('p68').value = v68; respuestas[68] = v68; }
    const v69 = "{{ $alumno->responsable->correo_acudiente ?? '' }}";
    if(document.getElementById('p69')) { document.getElementById('p69').value = v69; respuestas[69] = v69; }
    const v29 = "{{ $alumno->VDCA == 1 ? 'Sí' : 'No' }}"; if(v29==='Sí') { document.getElementById('p29_si').checked = true; } else if(v29==='No') { document.getElementById('p29_no').checked = true; } respuestas[29] = v29;
    const v30 = "{{ $alumno->ESDD == 1 ? 'Sí' : 'No' }}"; if(v30==='Sí') { document.getElementById('p30_si').checked = true; } else if(v30==='No') { document.getElementById('p30_no').checked = true; } respuestas[30] = v30;
    const v31 = "{{ $alumno->HDDDGA == 1 ? 'Sí' : 'No' }}"; if(v31==='Sí') { document.getElementById('p31_si').checked = true; } else if(v31==='No') { document.getElementById('p31_no').checked = true; } respuestas[31] = v31;
});
</script>
@stop