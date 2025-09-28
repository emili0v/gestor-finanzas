 @extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Editar Bono</h1>
            <p class="text-muted">Modifica la información del bono asignado</p>
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
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Editando Bono #{{ str_pad($bono->id, 3, '0', STR_PAD_LEFT) }}
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('ingresos.update', $bono) }}" method="POST">
                @csrf
                @method('PUT')
                
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
                                <option value="{{ $empleado->id }}" 
                                    {{ (old('empleado_id', $bono->empleado_id) == $empleado->id) ? 'selected' : '' }}>
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
                                <option value="{{ $categoria }}" 
                                    {{ (old('categoria_nombre', $bono->categoria->nombre ?? '') == $categoria) ? 'selected' : '' }}>
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
                               value="{{ old('monto', $bono->monto) }}"
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
                               value="{{ old('fecha', $bono->fecha ? \Carbon\Carbon::parse($bono->fecha)->format('Y-m-d') : $bono->created_at->format('Y-m-d')) }}"
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
                              required>{{ old('descripcion', $bono->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        Explica el motivo del bono para que el empleado entienda por qué lo recibe
                    </div>
                </div>

                {{-- Información del cambio --}}
                <div class="alert alert-info">
                    <h6 class="alert-heading">
                        <i class="bi bi-info-circle me-2"></i>Información del Bono Original
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <small>
                                <strong>Creado:</strong> {{ $bono->created_at->format('d/m/Y H:i') }}<br>
                                <strong>Empleado Original:</strong> {{ $bono->empleado->nombre }}<br>
                                <strong>Monto Original:</strong> ${{ number_format($bono->monto, 2) }}
                            </small>
                        </div>
                        <div class="col-md-6">
                            <small>
                                <strong>Última Modificación:</strong> {{ $bono->updated_at->format('d/m/Y H:i') }}<br>
                                <strong>Categoría Original:</strong> {{ $bono->categoria->nombre ?? 'Sin categoría' }}<br>
                                <strong>ID del Bono:</strong> #{{ str_pad($bono->id, 3, '0', STR_PAD_LEFT) }}
                            </small>
                        </div>
                    </div>
                </div>

                {{-- Botones --}}
                <div class="d-flex justify-content-between mt-4">
                    <div class="d-flex gap-2">
                        <a href="{{ route('ingresos.show', $bono) }}" class="btn btn-info">
                            <i class="bi bi-eye me-1"></i>Ver Detalles
                        </a>
                        <a href="{{ route('ingresos.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-1"></i>Cancelar
                        </a>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-1"></i>Actualizar Bono
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JavaScript para mejoras de UX --}}
<script>
// Auto-rellenar descripción según el tipo de bono seleccionado (solo si está vacía)
document.getElementById('categoria_nombre').addEventListener('change', function() {
    const descripcion = document.getElementById('descripcion');
    const tipo = this.value;
    
    // Solo auto-completar si la descripción está vacía
    if (tipo && descripcion.value.trim() === '') {
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

// Confirmar cambios antes de enviar
document.querySelector('form').addEventListener('submit', function(e) {
    const confirmacion = confirm('¿Estás seguro de que quieres actualizar este bono?');
    if (!confirmacion) {
        e.preventDefault();
    }
});
</script>

<style>
.text-gray-800 {
    color: #5a5c69 !important;
}
</style>
@endsection
