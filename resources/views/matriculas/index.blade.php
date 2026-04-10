@extends('adminlte::page')

@section('title', 'Formulario de Matrícula')

@section('content_header')
    <h1><i class="fas fa-clipboard-list mr-2"></i>Formulario de Matrícula</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">

        {{-- Progreso general --}}
        <div class="card card-outline card-primary mb-3">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="font-weight-bold text-primary" id="lote-label">
                        <i class="fas fa-layer-group mr-1"></i> Sección 1 de 3
                    </span>
                    <span class="badge badge-primary px-3 py-2" id="preguntas-label">
                        Preguntas 1 – 10
                    </span>
                </div>
                <div class="progress" style="height: 10px; border-radius: 5px;">
                    <div id="progress-bar"
                         class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                         role="progressbar"
                         style="width: 33.33%;">
                    </div>
                </div>
                <small class="text-muted mt-1 d-block text-right" id="pct-label">33% completado</small>
            </div>
        </div>

        {{-- Lote 1 --}}
        <div id="lote-1" class="lote">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user mr-2 text-primary"></i>Datos Personales
                    </h3>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label><span class="badge badge-primary mr-1">1</span> ¿Cuál es tu nombre completo? <span class="text-danger">*</span></label>
                        <input type="text" id="p1" class="form-control" placeholder="Ej: Juan Pérez García" oninput="guardar(1, this.value)">
                        <small class="text-danger d-none" id="err1">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-primary mr-1">2</span> ¿Cuál es tu número de identificación? <span class="text-danger">*</span></label>
                        <input type="text" id="p2" class="form-control" placeholder="Ej: 1234567890" oninput="guardar(2, this.value)">
                        <small class="text-danger d-none" id="err2">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-primary mr-1">3</span> ¿Cuál es tu género? <span class="text-danger">*</span></label>
                        <select id="p3" class="form-control" onchange="guardar(3, this.value)">
                            <option value="">-- Selecciona --</option>
                            <option>Masculino</option>
                            <option>Femenino</option>
                            <option>Otro</option>
                            <option>Prefiero no decir</option>
                        </select>
                        <small class="text-danger d-none" id="err3">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-primary mr-1">4</span> ¿Cuál es tu fecha de nacimiento? <span class="text-danger">*</span></label>
                        <input type="date" id="p4" class="form-control" onchange="guardar(4, this.value)">
                        <small class="text-danger d-none" id="err4">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-primary mr-1">5</span> ¿Cuál es tu correo electrónico? <span class="text-danger">*</span></label>
                        <input type="email" id="p5" class="form-control" placeholder="correo@ejemplo.com" oninput="guardar(5, this.value)">
                        <small class="text-danger d-none" id="err5">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-primary mr-1">6</span> ¿Cuál es tu número de teléfono? <span class="text-danger">*</span></label>
                        <input type="tel" id="p6" class="form-control" placeholder="Ej: 3001234567" oninput="guardar(6, this.value)">
                        <small class="text-danger d-none" id="err6">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-primary mr-1">7</span> ¿Cuál es tu dirección de residencia? <span class="text-danger">*</span></label>
                        <input type="text" id="p7" class="form-control" placeholder="Ej: Calle 123 # 45-67" oninput="guardar(7, this.value)">
                        <small class="text-danger d-none" id="err7">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-primary mr-1">8</span> ¿En qué ciudad vives? <span class="text-danger">*</span></label>
                        <select id="p8" class="form-control" onchange="guardar(8, this.value)">
                            <option value="">-- Selecciona --</option>
                            <option>Bogotá</option>
                            <option>Medellín</option>
                            <option>Cali</option>
                            <option>Barranquilla</option>
                            <option>Otra</option>
                        </select>
                        <small class="text-danger d-none" id="err8">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-primary mr-1">9</span> ¿Tienes alguna discapacidad? <span class="text-danger">*</span></label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p9_si" name="p9" class="custom-control-input" value="Sí" onchange="guardar(9, this.value)">
                                <label class="custom-control-label" for="p9_si">Sí</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p9_no" name="p9" class="custom-control-input" value="No" onchange="guardar(9, this.value)">
                                <label class="custom-control-label" for="p9_no">No</label>
                            </div>
                        </div>
                        <small class="text-danger d-none" id="err9">Selecciona una opción.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-secondary mr-1">10</span> Si respondiste sí, descríbela brevemente. <span class="text-muted">(Opcional)</span></label>
                        <textarea id="p10" class="form-control" rows="3" placeholder="Describe tu condición..." oninput="guardar(10, this.value)"></textarea>
                    </div>

                </div>
            </div>
        </div>

        {{-- Lote 2 --}}
        <div id="lote-2" class="lote d-none">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-graduation-cap mr-2 text-success"></i>Información Académica
                    </h3>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label><span class="badge badge-success mr-1">11</span> ¿Cuál es tu nivel educativo actual? <span class="text-danger">*</span></label>
                        <select id="p11" class="form-control" onchange="guardar(11, this.value)">
                            <option value="">-- Selecciona --</option>
                            <option>Bachillerato</option>
                            <option>Técnico</option>
                            <option>Tecnólogo</option>
                            <option>Universitario</option>
                            <option>Posgrado</option>
                        </select>
                        <small class="text-danger d-none" id="err11">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-success mr-1">12</span> ¿En qué institución estudiaste anteriormente? <span class="text-danger">*</span></label>
                        <input type="text" id="p12" class="form-control" placeholder="Nombre de la institución" oninput="guardar(12, this.value)">
                        <small class="text-danger d-none" id="err12">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-success mr-1">13</span> ¿Estás trabajando actualmente? <span class="text-danger">*</span></label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p13_si" name="p13" class="custom-control-input" value="Sí" onchange="guardar(13, this.value)">
                                <label class="custom-control-label" for="p13_si">Sí</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p13_no" name="p13" class="custom-control-input" value="No" onchange="guardar(13, this.value)">
                                <label class="custom-control-label" for="p13_no">No</label>
                            </div>
                        </div>
                        <small class="text-danger d-none" id="err13">Selecciona una opción.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-success mr-1">14</span> ¿Cuál es tu estrato socioeconómico? <span class="text-danger">*</span></label>
                        <select id="p14" class="form-control" onchange="guardar(14, this.value)">
                            <option value="">-- Selecciona --</option>
                            <option>1</option><option>2</option><option>3</option>
                            <option>4</option><option>5</option><option>6</option>
                        </select>
                        <small class="text-danger d-none" id="err14">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-success mr-1">15</span> ¿Qué materias te interesan? <span class="text-danger">*</span></label>
                        <div>
                            @foreach(['Matemáticas','Ciencias','Humanidades','Arte','Tecnología'] as $materia)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="p15_{{ $loop->index }}" name="p15" value="{{ $materia }}" onchange="guardarCheck(15)">
                                <label class="custom-control-label" for="p15_{{ $loop->index }}">{{ $materia }}</label>
                            </div>
                            @endforeach
                        </div>
                        <small class="text-danger d-none" id="err15">Selecciona al menos una opción.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-success mr-1">16</span> ¿Has cursado algún semestre antes? <span class="text-danger">*</span></label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p16_si" name="p16" class="custom-control-input" value="Sí" onchange="guardar(16, this.value)">
                                <label class="custom-control-label" for="p16_si">Sí</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p16_no" name="p16" class="custom-control-input" value="No" onchange="guardar(16, this.value)">
                                <label class="custom-control-label" for="p16_no">No</label>
                            </div>
                        </div>
                        <small class="text-danger d-none" id="err16">Selecciona una opción.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-success mr-1">17</span> ¿Cuántos semestres has cursado? <span class="text-danger">*</span></label>
                        <input type="number" id="p17" class="form-control" min="0" placeholder="Ej: 3" oninput="guardar(17, this.value)">
                        <small class="text-danger d-none" id="err17">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-success mr-1">18</span> ¿En qué jornada prefieres estudiar? <span class="text-danger">*</span></label>
                        <select id="p18" class="form-control" onchange="guardar(18, this.value)">
                            <option value="">-- Selecciona --</option>
                            <option>Mañana</option><option>Tarde</option>
                            <option>Noche</option><option>Virtual</option>
                        </select>
                        <small class="text-danger d-none" id="err18">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-success mr-1">19</span> ¿Requieres beca o apoyo económico? <span class="text-danger">*</span></label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p19_si" name="p19" class="custom-control-input" value="Sí" onchange="guardar(19, this.value)">
                                <label class="custom-control-label" for="p19_si">Sí</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p19_no" name="p19" class="custom-control-input" value="No" onchange="guardar(19, this.value)">
                                <label class="custom-control-label" for="p19_no">No</label>
                            </div>
                        </div>
                        <small class="text-danger d-none" id="err19">Selecciona una opción.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-success mr-1">20</span> ¿Por qué deseas matricularte en este programa? <span class="text-danger">*</span></label>
                        <textarea id="p20" class="form-control" rows="3" placeholder="Escribe tu motivación..." oninput="guardar(20, this.value)"></textarea>
                        <small class="text-danger d-none" id="err20">Este campo es obligatorio.</small>
                    </div>

                </div>
            </div>
        </div>

        {{-- Lote 3 --}}
        <div id="lote-3" class="lote d-none">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-signature mr-2 text-warning"></i>Información Complementaria
                    </h3>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label><span class="badge badge-warning mr-1">21</span> Nombre de tu acudiente o contacto de emergencia <span class="text-danger">*</span></label>
                        <input type="text" id="p21" class="form-control" placeholder="Nombre completo" oninput="guardar(21, this.value)">
                        <small class="text-danger d-none" id="err21">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-warning mr-1">22</span> Teléfono del acudiente <span class="text-danger">*</span></label>
                        <input type="tel" id="p22" class="form-control" placeholder="Ej: 3009876543" oninput="guardar(22, this.value)">
                        <small class="text-danger d-none" id="err22">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-warning mr-1">23</span> ¿Cuál es tu relación con el acudiente? <span class="text-danger">*</span></label>
                        <select id="p23" class="form-control" onchange="guardar(23, this.value)">
                            <option value="">-- Selecciona --</option>
                            <option>Padre</option><option>Madre</option>
                            <option>Hermano/a</option><option>Cónyuge</option><option>Otro</option>
                        </select>
                        <small class="text-danger d-none" id="err23">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-warning mr-1">24</span> ¿Tienes hijos a cargo? <span class="text-danger">*</span></label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p24_si" name="p24" class="custom-control-input" value="Sí" onchange="guardar(24, this.value)">
                                <label class="custom-control-label" for="p24_si">Sí</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p24_no" name="p24" class="custom-control-input" value="No" onchange="guardar(24, this.value)">
                                <label class="custom-control-label" for="p24_no">No</label>
                            </div>
                        </div>
                        <small class="text-danger d-none" id="err24">Selecciona una opción.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-warning mr-1">25</span> ¿Cómo te enteraste de este programa? <span class="text-danger">*</span></label>
                        <select id="p25" class="form-control" onchange="guardar(25, this.value)">
                            <option value="">-- Selecciona --</option>
                            <option>Redes sociales</option><option>Referido</option>
                            <option>Página web</option><option>Radio/TV</option><option>Otro</option>
                        </select>
                        <small class="text-danger d-none" id="err25">Este campo es obligatorio.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-warning mr-1">26</span> ¿Qué equipos tienes disponibles para estudiar? <span class="text-danger">*</span></label>
                        <div>
                            @foreach(['Computador','Tablet','Celular','Ninguno'] as $equipo)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="p26_{{ $loop->index }}" name="p26" value="{{ $equipo }}" onchange="guardarCheck(26)">
                                <label class="custom-control-label" for="p26_{{ $loop->index }}">{{ $equipo }}</label>
                            </div>
                            @endforeach
                        </div>
                        <small class="text-danger d-none" id="err26">Selecciona al menos una opción.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-warning mr-1">27</span> ¿Tienes acceso a internet en casa? <span class="text-danger">*</span></label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p27_si" name="p27" class="custom-control-input" value="Sí" onchange="guardar(27, this.value)">
                                <label class="custom-control-label" for="p27_si">Sí</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p27_no" name="p27" class="custom-control-input" value="No" onchange="guardar(27, this.value)">
                                <label class="custom-control-label" for="p27_no">No</label>
                            </div>
                        </div>
                        <small class="text-danger d-none" id="err27">Selecciona una opción.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-secondary mr-1">28</span> Observaciones adicionales <span class="text-muted">(Opcional)</span></label>
                        <textarea id="p28" class="form-control" rows="3" placeholder="Cualquier información adicional..." oninput="guardar(28, this.value)"></textarea>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-warning mr-1">29</span> ¿Aceptas el reglamento estudiantil? <span class="text-danger">*</span></label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p29_si" name="p29" class="custom-control-input" value="Sí" onchange="guardar(29, this.value)">
                                <label class="custom-control-label" for="p29_si">Sí, acepto</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p29_no" name="p29" class="custom-control-input" value="No" onchange="guardar(29, this.value)">
                                <label class="custom-control-label" for="p29_no">No</label>
                            </div>
                        </div>
                        <small class="text-danger d-none" id="err29">Debes aceptar el reglamento.</small>
                    </div>

                    <div class="form-group">
                        <label><span class="badge badge-warning mr-1">30</span> ¿Autorizas el tratamiento de tus datos personales? <span class="text-danger">*</span></label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p30_si" name="p30" class="custom-control-input" value="Sí" onchange="guardar(30, this.value)">
                                <label class="custom-control-label" for="p30_si">Sí, autorizo</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="p30_no" name="p30" class="custom-control-input" value="No" onchange="guardar(30, this.value)">
                                <label class="custom-control-label" for="p30_no">No</label>
                            </div>
                        </div>
                        <small class="text-danger d-none" id="err30">Este campo es obligatorio.</small>
                    </div>

                </div>
            </div>
        </div>

        {{-- Pantalla de éxito --}}
        <div id="resumen" class="d-none">
            <div class="card card-outline card-success">
                <div class="card-body text-center py-5">
                    <i class="fas fa-check-circle fa-5x text-success mb-3"></i>
                    <h3 class="font-weight-bold">¡Formulario completado!</h3>
                    <p class="text-muted">Todas tus respuestas han sido registradas correctamente.</p>
                    <button class="btn btn-success btn-lg px-5 mt-2" onclick="enviarFormulario()">
                        <i class="fas fa-paper-plane mr-2"></i>Enviar Matrícula
                    </button>
                </div>
            </div>
        </div>

        {{-- Botones de navegación --}}
        <div id="nav-btns" class="d-flex justify-content-between mb-4">
            <button class="btn btn-secondary px-4 d-none" id="btn-anterior" onclick="cambiarLote(-1)">
                <i class="fas fa-arrow-left mr-2"></i>Anterior
            </button>
            <button class="btn btn-primary px-4 ml-auto" id="btn-siguiente" onclick="cambiarLote(1)">
                Siguiente <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>

    </div>
</div>
@stop

@section('js')
<script>
const respuestas = {};
let loteActual = 1;
const totalLotes = 3;
const opcionales = [10, 28];

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
    const fin = Math.min(loteActual * 10, 30);
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
        document.getElementById('preguntas-label').textContent = '30 / 30';
        window.scrollTo({ top: 0, behavior: 'smooth' });
        return;
    }
    document.getElementById('lote-' + loteActual).classList.remove('d-none');
    actualizarUI();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function enviarFormulario() {
    // Aquí puedes hacer un fetch/axios POST a tu ruta de Laravel
    toastr.success('¡Matrícula enviada correctamente!', 'Éxito');
    console.log('Respuestas:', respuestas);
}

actualizarUI();
</script>
@stop