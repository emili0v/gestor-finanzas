@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Crear Nuevo Empleado</h1>
            <p class="text-muted">Completa los datos para registrar un nuevo miembro del equipo.</p>
        </div>
    </div>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Mostrar mensaje de éxito --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('empleados.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    {{-- Nombre Completo --}}
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre Completo *</label>
                        <input type="text" 
                               class="form-control @error('nombre') is-invalid @enderror" 
                               id="nombre" 
                               name="nombre" 
                               value="{{ old('nombre') }}"
                               placeholder="Ej: Juan Pérez García"
                               required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Cargo/Rol --}}
                    <div class="col-md-6 mb-3">
                        <label for="role_id" class="form-label">Cargo *</label>
                        <select class="form-select @error('role_id') is-invalid @enderror" 
                                id="role_id" 
                                name="role_id" 
                                required>
                            <option value="">Seleccionar cargo</option>
                            @if(isset($roles))
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ $role->nombre }}
                                    </option>
                                @endforeach
                            @else
                                <option value="1">Administrador</option>
                                <option value="2">Empleado</option>
                                <option value="3">Contador</option>
                            @endif
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- RUT --}}
                    <div class="col-md-8 mb-3">
                        <label for="rut" class="form-label">RUT (sin puntos ni guión) *</label>
                        <input type="text" 
                               class="form-control @error('rut') is-invalid @enderror" 
                               id="rut" 
                               name="rut" 
                               value="{{ old('rut') }}"
                               placeholder="12345678"
                               required>
                        @error('rut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Dígito Verificador --}}
                    <div class="col-md-4 mb-3">
                        <label for="dig_verificador" class="form-label">Dígito Verificador *</label>
                        <input type="text" 
                               class="form-control @error('dig_verificador') is-invalid @enderror" 
                               id="dig_verificador" 
                               name="dig_verificador" 
                               value="{{ old('dig_verificador') }}"
                               placeholder="9" 
                               maxlength="1"
                               required>
                        @error('dig_verificador')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- Email --}}
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Correo Electrónico *</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               placeholder="empleado@empresa.com"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Contraseña --}}
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Contraseña *</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               placeholder="Mínimo 8 caracteres"
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Sueldo Bruto --}}
                <div class="mb-3">
                    <label for="sueldo_bruto" class="form-label">Sueldo Bruto (CLP) *</label>
                    <input type="number" 
                           class="form-control @error('sueldo_bruto') is-invalid @enderror" 
                           id="sueldo_bruto" 
                           name="sueldo_bruto" 
                           value="{{ old('sueldo_bruto') }}"
                           placeholder="Ej: 650000" 
                           min="0"
                           step="1000"
                           required>
                    @error('sueldo_bruto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('empleados.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar Empleado</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JavaScript para validación del lado cliente --}}
<script>
document.getElementById('rut').addEventListener('input', function(e) {
    // Solo permitir números
    let valor = e.target.value.replace(/[^0-9]/g, '');
    e.target.value = valor;
});

document.getElementById('dig_verificador').addEventListener('input', function(e) {
    // Solo permitir números y K
    let valor = e.target.value.replace(/[^0-9Kk]/g, '').toUpperCase();
    e.target.value = valor.slice(0, 1); // Solo 1 carácter
});

// Validación antes de enviar
document.querySelector('form').addEventListener('submit', function(e) {
    const rut = document.getElementById('rut').value;
    const dv = document.getElementById('dig_verificador').value;
    
    if (rut.length < 7 || rut.length > 8) {
        e.preventDefault();
        alert('El RUT debe tener entre 7 y 8 dígitos');
        return false;
    }
    
    if (dv.length !== 1) {
        e.preventDefault();
        alert('El dígito verificador debe ser exactamente 1 carácter');
        return false;
    }
});
</script>
@endsection