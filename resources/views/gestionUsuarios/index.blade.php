@extends('adminlte::page')
@section('plugins.Toastr', true)
@section('title', 'Gestión de Usuarios')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0">Gestión de Usuarios</h1>
        <ol class="breadcrumb float-sm-right m-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
        </ol>
    </div>
@stop

@section('content')
<div class="container-fluid">

    {{-- Estadísticas --}}
    <div class="row mb-3">
        <div class="col-sm-6">
            <div class="info-box bg-primary">
                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total usuarios</span>
                    <span class="info-box-number">{{ $total }}</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="info-box bg-warning">
                <span class="info-box-icon"><i class="fas fa-user-shield"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Administradores</span>
                    <span class="info-box-number">{{ $admins }}</span>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Tabla de usuarios --}}
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-users mr-2"></i>Usuarios registrados</h3>
            <div class="card-tools">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalUsuario" onclick="abrirCrear()">
                    <i class="fas fa-plus mr-1"></i> Nuevo usuario
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0" id="tablaUsuarios">
                <thead class="thead-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Nombre</th>
                        <th>Correo electrónico</th>
                        <th>Rol</th>
                        <th>Creado</th>
                        <th>Estado</th>
                        <th width="120">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbody-usuarios">
                    {{-- Las filas se cargan dinámicamente o con Blade --}}
                    @forelse($users as $user)
                    <tr id="fila-{{ $user->id }}">
                        <td>{{ $user->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-secondary mr-2" style="width:30px;height:30px;line-height:22px;border-radius:50%;font-size:11px">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr(strstr($user->name, ' '), 1, 1)) }}
                                </span>
                                {{ $user->name }}
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge badge-info">
                                {{ $user->rol->nombre ?? 'Sin rol' }}
                            </span>
                        </td>
                        <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : '—' }}</td>
                        <td>
                            <span class="badge {{ $user->estado ? 'badge-success' : 'badge-danger' }}">
                                {{ $user->estado ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-xs btn-info" onclick="abrirEditar({{ $user->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-xs {{ $user->estado ? 'btn-warning' : 'btn-success' }}"
                                    title="{{ $user->estado ? 'Inactivar usuario' : 'Activar usuario' }}"
                                    onclick="toggleEstado({{ $user->id }}, {{ $user->estado }}, '{{ addslashes($user->name) }}')">
                                <i class="fas {{ $user->estado ? 'fa-user-slash' : 'fa-user-check' }}"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No hay usuarios registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="card-footer">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>

{{-- ===================== MODAL CREAR / EDITAR ===================== --}}
<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="modalUsuarioLabel" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalUsuarioLabel">Nuevo usuario</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUsuario" novalidate>
                    @csrf
                    <input type="hidden" id="user-id" value="">

                    <div class="form-group">
                        <label for="u-name">Nombre completo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="u-name" placeholder="Ej. Juan Pérez" required>
                        <div class="invalid-feedback">El nombre es obligatorio.</div>
                    </div>

                    <div class="form-group">
                        <label for="u-email">Correo electrónico <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="u-email" placeholder="correo@ejemplo.com" required>
                        <div class="invalid-feedback">Ingresa un correo válido.</div>
                    </div>

                    <div class="form-group" id="grupo-password">
                        <label for="u-password">Contraseña <span class="text-danger" id="label-pass-req">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="u-password" placeholder="Mínimo 8 caracteres">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="btn-toggle-pass" tabindex="-1">
                                    <i class="fas fa-eye" id="icon-pass"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Indicador de requisitos --}}
                        <div id="password-rules" class="mt-2" style="display:none; font-size:0.82rem;">
                            <div id="rule-length"  class="text-danger"><i class="fas fa-times-circle mr-1"></i>Mínimo 8 caracteres</div>
                            <div id="rule-upper"   class="text-danger"><i class="fas fa-times-circle mr-1"></i>Al menos una mayúscula (A–Z)</div>
                            <div id="rule-lower"   class="text-danger"><i class="fas fa-times-circle mr-1"></i>Al menos una minúscula (a–z)</div>
                            <div id="rule-number"  class="text-danger"><i class="fas fa-times-circle mr-1"></i>Al menos un número (0–9)</div>
                            <div id="rule-special" class="text-danger"><i class="fas fa-times-circle mr-1"></i>Al menos un carácter especial (!@#$...)</div>
                        </div>
                        <div class="invalid-feedback" id="pass-feedback">La contraseña no cumple los requisitos.</div>
                    </div>
                    <div class="form-group">
                       <select class="form-control" id="u-roles" required>
                            <option value="">-- Selecciona un rol --</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Selecciona un rol.</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-guardar" onclick="guardarUsuario()">
                    <i class="fas fa-save mr-1"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ===================== MODAL CONFIRMAR ELIMINAR ===================== --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Confirmar eliminación</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                <p>¿Estás seguro que deseas eliminar a <strong id="nombre-eliminar"></strong>?</p>
                <p class="text-muted small">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btn-confirmar-eliminar">
                    <i class="fas fa-trash mr-1"></i> Eliminar
                </button>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const BASE = "{{ url('/users') }}";
let modoActual = 'crear';
let idEliminar = null;

// ───────────── POLÍTICA DE CONTRASEÑA ─────────────
const passInput = document.getElementById('u-password');
const rules = {
    length:  { el: document.getElementById('rule-length'),  regex: /.{8,}/ },
    upper:   { el: document.getElementById('rule-upper'),   regex: /[A-Z]/ },
    lower:   { el: document.getElementById('rule-lower'),   regex: /[a-z]/ },
    number:  { el: document.getElementById('rule-number'),  regex: /[0-9]/ },
    special: { el: document.getElementById('rule-special'), regex: /[^A-Za-z0-9]/ },
};

function validarPassword(value) {
    let allOk = true;
    for (const key in rules) {
        const ok = rules[key].regex.test(value);
        if (!ok) allOk = false;
        rules[key].el.className = ok ? 'text-success' : 'text-danger';
        rules[key].el.querySelector('i').className = ok
            ? 'fas fa-check-circle mr-1'
            : 'fas fa-times-circle mr-1';
    }
    return allOk;
}

passInput.addEventListener('focus', () => {
    document.getElementById('password-rules').style.display = 'block';
});

passInput.addEventListener('input', () => {
    validarPassword(passInput.value);
});

// Mostrar / ocultar contraseña
document.getElementById('btn-toggle-pass').addEventListener('click', () => {
    const isPass = passInput.type === 'password';
    passInput.type = isPass ? 'text' : 'password';
    document.getElementById('icon-pass').className = isPass ? 'fas fa-eye-slash' : 'fas fa-eye';
});

// ───────────── ABRIR MODAL CREAR ─────────────
function abrirCrear() {
    modoActual = 'crear';
    document.getElementById('modalUsuarioLabel').textContent = 'Nuevo usuario';
    document.getElementById('formUsuario').reset();
    document.getElementById('formUsuario').classList.remove('was-validated');
    document.getElementById('user-id').value = '';
    document.getElementById('grupo-password').querySelector('input').required = true;
    document.getElementById('password-rules').style.display = 'none';
    // Resetear indicadores al abrir
    for (const key in rules) {
        rules[key].el.className = 'text-danger';
        rules[key].el.querySelector('i').className = 'fas fa-times-circle mr-1';
    }
}

// ───────────── ABRIR MODAL EDITAR ─────────────
function abrirEditar(id) {
    modoActual = 'editar';
    document.getElementById('modalUsuarioLabel').textContent = 'Editar usuario';
    document.getElementById('formUsuario').reset();
    document.getElementById('formUsuario').classList.remove('was-validated');
    document.getElementById('user-id').value = id;
    document.getElementById('grupo-password').querySelector('input').required = false;
    document.getElementById('password-rules').style.display = 'none';

    fetch(`${BASE}/${id}/edit`, {
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById('u-name').value  = data.name  || '';
        document.getElementById('u-email').value = data.email || '';
        document.getElementById('u-roles').value = data.rol_id || '';
        $('#modalUsuario').modal('show');
    })
    .catch(() => toastr.error('No se pudo cargar el usuario.'));
}

// ───────────── GUARDAR (crear o editar) ─────────────
function guardarUsuario() {
    const form     = document.getElementById('formUsuario');
    const password = passInput.value;
    const id       = document.getElementById('user-id').value;

    form.classList.add('was-validated');
    if (!form.checkValidity()) return;

    // Validar política si hay contraseña
    if (password) {
        const ok = validarPassword(password);
        document.getElementById('password-rules').style.display = 'block';
        if (!ok) {
            passInput.classList.add('is-invalid');
            return;
        } else {
            passInput.classList.remove('is-invalid');
        }
    } else if (modoActual === 'crear') {
        // En crear, la contraseña es obligatoria
        passInput.classList.add('is-invalid');
        document.getElementById('password-rules').style.display = 'block';
        return;
    }

    const nombre = document.getElementById('u-name').value.trim();
    const email  = document.getElementById('u-email').value.trim();
    const roles  = document.getElementById('u-roles').value;

    if (!roles) {
        alert('Debes seleccionar un rol.');
        return;
    }

    const body = {
        name:  nombre,
        email: email,
        roles: parseInt(roles),
    };
    if (password) body.password = password;

    const url    = modoActual === 'crear' ? BASE : `${BASE}/${id}`;
    const method = modoActual === 'crear' ? 'POST' : 'PUT';

    fetch(url, {
        method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': CSRF,
            'Accept':       'application/json',
        },
        body: JSON.stringify(body),
    })
    .then(r => r.json())
    .then(data => {
        if (data.error)  { alert('Error: ' + data.error); return; }
        if (data.errors) { Object.values(data.errors).flat().forEach(msg => alert(msg)); return; }
        $('#modalUsuario').modal('hide');
        toastr.success('Usuario guardado correctamente.');
        setTimeout(() => location.reload(), 800);
    })
    .catch(err => alert('Error de red: ' + err));
}

// ───────────── CONFIRMAR ELIMINAR ─────────────
const TOGGLE_BASE = "{{ url('/users') }}";

function toggleEstado(id, estadoActual, nombre) {
    const accion = estadoActual ? 'inactivar' : 'activar';

    if (!confirm(`¿Estás seguro que deseas ${accion} a ${nombre}?`)) return;

    fetch(`${BASE}/${id}/toggle-estado`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': CSRF,
            'Accept': 'application/json',
        },
    })
    .then(r => r.json())
    .then(data => {
        if (data.error) {
            alert(data.error);  // ← cambiado
            return;
        }
        alert(data.mensaje);    // ← cambiado
        setTimeout(() => location.reload(), 800);
    })
    .catch(() => alert('Error de red. Intenta de nuevo.')); // ← cambiado
}

document.getElementById('btn-confirmar-eliminar').addEventListener('click', function () {
    if (!idEliminar) return;
    fetch(`${BASE}/${idEliminar}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
    })
    .then(r => r.json())
    .then(() => {
        $('#modalEliminar').modal('hide');
        toastr.success('Usuario eliminado.');
        setTimeout(() => location.reload(), 1000);
    })
    .catch(() => toastr.error('No se pudo eliminar. Intenta de nuevo.'));
});
</script>
@stop