@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Detalle del Descuento</h1>
                <p class="text-muted">Información completa del descuento aplicado</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('egresos.edit', $descuento) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-2"></i>Editar
                </a>
                <a href="{{ route('egresos.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Volver
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Información del Descuento</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">ID del Descuento:</label>
                            <p class="form-control-plaintext">#{{ str_pad($descuento->id, 3, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Fecha:</label>
                            <p class="form-control-plaintext">
                                {{ $descuento->fecha ? \Carbon\Carbon::parse($descuento->fecha)->format('d/m/Y') : $descuento->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Empleado:</label>
                            <p class="form-control-plaintext">
                                <strong>{{ $descuento->empleado->nombre }}</strong><br>
                                <small class="text-muted">{{ $descuento->empleado->role->nombre ?? 'Sin rol' }}</small>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Monto:</label>
                            <p class="form-control-plaintext">
                                <span class="h4 text-danger font-weight-bold">{{ formatCLP(abs($descuento->monto)) }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Categoría:</label>
                            <p class="form-control-plaintext">
                                @if($descuento->categoria)
                                    @php
                                        $badgeClass = match($descuento->categoria->nombre) {
                                            'Adelanto de Sueldo' => 'bg-primary',
                                            'Descuento por Inasistencia' => 'bg-warning',
                                            'Daño a Propiedad de Hotel' => 'bg-danger',
                                            'Cuota Préstamo Interno' => 'bg-info',
                                            'Descuento Uniforme' => 'bg-secondary',
                                            'Multa por Atraso' => 'bg-dark',
                                            'Descuento Alimentación' => 'bg-success',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} fs-6">{{ $descuento->categoria->nombre }}</span>
                                @else
                                    <span class="badge bg-secondary fs-6">Sin categoría</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-weight-bold">Fecha de Registro:</label>
                            <p class="form-control-plaintext">{{ $descuento->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label font-weight-bold">Descripción:</label>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <p class="mb-0">{{ $descuento->descripcion }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Acciones</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('egresos.edit', $descuento) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-2"></i>Editar Descuento
                        </a>
                        <button class="btn btn-info" onclick="window.print()">
                            <i class="bi bi-printer me-2"></i>Imprimir
                        </button>
                        <hr>
                        <form action="{{ route('egresos.destroy', $descuento) }}" method="POST" 
                              onsubmit="return confirm('¿Estás seguro de eliminar este descuento? Esta acción no se puede deshacer.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-trash me-2"></i>Eliminar Descuento
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Información Adicional</h6>
                </div>
                <div class="card-body">
                    <small class="text-muted">
                        <strong>Última modificación:</strong><br>
                        {{ $descuento->updated_at->format('d/m/Y H:i') }}
                    </small>
                    @if($descuento->updated_at != $descuento->created_at)
                        <br><br>
                        <small class="text-warning">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Este descuento ha sido modificado después de su creación inicial.
                        </small>
                    @endif
                    
                    <hr>
                    
                    <div class="small">
                        <strong class="text-danger">Impacto en el Sueldo:</strong><br>
                        Este descuento se restará automáticamente del sueldo líquido del empleado en el mes correspondiente.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control-plaintext {
    padding-left: 0;
    border: none;
    background-color: transparent;
}

.text-gray-800 {
    color: #5a5c69 !important;
}

@media print {
    .btn, .card-header, .no-print {
        display: none !important;
    }
}
</style>
@endsection
