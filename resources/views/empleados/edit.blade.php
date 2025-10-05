@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Editar Empleado</h1>
            <p class="text-muted">Actualiza la información del empleado.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('empleados.update', $empleado) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre Completo</label>
                        <input type="text" 
                               class="form-control @error('nombre') is-invalid @enderror" 
                               id="nombre" 
                               name="nombre" 
                               value="{{ old('nombre', $empleado->nombre) }}"
                               required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="role_id" class="form-label">Cargo</label>
                        <select class="form-select @error('role_id') is-invalid @enderror" 
                                id="role_id" 
                                name="role_id" 
                                required>
                            <option value="">Seleccionar cargo</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" 
                                    {{ old('role_id', $empleado->role_id) == $role->id ? 'selected' : '' }}>
                                    {{ $role->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="rut" class="form-label">RUT (sin puntos ni guión)</label>
                        <input type="text" 
                               class="form-control @error('rut') is-invalid @enderror" 
                               id="rut" 
                               name="rut" 
                               value="{{ old('rut', $empleado->rut) }}"
                               required>
                        @error('rut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="dig_verificador" class="form-label">Dígito Verificador</label>
                        <input type="text" 
                               class="form-control @error('dig_verificador') is-invalid @enderror" 
                               id="dig_verificador" 
                               name="dig_verificador" 
                               value="{{ old('dig_verificador', $empleado->dig_verificador) }}"
                               maxlength="1"
                               required>
                        @error('dig_verificador')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="alert alert-info">
                    <h6 class="alert-heading">
                        <i class="bi bi-info-circle me-2"></i>Información del Empleado
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <small>
                                <strong>Fecha de registro:</strong> {{ $empleado->created_at->format('d/m/Y H:i') }}<br>
                                <strong>Email:</strong> {{ $empleado->user->email ?? 'No disponible' }}<br>
                                <strong>ID:</strong> EMP{{ str_pad($empleado->id, 3, '0', STR_PAD_LEFT) }}
                            </small>
                        </div>
                        <div class="col-md-6">
                            <small>
                                <strong>Última modificación:</strong> {{ $empleado->updated_at->format('d/m/Y H:i') }}<br>
                                <strong>Sueldo actual:</strong> ${{ number_format($empleado->sueldos->last()->monto_bruto ?? 0, 0, ',', '.') }}
                            </small>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('empleados.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Empleado</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('rut').addEventListener('input', function(e) {
    let valor = e.target.value.replace(/[^0-9]/g, '');
    e.target.value = valor;
});

document.getElementById('dig_verificador').addEventListener('input', function(e) {
    let valor = e.target.value.replace(/[^0-9Kk]/g, '').toUpperCase();
    e.target.value = valor.slice(0, 1);
});
</script>
@endsection