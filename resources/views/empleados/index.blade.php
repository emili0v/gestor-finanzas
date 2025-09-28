@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Gestión de Empleados</h1>
                <p class="text-muted">Administra empleados, sueldos, descuentos y bonos</p>
            </div>
            <a href="{{ route('empleados.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-2"></i>Nuevo Empleado
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
                                Total Empleados
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $empleados->count() }}</div>
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
                                Nómina Total Mensual
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                ${{ number_format($empleados->sum(function($emp) { 
                                    return $emp->sueldos->last()->monto_bruto ?? 0; 
                                }), 0, ',', '.') }}
                            </div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $empleados->count() }}</div>
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
                                Promedio Sueldo
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                ${{ number_format($empleados->count() > 0 ? $empleados->sum(function($emp) { 
                                    return $emp->sueldos->last()->monto_bruto ?? 0; 
                                }) / $empleados->count() : 0, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calculator fs-2 text-info"></i>
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
                    <option>Recepción</option>
                    <option>Housekeeping</option>
                    <option>Restaurante</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Empleado</th>
                            <th>RUT</th>
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
                        @forelse ($empleados as $empleado)
                            <tr>
                                <td>EMP{{ str_pad($empleado->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">
                                            <i class="bi bi-person-circle fs-4 text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $empleado->nombre }}</div>
                                            <div class="text-muted small">{{ $empleado->role->nombre ?? 'Sin rol' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="font-monospace">{{ $empleado->rut_completo ?? 'Sin RUT' }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ $empleado->departamento ?? 'No asignado' }}</span>
                                </td>
                                <td class="fw-bold text-primary">
                                    ${{ number_format($empleado->sueldos->last()->monto_bruto ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="text-danger">
                                    -${{ number_format($empleado->totalDescuentos ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="text-success">
                                    +${{ number_format($empleado->totalBonos ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="fw-bold text-success">
                                    ${{ number_format($empleado->sueldoLiquido ?? 0, 0, ',', '.') }}
                                </td>
                                <td>
                                    <span class="badge bg-success">Activo</span>
                                </td>
                                <td>
                                    <a href="{{ route('empleados.show', $empleado) }}" class="btn btn-info btn-sm me-1" title="Ver detalles">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning btn-sm me-1" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('¿Estás seguro de eliminar este empleado? Esta acción no se puede deshacer.')">
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
                                <td colspan="10" class="text-center py-4">
                                    <i class="bi bi-inbox fs-1 text-muted"></i><br>
                                    No hay empleados registrados todavía.<br>
                                    <a href="{{ route('empleados.create') }}" class="btn btn-success btn-sm mt-2">
                                        <i class="bi bi-plus-circle me-1"></i>Agregar primer empleado
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
.font-monospace {
    font-family: 'Courier New', monospace;
}
</style>
@endsection