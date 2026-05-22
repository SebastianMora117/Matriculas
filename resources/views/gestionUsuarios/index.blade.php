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
                            <button class="btn btn-xs btn-info" onclick="abrirEditar({{ $user->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-xs btn-danger" onclick="confirmarEliminar({{ $user->id }}, '{{ addslashes($user->name) }}')">
                                <i class="fas fa-trash"></i>
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
                        <label for="u-password">Contraseña <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="u-password" placeholder="Mínimo 8 caracteres">
                        <div class="invalid-feedback">La contraseña debe tener mínimo 8 caracteres.</div>
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

// ───────────── ABRIR MODAL CREAR ─────────────
function abrirCrear() {
    modoActual = 'crear';
    document.getElementById('modalUsuarioLabel').textContent = 'Nuevo usuario';
    document.getElementById('formUsuario').reset();
    document.getElementById('formUsuario').classList.remove('was-validated');
    document.getElementById('user-id').value = '';
    document.getElementById('grupo-password').querySelector('input').required = true;
}

// ───────────── ABRIR MODAL EDITAR ─────────────
function abrirEditar(id) {
    modoActual = 'editar';
    document.getElementById('modalUsuarioLabel').textContent = 'Editar usuario';
    document.getElementById('formUsuario').reset();
    document.getElementById('formUsuario').classList.remove('was-validated');
    document.getElementById('user-id').value = id;
    document.getElementById('grupo-password').querySelector('input').required = false;

    fetch(`${BASE}/${id}/edit`, {
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById('u-name').value    = data.name  || '';
        document.getElementById('u-email').value   = data.email || '';
        document.getElementById('u-roles').value   = data.rol_id || '';
        $('#modalUsuario').modal('show');
    })
    .catch(() => toastr.error('No se pudo cargar el usuario.'));
}

// ───────────── GUARDAR (crear o editar) ─────────────
function guardarUsuario() {
    const form = document.getElementById('formUsuario');
    form.classList.add('was-validated');
    if (!form.checkValidity()) return;

    const id       = document.getElementById('user-id').value;
    const nombre   = document.getElementById('u-name').value.trim();
    const email    = document.getElementById('u-email').value.trim();
    const password = document.getElementById('u-password').value;
    const roles    = document.getElementById('u-roles').value;

    // Verificar en consola que roles tenga valor
    console.log('nombre:', nombre);
    console.log('email:', email);
    console.log('roles:', roles);

    if (!roles) {
        alert('Debes seleccionar un rol.');
        return;
    }

    const body = {
        name:     nombre,
        email:    email,
        roles:    parseInt(roles),
    };

    if (password) {
        body.password = password;
    }

    console.log('Body final enviado:', JSON.stringify(body));

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
        if (data.error) {
            alert('Error del servidor: ' + data.error);
            return;
        }
        if (data.errors) {
            Object.values(data.errors).flat().forEach(msg => alert(msg));
            return;
        }
        $('#modalUsuario').modal('hide');
        alert('Usuario guardado correctamente.');
        setTimeout(() => location.reload(), 800);
    })
    .catch(err => alert('Error de red: ' + err));
}

// ───────────── CONFIRMAR ELIMINAR ─────────────
function confirmarEliminar(id, nombre) {
    idEliminar = id;
    document.getElementById('nombre-eliminar').textContent = nombre;
    $('#modalEliminar').modal('show');
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