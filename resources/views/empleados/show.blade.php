 @extends('layouts.app')

@section('title', 'Detalle del Empleado')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-person-lines-fill me-2"></i>
                        Detalle del Empleado
                    </h4>
                    <div>
                        <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <a href="{{ route('empleados.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Información Personal</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nombre Completo:</strong></td>
                                    <td>{{ $empleado->nombre }} {{ $empleado->apellido }}</td>
                                </tr>
                                <tr>
                                    <td><strong>RUT:</strong></td>
                                    <td>{{ $empleado->rut_completo }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Departamento:</strong></td>
                                    <td>{{ $empleado->departamento }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Cargo:</strong></td>
                                    <td>{{ $empleado->cargo }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Rol:</strong></td>
                                    <td>
                                        <span class="badge bg-primary">{{ $empleado->role->name ?? 'Sin rol' }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Estadísticas</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card bg-info text-white">
                                        <div class="card-body text-center">
                                            <h6>Total Sueldos</h6>
                                            <h4>{{ $empleado->sueldos->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-success text-white">
                                        <div class="card-body text-center">
                                            <h6>Movimientos</h6>
                                            <h4>{{ $empleado->movimientos->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($empleado->sueldos->count() > 0)
                    <hr>
                    <h5>Últimos Sueldos</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Período</th>
                                    <th>Sueldo Base</th>
                                    <th>Descuentos</th>
                                    <th>Líquido</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($empleado->sueldos->take(5) as $sueldo)
                                <tr>
                                    <td>{{ $sueldo->periodo ?? 'N/A' }}</td>
                                    <td>${{ number_format($sueldo->sueldo_base ?? 0, 0, ',', '.') }}</td>
                                    <td>${{ number_format($sueldo->descuentos ?? 0, 0, ',', '.') }}</td>
                                    <td>${{ number_format($sueldo->liquido ?? 0, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $sueldo->estado == 'pagado' ? 'success' : 'warning' }}">
                                            {{ ucfirst($sueldo->estado ?? 'pendiente') }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
