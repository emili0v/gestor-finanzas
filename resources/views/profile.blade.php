@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Perfil de Usuario</h1>
            <p class="text-muted">Gestiona la información de tu cuenta</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Información del Perfil</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <div class="avatar-circle mx-auto mb-3">
                                <i class="bi bi-person-circle fs-1 text-primary"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nombre:</label>
                                <p class="form-control-plaintext">Usuario de ejemplo</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Correo Electrónico:</label>
                                <p class="form-control-plaintext">usuario@ejemplo.com</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Fecha de Registro:</label>
                                <p class="form-control-plaintext">{{ date('d/m/Y') }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Estado:</label>
                                <span class="badge bg-success">Activo</span>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="alert alert-info" role="alert">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Próximamente:</strong> Aquí podrás editar la información de tu perfil más adelante.
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary" type="button" disabled>
                            <i class="bi bi-pencil me-2"></i>Editar Perfil
                        </button>
                        <button class="btn btn-outline-secondary" type="button" disabled>
                            <i class="bi bi-key me-2"></i>Cambiar Contraseña
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid #0d6efd;
}
</style>
@endsection
