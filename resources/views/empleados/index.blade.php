@extends('layouts.app')

@section('content')
<div class="col-12 d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h3 mb-0 text-gray-800">Gestión de Empleados</h1>
        <p class="text-muted">Administra empleados, sueldos, descuentos y bonos</p>
    </div>
    <a href="{{ route('empleados.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-2"></i>Nuevo Empleado
    </a>
</div>

    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    {{-- Contenido de tarjeta... --}}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    {{-- Contenido de tarjeta... --}}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    {{-- Contenido de tarjeta... --}}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    {{-- Contenido de tarjeta... --}}
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Empleados</h6>
            <div class="d-flex gap-2">
                <input type="text" class="form-control form-control-sm" placeholder="Buscar empleado..." style="width: 200px;">
                <select class="form-select form-select-sm" style="width: 150px;">
                    <option>Todos los departamentos</option>
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
                        {{-- CAMBIO: AQUÍ EMPIEZA LA PARTE DINÁMICA --}}
                        @forelse ($empleados as $empleado)
                            <tr>
                                <td>EMP00{{ $empleado->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">
                                            {{-- Se puede añadir una imagen de perfil si existe --}}
                                            <i class="bi bi-person-circle fs-4 text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $empleado->nombre }} {{ $empleado->apellido }}</div>
                                            {{-- Asumimos que el usuario tiene un email --}}
                                            <div class="text-muted small">{{ $empleado->user->email ?? 'Sin email' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-primary">{{ $empleado->departamento ?? 'No asignado' }}</span></td>
                                <td class="fw-bold">${{ number_format($empleado->sueldo->monto_bruto ?? 0, 0, ',', '.') }}</td>
                                <td class="text-danger">-${{ number_format($empleado->totalDescuentos, 0, ',', '.') }}</td>
                                <td class="text-success">+${{ number_format($empleado->totalBonos, 0, ',', '.') }}</td>
                                <td class="fw-bold text-success">${{ number_format($empleado->sueldoLiquido, 0, ',', '.') }}</td>
                                <td><span class="badge bg-success">Activo</span></td> {{-- El estado aún es estático --}}
                                <td>
                                    <button class="btn btn-warning btn-sm me-1"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-info btn-sm me-1"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    No hay empleados registrados todavía.
                                </td>
                            </tr>
                        @endforelse
                         {{-- FIN DEL CAMBIO --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Estilos originales que estaban en tu archivo, los mantengo --}}
<style>
.border-left-success { border-left: 0.25rem solid #1cc88a !important; }
.border-left-primary { border-left: 0.25rem solid #0d6efd !important; }
.border-left-warning { border-left: 0.25rem solid #f6c23e !important; }
.border-left-info { border-left: 0.25rem solid #36b9cc !important; }
.text-gray-800 { color: #5a5c69 !important; }
.avatar-sm { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; }
</style>
@endsection  