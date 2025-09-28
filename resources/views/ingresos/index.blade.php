@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Bonos y Comisiones</h1>
                <p class="text-muted">Gestiona bonos, comisiones y horas extra del personal del hotel</p>
            </div>
            <a href="{{ route('bonos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Asignar Bono
            </a>
        </div>
    </div>

    <!-- Mostrar mensajes de éxito -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tarjetas de resumen -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Bonos del Mes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($bonosDelMes, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar-month fs-2 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total de Bonos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBonos }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-list-ol fs-2 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de bonos -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Bonos Asignados</h6>
            <div class="d-flex gap-2">
                <input type="text" class="form-control form-control-sm" placeholder="Buscar empleado..." style="width: 200px;">
                <select class="form-select form-select-sm" style="width: 150px;">
                    <option>Todos los tipos</option>
                    <option>Horas Extra</option>
                    <option>Comisiones</option>
                    <option>Bonos Desempeño</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Empleado</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Monto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bonos as $bono)
                        <tr>
                            <td>{{ str_pad($bono->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $bono->fecha ? \Carbon\Carbon::parse($bono->fecha)->format('Y-m-d') : $bono->created_at->format('Y-m-d') }}</td>
                            <td>
                                <strong>{{ $bono->empleado->nombre }}</strong><br>
                                <small class="text-muted">{{ $bono->empleado->role->nombre ?? 'Sin rol' }}</small>
                            </td>
                            <td>{{ $bono->descripcion }}</td>
                            <td>
                                @if($bono->categoria)
                                    @php
                                        $badgeClass = match($bono->categoria->nombre) {
                                            'Horas Extra' => 'bg-warning',
                                            'Comisión por Tours' => 'bg-info',
                                            'Bono Ocupación' => 'bg-success',
                                            'Incentivo Puntualidad' => 'bg-primary',
                                            'Bono Desempeño' => 'bg-secondary',
                                            'Comisión Ventas' => 'bg-info',
                                            'Bono Temporada Alta' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $bono->categoria->nombre }}</span>
                                @else
                                    <span class="badge bg-secondary">Sin categoría</span>
                                @endif
                            </td>
                            <td class="text-success fw-bold">${{ number_format($bono->monto, 2) }}</td>
                            <td>
                                <a href="{{ route('bonos.edit', $bono) }}" class="btn btn-warning btn-sm me-1" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="{{ route('bonos.show', $bono) }}" class="btn btn-info btn-sm me-1" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('bonos.destroy', $bono) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('¿Estás seguro de eliminar este bono?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-1 text-muted"></i><br>
                                No hay bonos registrados aún.<br>
                                <a href="{{ route('bonos.create') }}" class="btn btn-primary btn-sm mt-2">
                                    <i class="bi bi-plus-circle me-1"></i>Asignar primer bono
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Paginación -->
            @if($bonos->hasPages())
            <nav aria-label="Page navigation">
                {{ $bonos->links('pagination::bootstrap-4') }}
            </nav>
            @endif
        </div>
    </div>
</div>

<style>
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}
</style>
@endsection