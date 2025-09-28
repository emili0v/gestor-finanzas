@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Asignar Bono al Personal</h1>
            <p class="text-muted">Asigna bonos, comisiones y horas extra a empleados del hotel</p>
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

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('bonos.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    {{-- Seleccionar Empleado --}}
                    <div class="col-md-6 mb-3">
                        <label for="empleado_id" class="form-label">Empleado *</label>
                        <select class="form-select @error('empleado_id') is-invalid @enderror" 
                                id="empleado_id" 
                                name="empleado_id" 
                                required>
                            <option value="">Seleccionar empleado</option>
                            @foreach($empleados as $empleado)
                                <option value="{{ $empleado->id }}" {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                                    {{ $empleado->nombre }} - {{ $empleado->role->nombre ?? 'Sin rol' }}
                                </option>
                            @endforeach
                        </select>
                        @error('empleado_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tipo de Bono --}}
                    <div class="col-md-6 mb-3">
                        <label for="categoria_nombre" class="form-label">Tipo de Bono *</label>
                        <select class="form-select @error('categoria_nombre') is-invalid @enderror" 
                                id="categoria_nombre" 
                                name="categoria_nombre" 
                                required>
                            <option value="">Seleccionar tipo</option>
                            @foreach($categoriasBonos as $categoria)
                                <option value="{{ $categoria }}" {{ old('categoria_nombre') == $categoria ? 'selected' : '' }}>
                                    {{ $categoria }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- Monto del Bono --}}
                    <div class="col-md-6 mb-3">
                        <label for="monto" class="form-label">Monto del Bono (CLP) *</label>
                        <input type="number" 
                               class="form-control @error('monto') is-invalid @enderror" 
                               id="monto" 
                               name="monto" 
                               value="{{ old('monto') }}"
                               placeholder="Ej: 50000"
                               min="1"
                               step="1000"
                               required>
                        @error('monto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Fecha --}}
                    <div class="col-md-6 mb-3">
                        <label for="fecha" class="form-label">Fecha *</label>
                        <input type="date" 
                               class="form-control @error('fecha') is-invalid @enderror" 
                               id="fecha" 
                               name="fecha" 
                               value="{{ old('fecha', date('Y-m-d')) }}"
                               required>
                        @error('fecha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Descripción --}}
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción del Bono *</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                              id="descripcion" 
                              name="descripcion" 
                              rows="3"
                              placeholder="Ej: Horas extra durante evento de fin de año"
                              required>{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        Explica el motivo del bono para que el empleado entienda por qué lo recibe
                    </div>
                </div>

                {{-- Información del Hotel --}}
                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <h6 class="card-title text-primary">
                            <i class="bi bi-info-circle me-2"></i>Ejemplos de Bonos en Hotel Yatehue
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Horas Extra:</strong> Trabajo adicional en eventos o temporada alta<br>
                                <strong>Comisión por Tours:</strong> Venta de tours o actividades a huéspedes<br>
                                <strong>Bono Ocupación:</strong> Incentivo por alta ocupación hotelera
                            </div>
                            <div class="col-md-6">
                                <strong>Incentivo Puntualidad:</strong> Asistencia perfecta durante el mes<br>
                                <strong>Bono Desempeño:</strong> Evaluaciones positivas de huéspedes<br>
                                <strong>Bono Temporada Alta:</strong> Trabajo durante fechas especiales
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Botones --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('ingresos.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i>Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-1"></i>Asignar Bono
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JavaScript para mejoras de UX --}}
<script>
// Auto-rellenar descripción según el tipo de bono seleccionado
document.getElementById('categoria_nombre').addEventListener('change', function() {
    const descripcion = document.getElementById('descripcion');
    const empleadoSelect = document.getElementById('empleado_id');
    const tipo = this.value;
    
    if (tipo && descripcion.value === '') {
        let sugerencia = '';
        switch(tipo) {
            case 'Horas Extra':
                sugerencia = 'Horas extra trabajadas durante ';
                break;
            case 'Comisión por Tours':
                sugerencia = 'Comisión por venta de tours a huéspedes';
                break;
            case 'Bono Ocupación':
                sugerencia = 'Bono por alta ocupación hotelera del mes';
                break;
            case 'Incentivo Puntualidad':
                sugerencia = 'Bono por asistencia perfecta durante el mes';
                break;
            case 'Bono Desempeño':
                sugerencia = 'Bono por excelente evaluación de huéspedes';
                break;
            case 'Bono Temporada Alta':
                sugerencia = 'Bono por trabajo durante temporada alta';
                break;
        }
        if (sugerencia) {
            descripcion.value = sugerencia;
        }
    }
});

// Formatear monto mientras se escribe
document.getElementById('monto').addEventListener('input', function(e) {
    let valor = e.target.value.replace(/[^0-9]/g, '');
    e.target.value = valor;
});
</script>
@endsection