@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Metas de Ahorro</h1>
            <p class="text-muted">Controla y planifica tus objetivos de ahorro</p>
        </div>
    </div>

    <!-- Meta actual -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Meta de Ahorro Actual</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="text-primary">Meta Mensual: ${{ number_format($metasData['meta_mensual'], 0, ',', '.') }}</h4>
                            <p class="text-muted mb-3">Ahorro actual: ${{ number_format($metasData['ahorro_actual'], 0, ',', '.') }}</p>
                            
                            <div class="progress mb-3" style="height: 25px;">
                                <div class="progress-bar bg-success" role="progressbar" 
                                     style="width: {{ $metasData['progreso_porcentaje'] }}%" 
                                     aria-valuenow="{{ $metasData['progreso_porcentaje'] }}" 
                                     aria-valuemin="0" aria-valuemax="100">
                                    {{ $metasData['progreso_porcentaje'] }}%
                                </div>
                            </div>
                            
                            <p class="small text-muted">
                                Te faltan ${{ number_format($metasData['meta_mensual'] - $metasData['ahorro_actual'], 0, ',', '.') }} 
                                para cumplir tu meta mensual
                            </p>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <div class="mb-3">
                                    <i class="bi bi-piggy-bank" style="font-size: 4rem; color: #1cc88a;"></i>
                                </div>
                                <h5 class="text-success">¡Vas muy bien!</h5>
                                <p class="text-muted">Has ahorrado {{ $metasData['progreso_porcentaje'] }}% de tu meta mensual</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas de ahorro -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Ahorrado
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($metasData['total_ahorrado'], 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-wallet2 fs-2 text-success"></i>
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
                                Meses Ahorrando
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $metasData['meses_ahorrando'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar-check fs-2 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Meta Anual
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($metasData['meta_anual'], 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-target fs-2 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Proyección Anual
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($metasData['proyeccion_fin_ano'], 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-graph-up-arrow fs-2 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progreso anual -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Progreso Anual</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Meta Anual: ${{ number_format($metasData['meta_anual'], 0, ',', '.') }}</span>
                        <span class="text-primary font-weight-bold">{{ $metasData['progreso_anual'] }}%</span>
                    </div>
                    <div class="progress mb-3" style="height: 20px;">
                        <div class="progress-bar bg-primary" role="progressbar" 
                             style="width: {{ $metasData['progreso_anual'] }}%" 
                             aria-valuenow="{{ $metasData['progreso_anual'] }}" 
                             aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <p class="text-muted small">
                        Ahorrado: ${{ number_format($metasData['total_ahorrado'], 0, ',', '.') }} | 
                        Proyección fin de año: ${{ number_format($metasData['proyeccion_fin_ano'], 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Historial de metas -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Historial de Metas Mensuales</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mes</th>
                                    <th>Meta</th>
                                    <th>Ahorrado</th>
                                    <th>Progreso</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($historialMetas as $meta)
                                <tr>
                                    <td>{{ $meta['mes'] }}</td>
                                    <td>${{ number_format($meta['meta'], 0, ',', '.') }}</td>
                                    <td class="font-weight-bold {{ $meta['cumplida'] ? 'text-success' : 'text-warning' }}">
                                        ${{ number_format($meta['ahorrado'], 0, ',', '.') }}
                                    </td>
                                    <td>
                                        @php $progreso = ($meta['ahorrado'] / $meta['meta']) * 100; @endphp
                                        <div class="progress" style="height: 15px;">
                                            <div class="progress-bar {{ $meta['cumplida'] ? 'bg-success' : 'bg-warning' }}" 
                                                 style="width: {{ min($progreso, 100) }}%">
                                            </div>
                                        </div>
                                        <small class="text-muted">{{ number_format($progreso, 1) }}%</small>
                                    </td>
                                    <td>
                                        @if($meta['cumplida'])
                                            <span class="badge bg-success">Cumplida</span>
                                        @else
                                            <span class="badge bg-warning">Parcial</span>
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
</div>

<style>
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.border-left-primary {
    border-left: 0.25rem solid #0d6efd !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}
</style>
@endsection
