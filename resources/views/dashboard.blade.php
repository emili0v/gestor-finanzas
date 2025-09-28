@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <p class="text-muted">Resumen de la situación financiera</p>
        </div>
    </div>

    <!-- Cards de métricas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Empleados
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalEmpleados }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fs-2 text-primary"></i>
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
                                Costo Nómina Base
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($totalSueldosBrutos, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cash-stack fs-2 text-info"></i>
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
                                Bonos del Mes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($bonosDelMes, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-arrow-up-circle fs-2 text-success"></i>
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
                                Descuentos del Mes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format(abs($descuentosDelMes), 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-arrow-down-circle fs-2 text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de últimos movimientos -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Últimos Movimientos</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th>Tipo</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ultimosMovimientos as $movimiento)
                                <tr>
                                    <td>{{ $movimiento->fecha ? \Carbon\Carbon::parse($movimiento->fecha)->format('Y-m-d') : $movimiento->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $movimiento->descripcion }}</td>
                                    <td>
                                        @if($movimiento->monto > 0)
                                            <span class="badge bg-success">Ingreso</span>
                                        @else
                                            <span class="badge bg-danger">Egreso</span>
                                        @endif
                                    </td>
                                    <td class="{{ $movimiento->monto > 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $movimiento->monto > 0 ? '+' : '' }}${{ number_format($movimiento->monto, 2) }}
                                    </td>
                                    <td><span class="badge bg-success">Completado</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No hay movimientos registrados</td>
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

<style>
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-danger {
    border-left: 0.25rem solid #e74a3b !important;
}

.border-left-primary {
    border-left: 0.25rem solid #0d6efd !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}
</style>
@endsection