@extends('layouts.user')

@section('content')
<div class="container-fluid">
    {{-- HEADER --}}
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">💰 Mis Metas de Ahorro</h1>
            <p class="text-muted">Crea y administra tus objetivos financieros</p>
        </div>
    </div>

    {{-- ALERTAS --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- RESUMEN GENERAL --}}
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Ahorrado (Activo)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ formatCLP($totalAhorradoActivo) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-wallet2 fs-2 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Meta Total (Activo)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ formatCLP($totalObjetivoActivo) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-target fs-2 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Progreso General
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $progresoGeneral }}%</div>
                            <div class="progress mt-2" style="height: 10px;">
                                <div class="progress-bar bg-primary" style="width: {{ min($progresoGeneral, 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FORMULARIO NUEVA META --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">➕ Crear Nueva Meta de Ahorro</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('app.metas.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nombre_meta" class="form-label">Nombre de la Meta *</label>
                                <input type="text" class="form-control @error('nombre_meta') is-invalid @enderror" 
                                       id="nombre_meta" name="nombre_meta" value="{{ old('nombre_meta') }}" 
                                       placeholder="Ej: Vacaciones 2025" required>
                                @error('nombre_meta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="monto_objetivo" class="form-label">Monto Objetivo (CLP) *</label>
                                <input type="number" class="form-control @error('monto_objetivo') is-invalid @enderror" 
                                     id="monto_objetivo" name="monto_objetivo" value="{{ old('monto_objetivo') }}" 
                                    min="1" step="1" placeholder="500000" required>
                                @error('monto_objetivo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="fecha_objetivo" class="form-label">Fecha Objetivo</label>
                                <input type="date" class="form-control @error('fecha_objetivo') is-invalid @enderror" 
                                    id="fecha_objetivo" name="fecha_objetivo" value="{{ old('fecha_objetivo') }}"
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                @error('fecha_objetivo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-plus-circle"></i> Crear
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="descripcion" class="form-label">Descripción (Opcional)</label>
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                          id="descripcion" name="descripcion" rows="2" 
                                          placeholder="Describe tu objetivo...">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- METAS ACTIVAS --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">🎯 Metas Activas</h6>
                </div>
                <div class="card-body">
                    @forelse($metasActivas as $meta)
                    <div class="card mb-3 border-left-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="font-weight-bold text-primary">{{ $meta->nombre_meta }}</h5>
                                    @if($meta->descripcion)
                                    <p class="text-muted small mb-2">{{ $meta->descripcion }}</p>
                                    @endif
                                    <div class="mb-2">
                                        <strong>Objetivo:</strong> {{ formatCLP($meta->monto_objetivo) }} | 
                                        <strong>Ahorrado:</strong> <span class="text-success">{{ formatCLP($meta->monto_actual) }}</span> |
                                        <strong>Falta:</strong> <span class="text-danger">{{ formatCLP($meta->monto_pendiente) }}</span>
                                    </div>
                                    @if($meta->fecha_objetivo)
                                    <div class="small text-muted">
                                        <i class="bi bi-calendar-event"></i> Objetivo: {{ $meta->fecha_objetivo->format('d/m/Y') }}
                                    </div>
                                    @endif
                                    <div class="progress mt-2" style="height: 25px;">
                                        <div class="progress-bar bg-success" style="width: {{ min($meta->progreso, 100) }}%">
                                            {{ number_format($meta->progreso, 1) }}%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex flex-column justify-content-center">
                                    <form method="POST" action="{{ route('app.metas.update', $meta) }}" class="mb-2">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" name="monto_agregar" 
                                                   placeholder="Agregar ahorro" min="1" step="1000" required>
                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <form method="POST" action="{{ route('app.metas.destroy', $meta) }}" 
                                          onsubmit="return confirm('¿Cancelar esta meta?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                            <i class="bi bi-x-circle"></i> Cancelar Meta
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-inbox fs-1"></i><br>
                        No tienes metas activas.<br>
                        <small>¡Crea tu primera meta de ahorro!</small>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- METAS COMPLETADAS --}}
    @if($metasCompletadas->count() > 0)
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success"> Metas Completadas (Últimas 5)</h6>
                </div>
                <div class="card-body">
                    @foreach($metasCompletadas as $meta)
                    <div class="card mb-2 border-left-success">
                        <div class="card-body py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $meta->nombre_meta }}</strong>
                                    <span class="badge bg-success ms-2">Completada</span>
                                </div>
                                <div class="text-success font-weight-bold">
                                    {{ formatCLP($meta->monto_objetivo) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
.border-left-success { border-left: 0.25rem solid #1cc88a !important; }
.border-left-primary { border-left: 0.25rem solid #0d6efd !important; }
.border-left-info { border-left: 0.25rem solid #36b9cc !important; }
.text-gray-800 { color: #5a5c69 !important; }
</style>
@endsection