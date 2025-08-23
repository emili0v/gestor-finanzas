@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Gestión de Empleados</h1>
                <p class="text-muted">Administra empleados, sueldos, descuentos y bonos</p>
            </div>
            <button class="btn btn-success">
                <i class="bi bi-plus-circle me-2"></i>Nuevo Empleado
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
                                Total Empleados
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">24</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fs-2 text-success"></i>
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
                                Nómina Mensual
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$72,500.00</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cash-stack fs-2 text-primary"></i>
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
                                Empleados Activos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">22</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-person-check fs-2 text-warning"></i>
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
                                Bonos del Mes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$8,750.00</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-gift fs-2 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de empleados -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Empleados</h6>
            <div class="d-flex gap-2">
                <input type="text" class="form-control form-control-sm" placeholder="Buscar empleado..." style="width: 200px;">
                <select class="form-select form-select-sm" style="width: 150px;">
                    <option>Todos los departamentos</option>
                    <option>Administración</option>
                    <option>Ventas</option>
                    <option>IT</option>
                    <option>RRHH</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Departamento</th>
                            <th>Sueldo Bruto</th>
                            <th>Descuentos</th>
                            <th>Bonos</th>
                            <th>Sueldo Líquido</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>EMP001</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <i class="bi bi-person-circle fs-4 text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">María González</div>
                                        <div class="text-muted small">maria.gonzalez@empresa.com</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-primary">Administración</span></td>
                            <td class="fw-bold">$4,500.00</td>
                            <td class="text-danger">-$450.00</td>
                            <td class="text-success">+$500.00</td>
                            <td class="fw-bold text-success">$4,550.00</td>
                            <td><span class="badge bg-success">Activo</span></td>
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
                            <td>EMP002</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <i class="bi bi-person-circle fs-4 text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Carlos Rodríguez</div>
                                        <div class="text-muted small">carlos.rodriguez@empresa.com</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-info">Ventas</span></td>
                            <td class="fw-bold">$3,800.00</td>
                            <td class="text-danger">-$380.00</td>
                            <td class="text-success">+$750.00</td>
                            <td class="fw-bold text-success">$4,170.00</td>
                            <td><span class="badge bg-success">Activo</span></td>
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
                            <td>EMP003</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <i class="bi bi-person-circle fs-4 text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Ana Martínez</div>
                                        <div class="text-muted small">ana.martinez@empresa.com</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-success">IT</span></td>
                            <td class="fw-bold">$5,200.00</td>
                            <td class="text-danger">-$520.00</td>
                            <td class="text-success">+$300.00</td>
                            <td class="fw-bold text-success">$4,980.00</td>
                            <td><span class="badge bg-success">Activo</span></td>
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
                            <td>EMP004</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <i class="bi bi-person-circle fs-4 text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Luis Fernández</div>
                                        <div class="text-muted small">luis.fernandez@empresa.com</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-warning">RRHH</span></td>
                            <td class="fw-bold">$4,000.00</td>
                            <td class="text-danger">-$400.00</td>
                            <td class="text-success">+$200.00</td>
                            <td class="fw-bold text-success">$3,800.00</td>
                            <td><span class="badge bg-warning">Vacaciones</span></td>
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
                            <td>EMP005</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2">
                                        <i class="bi bi-person-circle fs-4 text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Patricia López</div>
                                        <div class="text-muted small">patricia.lopez@empresa.com</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-info">Ventas</span></td>
                            <td class="fw-bold">$3,600.00</td>
                            <td class="text-danger">-$360.00</td>
                            <td class="text-success">+$600.00</td>
                            <td class="fw-bold text-success">$3,840.00</td>
                            <td><span class="badge bg-success">Activo</span></td>
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

.border-left-primary {
    border-left: 0.25rem solid #0d6efd !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}

.avatar-sm {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
@endsection
