@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Mi Perfil</h1>
            <p class="text-muted">Información personal y configuración de cuenta</p>
        </div>
    </div>

    <!-- Información personal -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Información Personal</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Nombre Completo</label>
                            <p class="form-control-plaintext">{{ $perfilData['empleado_nombre'] }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">RUT</label>
                            <p class="form-control-plaintext">{{ $perfilData['rut'] }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Correo Electrónico</label>
                            <p class="form-control-plaintext">{{ $perfilData['email'] }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Rol</label>
                            <p class="form-control-plaintext">
                                <span class="badge bg-primary">{{ $perfilData['rol'] }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Fecha de Ingreso</label>
                            <p class="form-control-plaintext">{{ $perfilData['fecha_ingreso']->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Estado</label>
                            <p class="form-control-plaintext">
                                <span class="badge bg-success">{{ $perfilData['estado'] }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foto de Perfil</h6>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-person-circle" style="font-size: 6rem; color: #6c757d;"></i>
                    </div>
                    <button class="btn btn-outline-primary btn-sm" onclick="alert('Funcionalidad de cambio de foto en desarrollo')">
                        <i class="bi bi-camera me-1"></i>
                        Cambiar Foto
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas del empleado -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tiempo en la Empresa
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $perfilData['fecha_ingreso']->diffInMonths(now()) }} meses
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar-check fs-2 text-primary"></i>
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
                                Liquidaciones Generadas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">4</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-file-earmark-text fs-2 text-success"></i>
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
                                Gastos Registrados
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">4</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-receipt fs-2 text-info"></i>
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
                                Metas Cumplidas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">2 de 4</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-trophy fs-2 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Configuración de cuenta -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Configuración de Cuenta</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold mb-3">Seguridad</h6>
                            <button class="btn btn-outline-primary mb-2 w-100" onclick="alert('Funcionalidad de cambio de contraseña en desarrollo')">
                                <i class="bi bi-key me-2"></i>
                                Cambiar Contraseña
                            </button>
                            <button class="btn btn-outline-info mb-2 w-100" onclick="alert('Funcionalidad de verificación en desarrollo')">
                                <i class="bi bi-shield-check me-2"></i>
                                Verificar Email
                            </button>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold mb-3">Preferencias</h6>
                            <button class="btn btn-outline-secondary mb-2 w-100" onclick="alert('Funcionalidad de notificaciones en desarrollo')">
                                <i class="bi bi-bell me-2"></i>
                                Configurar Notificaciones
                            </button>
                            <button class="btn btn-outline-secondary mb-2 w-100" onclick="alert('Funcionalidad de exportación en desarrollo')">
                                <i class="bi bi-download me-2"></i>
                                Exportar Datos
                            </button>
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

.form-control-plaintext {
    padding-left: 0;
    border: none;
    background-color: transparent;
}
</style>
@endsection
