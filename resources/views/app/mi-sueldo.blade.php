@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Mi Sueldo</h1>
            <p class="text-muted">Detalle de tu liquidación de sueldo - {{ $sueldoData['mes_actual'] }}</p>
        </div>
    </div>

    <!-- Resumen del sueldo -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Sueldo Bruto
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($sueldoData['sueldo_bruto'], 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cash-coin fs-2 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Descuentos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($sueldoData['total_descuentos'], 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-dash-circle fs-2 text-danger"></i>
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
                                Sueldo Líquido
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($sueldoData['sueldo_liquido'], 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-wallet2 fs-2 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detalle de descuentos y bonos -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Descuentos</h6>
                </div>
                <div class="card-body">
                    @foreach($sueldoData['descuentos'] as $concepto => $monto)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>{{ $concepto }}</span>
                        <span class="text-danger font-weight-bold">-${{ number_format($monto, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>Total Descuentos</strong>
                        <strong class="text-danger">-${{ number_format($sueldoData['total_descuentos'], 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Bonos</h6>
                </div>
                <div class="card-body">
                    @foreach($sueldoData['bonos'] as $concepto => $monto)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>{{ $concepto }}</span>
                        <span class="text-success font-weight-bold">+${{ number_format($monto, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>Total Bonos</strong>
                        <strong class="text-success">+${{ number_format($sueldoData['total_bonos'], 0, ',', '.') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón de descarga -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Liquidación de Sueldo</h5>
                    <p class="card-text">Descarga tu liquidación de sueldo en formato PDF</p>
                    <button class="btn btn-primary" onclick="alert('Funcionalidad de descarga PDF en desarrollo')">
                        <i class="bi bi-download me-2"></i>
                        Descargar Liquidación (PDF)
                    </button>
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

.text-gray-800 {
    color: #5a5c69 !important;
}
</style>
@endsection
