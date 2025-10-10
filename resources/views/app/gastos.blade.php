@extends('layouts.user')

@section('content')
<div class="container-fluid">
    {{-- HEADER --}}
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">💰 Mis Gastos Personales</h1>
            <p class="text-muted">Controla tus gastos y mantén tu economía bajo control</p>
        </div>
    </div>

    {{-- ALERTAS DE SISTEMA --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- ALERTAS DE GASTOS (Sistema de notificaciones) --}}
    @if(isset($alertasNoLeidas) && $alertasNoLeidas->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            @foreach($alertasNoLeidas as $alerta)
            <div class="alert alert-{{ $alerta->nivel == 'critico' ? 'danger' : ($alerta->nivel == 'advertencia' ? 'warning' : 'info') }} alert-dismissible fade show" role="alert">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <strong>
                            @if($alerta->nivel == 'critico')
                                🚨 ALERTA CRÍTICA
                            @elseif($alerta->nivel == 'advertencia')
                                ⚠️ ADVERTENCIA
                            @else
                                ℹ️ INFORMACIÓN
                            @endif
                        </strong>
                        <p class="mb-0 mt-2">{{ $alerta->mensaje }}</p>
                        <small class="text-muted">{{ $alerta->fecha_generacion->diffForHumans() }}</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="marcarAlertaLeida({{ $alerta->id }})"></button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- RESUMEN DEL MES --}}
    @if(isset($resumen))
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Sueldo Líquido
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ formatCLP($resumen->sueldo_liquido) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-wallet2 fs-2 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Gastado
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ formatCLP($resumen->total_gastado) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-receipt fs-2 text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-{{ $resumen->porcentaje_gastado >= 90 ? 'danger' : ($resumen->porcentaje_gastado >= 70 ? 'warning' : 'success') }} shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-{{ $resumen->porcentaje_gastado >= 90 ? 'danger' : ($resumen->porcentaje_gastado >= 70 ? 'warning' : 'success') }} text-uppercase mb-1">
                                Porcentaje Gastado
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($resumen->porcentaje_gastado, 1) }}%</div>
                            <div class="progress mt-2" style="height: 10px;">
                                <div class="progress-bar bg-{{ $resumen->porcentaje_gastado >= 90 ? 'danger' : ($resumen->porcentaje_gastado >= 70 ? 'warning' : 'success') }}" 
                                     style="width: {{ min($resumen->porcentaje_gastado, 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Saldo Disponible
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ formatCLP($resumen->saldo_disponible) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-piggy-bank fs-2 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- FORMULARIO DE NUEVO GASTO --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">➕ Registrar Nuevo Gasto</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('app.gastos.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="fecha" class="form-label">Fecha *</label>
                                <input type="date" class="form-control @error('fecha') is-invalid @enderror" 
                                       id="fecha" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required>
                                @error('fecha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="categoria_id" class="form-label">Categoría *</label>
                                <select class="form-select @error('categoria_id') is-invalid @enderror" 
                                        id="categoria_id" name="categoria_id" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="monto" class="form-label">Monto (CLP) *</label>
                                <input type="number" class="form-control @error('monto') is-invalid @enderror" 
                                       id="monto" name="monto" value="{{ old('monto') }}" min="1" step="1" required>
                                @error('monto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" 
                                       id="descripcion" name="descripcion" value="{{ old('descripcion') }}" maxlength="255">
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-1 mb-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- LISTA DE GASTOS --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">📋 Gastos del Mes Actual</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Categoría</th>
                                    <th>Descripción</th>
                                    <th>Monto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gastos as $gasto)
                                <tr>
                                    <td>{{ $gasto->fecha->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge" style="background-color: {{ $gasto->categoria->color ?? '#6B7280' }}">
                                            <i class="{{ $gasto->categoria->icono ?? 'bi-tag' }}"></i>
                                            {{ $gasto->categoria->nombre }}
                                        </span>
                                    </td>
                                    <td>{{ $gasto->descripcion ?? '-' }}</td>
                                    <td class="text-danger font-weight-bold">{{ formatCLP($gasto->monto) }}</td>
                                    <td>
                                        <form action="{{ route('app.gastos.destroy', $gasto) }}" method="POST" class="d-inline" 
                                              onsubmit="return confirm('¿Estás seguro de eliminar este gasto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox fs-1 text-muted"></i><br>
                                        No hay gastos registrados este mes.<br>
                                        <small>¡Comienza a registrar tus gastos para un mejor control financiero!</small>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function marcarAlertaLeida(alertaId) {
    fetch(`/app/alertas/${alertaId}/leer`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
    });
}
</script>

<style>
.border-left-success { border-left: 0.25rem solid #1cc88a !important; }
.border-left-danger { border-left: 0.25rem solid #e74a3b !important; }
.border-left-primary { border-left: 0.25rem solid #0d6efd !important; }
.border-left-warning { border-left: 0.25rem solid #f6c23e !important; }
.text-gray-800 { color: #5a5c69 !important; }
</style>
@endsection