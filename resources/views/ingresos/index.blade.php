@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Gestión de Ingresos</h1>
                <p class="text-muted">Administra todos los ingresos de la empresa</p>
            </div>
            <button class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Nuevo Ingreso
            </button>
        </div>
    </div>

    <!-- Tarjetas de resumen -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Ingresos del Mes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$45,230.00</div>
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
                                Total de Registros
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">156</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-list-ol fs-2 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de ingresos -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Ingresos</h6>
            <div class="d-flex gap-2">
                <input type="text" class="form-control form-control-sm" placeholder="Buscar..." style="width: 200px;">
                <select class="form-select form-select-sm" style="width: 150px;">
                    <option>Todos los tipos</option>
                    <option>Ventas</option>
                    <option>Servicios</option>
                    <option>Otros</option>
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
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Monto</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001</td>
                            <td>2024-08-20</td>
                            <td>Venta de productos tecnológicos</td>
                            <td><span class="badge bg-primary">Ventas</span></td>
                            <td class="text-success fw-bold">$15,500.00</td>
                            <td><span class="badge bg-success">Completado</span></td>
                            <td>
                                <button class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil"></i>
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
                            <td>002</td>
                            <td>2024-08-18</td>
                            <td>Servicios de consultoría</td>
                            <td><span class="badge bg-info">Servicios</span></td>
                            <td class="text-success fw-bold">$8,750.00</td>
                            <td><span class="badge bg-success">Completado</span></td>
                            <td>
                                <button class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil"></i>
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
                            <td>003</td>
                            <td>2024-08-15</td>
                            <td>Comisiones por ventas</td>
                            <td><span class="badge bg-secondary">Comisiones</span></td>
                            <td class="text-success fw-bold">$3,200.00</td>
                            <td><span class="badge bg-warning">Pendiente</span></td>
                            <td>
                                <button class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil"></i>
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
                            <td>004</td>
                            <td>2024-08-12</td>
                            <td>Venta de licencias de software</td>
                            <td><span class="badge bg-primary">Ventas</span></td>
                            <td class="text-success fw-bold">$12,400.00</td>
                            <td><span class="badge bg-success">Completado</span></td>
                            <td>
                                <button class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil"></i>
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
                            <td>005</td>
                            <td>2024-08-10</td>
                            <td>Capacitación empresarial</td>
                            <td><span class="badge bg-info">Servicios</span></td>
                            <td class="text-success fw-bold">$5,380.00</td>
                            <td><span class="badge bg-success">Completado</span></td>
                            <td>
                                <button class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil"></i>
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
            
            <!-- Paginación -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Anterior</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Siguiente</a>
                    </li>
                </ul>
            </nav>
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
