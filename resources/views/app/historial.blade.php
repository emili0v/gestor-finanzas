@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Historial de Sueldos</h1>
            <p class="text-muted">Historial completo de tus liquidaciones de sueldo</p>
        </div>
    </div>

    <!-- Tabla de historial -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Liquidaciones Anteriores</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Período</th>
                                    <th>Sueldo Bruto</th>
                                    <th>Sueldo Líquido</th>
                                    <th>Fecha de Pago</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($historialData as $liquidacion)
                                <tr>
                                    <td>{{ $liquidacion['mes'] }}</td>
                                    <td class="text-primary font-weight-bold">${{ number_format($liquidacion['sueldo_bruto'], 0, ',', '.') }}</td>
                                    <td class="text-success font-weight-bold">${{ number_format($liquidacion['sueldo_liquido'], 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($liquidacion['fecha_pago'])->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $liquidacion['estado'] }}</span>
                                    </td>
                                    <td>
                                        @if($liquidacion['pdf_disponible'])
                                            <button class="btn btn-sm btn-outline-primary" onclick="alert('Descarga PDF para {{ $liquidacion['mes'] }} - Funcionalidad en desarrollo')">
                                                <i class="bi bi-download me-1"></i>
                                                PDF
                                            </button>
                                        @else
                                            <span class="text-muted small">No disponible</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resumen estadístico -->
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Promedio Sueldo Líquido
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format(714000, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-graph-up fs-2 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Pagado (4 meses)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format(2856000, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calculator fs-2 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Liquidaciones Disponibles
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">3 de 4</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-file-earmark-pdf fs-2 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}
</style>
@endsection
