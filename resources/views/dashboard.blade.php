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
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Ingresos Totales
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$125,450.00</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-arrow-up-circle fs-2 text-success"></i>
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
                                Egresos Totales
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$89,320.00</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-arrow-down-circle fs-2 text-danger"></i>
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
                                Balance Total
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$36,130.00</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-wallet2 fs-2 text-primary"></i>
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
                                <tr>
                                    <td>2024-08-20</td>
                                    <td>Venta de productos</td>
                                    <td><span class="badge bg-success">Ingreso</span></td>
                                    <td class="text-success">+$15,500.00</td>
                                    <td><span class="badge bg-success">Completado</span></td>
                                </tr>
                                <tr>
                                    <td>2024-08-19</td>
                                    <td>Pago de nómina</td>
                                    <td><span class="badge bg-danger">Egreso</span></td>
                                    <td class="text-danger">-$8,200.00</td>
                                    <td><span class="badge bg-success">Completado</span></td>
                                </tr>
                                <tr>
                                    <td>2024-08-18</td>
                                    <td>Servicios profesionales</td>
                                    <td><span class="badge bg-success">Ingreso</span></td>
                                    <td class="text-success">+$3,750.00</td>
                                    <td><span class="badge bg-warning">Pendiente</span></td>
                                </tr>
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

.text-gray-800 {
    color: #5a5c69 !important;
}
</style>
@endsection
