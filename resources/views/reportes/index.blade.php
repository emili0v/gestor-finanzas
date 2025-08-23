@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Reportes Financieros</h1>
                <p class="text-muted">Análisis y reportes de la situación financiera</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary">
                    <i class="bi bi-download me-2"></i>Exportar PDF
                </button>
                <button class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Nuevo Reporte
                </button>
            </div>
        </div>
    </div>

    <!-- Filtros de fecha -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" value="2024-08-01">
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_fin" class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control" id="fecha_fin" value="2024-08-31">
                        </div>
                        <div class="col-md-3">
                            <label for="tipo_reporte" class="form-label">Tipo de Reporte</label>
                            <select class="form-select" id="tipo_reporte">
                                <option>Resumen General</option>
                                <option>Ingresos Detallados</option>
                                <option>Egresos Detallados</option>
                                <option>Nómina</option>
                                <option>Balance</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary w-100">
                                <i class="bi bi-search me-2"></i>Generar Reporte
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos y métricas -->
    <div class="row mb-4">
        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Flujo de Caja - Últimos 6 Meses</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <div class="d-flex justify-content-center align-items-center" style="height: 300px; background-color: #f8f9fa; border-radius: 8px;">
                            <div class="text-center">
                                <i class="bi bi-bar-chart fs-1 text-muted mb-3"></i>
                                <p class="text-muted">Gráfico de flujo de caja</p>
                                <small class="text-muted">Aquí se mostraría un gráfico interactivo con Chart.js</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Distribución de Gastos</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie">
                        <div class="d-flex justify-content-center align-items-center" style="height: 245px; background-color: #f8f9fa; border-radius: 8px;">
                            <div class="text-center">
                                <i class="bi bi-pie-chart fs-1 text-muted mb-3"></i>
                                <p class="text-muted">Gráfico circular</p>
                                <small class="text-muted">Distribución por categorías</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de reportes generados -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Reportes Generados Recientemente</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Fecha Generación</th>
                                    <th>Tipo de Reporte</th>
                                    <th>Período</th>
                                    <th>Estado</th>
                                    <th>Tamaño</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2024-08-20 14:30</td>
                                    <td><span class="badge bg-primary">Resumen General</span></td>
                                    <td>Agosto 2024</td>
                                    <td><span class="badge bg-success">Completado</span></td>
                                    <td>2.4 MB</td>
                                    <td>
                                        <button class="btn btn-success btn-sm me-1">
                                            <i class="bi bi-download"></i>
                                        </button>
                                        <button class="btn btn-info btn-sm me-1">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-08-18 09:15</td>
                                    <td><span class="badge bg-info">Nómina</span></td>
                                    <td>Agosto 2024</td>
                                    <td><span class="badge bg-success">Completado</span></td>
                                    <td>1.8 MB</td>
                                    <td>
                                        <button class="btn btn-success btn-sm me-1">
                                            <i class="bi bi-download"></i>
                                        </button>
                                        <button class="btn btn-info btn-sm me-1">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-08-15 16:45</td>
                                    <td><span class="badge bg-warning">Balance</span></td>
                                    <td>Julio 2024</td>
                                    <td><span class="badge bg-success">Completado</span></td>
                                    <td>3.1 MB</td>
                                    <td>
                                        <button class="btn btn-success btn-sm me-1">
                                            <i class="bi bi-download"></i>
                                        </button>
                                        <button class="btn btn-info btn-sm me-1">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-08-12 11:20</td>
                                    <td><span class="badge bg-danger">Egresos Detallados</span></td>
                                    <td>Julio 2024</td>
                                    <td><span class="badge bg-warning">Procesando</span></td>
                                    <td>-</td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm me-1" disabled>
                                            <i class="bi bi-download"></i>
                                        </button>
                                        <button class="btn btn-info btn-sm me-1">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-08-10 13:10</td>
                                    <td><span class="badge bg-success">Ingresos Detallados</span></td>
                                    <td>Julio 2024</td>
                                    <td><span class="badge bg-success">Completado</span></td>
                                    <td>2.7 MB</td>
                                    <td>
                                        <button class="btn btn-success btn-sm me-1">
                                            <i class="bi bi-download"></i>
                                        </button>
                                        <button class="btn btn-info btn-sm me-1">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Métricas adicionales -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Margen de Ganancia
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">28.8%</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-percent fs-2 text-primary"></i>
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
                                Crecimiento Mensual
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">+12.5%</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-graph-up-arrow fs-2 text-success"></i>
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
                                Promedio Diario
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$1,165.00</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar-day fs-2 text-info"></i>
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
                                Proyección Anual
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$433,560.00</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-graph-up fs-2 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #0d6efd !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}
</style>
@endsection
