@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Mis Gastos</h1>
            <p class="text-muted">Registra y controla tus gastos personales</p>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Formulario de nuevo gasto -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Agregar Nuevo Gasto</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('app.gastos.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="categoria" class="form-label">Categoría</label>
                                <select class="form-select" id="categoria" name="categoria" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach($categorias as $categoria)
                                    <option value="{{ $categoria }}">{{ $categoria }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="monto" class="form-label">Monto</label>
                                <input type="number" class="form-control" id="monto" name="monto" min="0" step="1" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="255">
                            </div>
                            <div class="col-md-1 mb-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de gastos -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Gastos Recientes</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Categoría</th>
                                    <th>Descripción</th>
                                    <th>Monto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gastosData as $gasto)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($gasto['fecha'])->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $gasto['categoria'] }}</span>
                                    </td>
                                    <td>{{ $gasto['descripcion'] }}</td>
                                    <td class="text-danger font-weight-bold">${{ number_format($gasto['monto'], 0, ',', '.') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Funcionalidad de edición en desarrollo')">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="alert('Funcionalidad de eliminación en desarrollo')">
                                            <i class="bi bi-trash"></i>
                                        </button>
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

    <!-- Resumen de gastos -->
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Gastos (Mes)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format(47000, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-receipt fs-2 text-danger"></i>
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
                                Promedio Diario
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format(2760, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-graph-down fs-2 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Categoría Principal
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Educación</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-pie-chart fs-2 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
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

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}
</style>
@endsection
