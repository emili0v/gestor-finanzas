@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Gestión de Egresos</h1>
                <p class="text-muted">Administra todos los gastos y egresos de la empresa</p>
            </div>
            <button class="btn btn-danger">
                <i class="bi bi-plus-circle me-2"></i>Nuevo Egreso
            </button>
        </div>
    </div>

    <!-- Tarjetas de resumen -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Egresos del Mes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$32,180.00</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar-month fs-2 text-danger"></i>
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
                                Total de Registros
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">89</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-list-ol fs-2 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de egresos -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Egresos</h6>
            <div class="d-flex gap-2">
                <input type="text" class="form-control form-control-sm" placeholder="Buscar..." style="width: 200px;">
                <select class="form-select form-select-sm" style="width: 150px;">
                    <option>Todas las categorías</option>
                    <option>Nómina</option>
                    <option>Servicios</option>
                    <option>Suministros</option>
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
                            <td>E001</td>
                            <td>2024-08-19</td>
                            <td>Pago de nómina mensual</td>
                            <td><span class="badge bg-primary">Nómina</span></td>
                            <td class="text-danger fw-bold">$18,200.00</td>
                            <td><span class="badge bg-success">Pagado</span></td>
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
                            <td>E002</td>
                            <td>2024-08-17</td>
                            <td>Servicios de internet y telefonía</td>
                            <td><span class="badge bg-info">Servicios</span></td>
                            <td class="text-danger fw-bold">$1,250.00</td>
                            <td><span class="badge bg-success">Pagado</span></td>
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
                            <td>E003</td>
                            <td>2024-08-15</td>
                            <td>Compra de suministros de oficina</td>
                            <td><span class="badge bg-secondary">Suministros</span></td>
                            <td class="text-danger fw-bold">$850.00</td>
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
                            <td>E004</td>
                            <td>2024-08-12</td>
                            <td>Mantenimiento de equipos</td>
                            <td><span class="badge bg-dark">Mantenimiento</span></td>
                            <td class="text-danger fw-bold">$2,400.00</td>
                            <td><span class="badge bg-success">Pagado</span></td>
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
                            <td>E005</td>
                            <td>2024-08-10</td>
                            <td>Pago de servicios públicos</td>
                            <td><span class="badge bg-info">Servicios</span></td>
                            <td class="text-danger fw-bold">$3,480.00</td>
                            <td><span class="badge bg-success">Pagado</span></td>
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
.border-left-danger {
    border-left: 0.25rem solid #e74a3b !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}
</style>
@endsection
