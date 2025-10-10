<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\EmpleadoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BonoController;
use App\Http\Controllers\Admin\DescuentoController;
use App\Http\Controllers\User\GastoPersonalController;
use App\Http\Controllers\User\MetaAhorroController;
use App\Http\Controllers\User\AlertaController;
use App\Http\Controllers\User\PerfilController;
// Landing page (pública)
Route::get('/', function () {
    return view('landing');
})->name('landing');

// === AUTENTICACIÓN ===
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [LoginController::class, 'register'])->name('register.post');
});

// Logout (requiere autenticación)
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');

// === RUTAS PARA ADMINISTRADORES ===
// CORREGIDO: Usar 'admin' en lugar de 'Administrador'
Route::middleware(['auth', 'user.role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Bonos y Comisiones
    Route::get('/ingresos', [BonoController::class, 'index'])->name('ingresos.index');
    Route::get('/ingresos/crear', [BonoController::class, 'create'])->name('ingresos.create');
    Route::post('/ingresos', [BonoController::class, 'store'])->name('ingresos.store');
    Route::get('/ingresos/{bono}', [BonoController::class, 'show'])->name('ingresos.show');
    Route::get('/ingresos/{bono}/editar', [BonoController::class, 'edit'])->name('ingresos.edit');
    Route::put('/ingresos/{bono}', [BonoController::class, 'update'])->name('ingresos.update');
    Route::delete('/ingresos/{bono}', [BonoController::class, 'destroy'])->name('ingresos.destroy');

    // Descuentos y Adelantos
    Route::get('/egresos', [DescuentoController::class, 'index'])->name('egresos.index');
    Route::get('/egresos/crear', [DescuentoController::class, 'create'])->name('egresos.create');
    Route::post('/egresos', [DescuentoController::class, 'store'])->name('egresos.store');
    Route::get('/egresos/{descuento}', [DescuentoController::class, 'show'])->name('egresos.show');
    Route::get('/egresos/{descuento}/editar', [DescuentoController::class, 'edit'])->name('egresos.edit');
    Route::put('/egresos/{descuento}', [DescuentoController::class, 'update'])->name('egresos.update');
    Route::delete('/egresos/{descuento}', [DescuentoController::class, 'destroy'])->name('egresos.destroy');

    // Empleados (CRUD completo)
    Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
    Route::get('/empleados/crear', [EmpleadoController::class, 'create'])->name('empleados.create');
    Route::post('/empleados', [EmpleadoController::class, 'store'])->name('empleados.store');
    Route::get('/empleados/{empleado}', [EmpleadoController::class, 'show'])->name('empleados.show');
    Route::get('/empleados/{empleado}/editar', [EmpleadoController::class, 'edit'])->name('empleados.edit');
    Route::put('/empleados/{empleado}', [EmpleadoController::class, 'update'])->name('empleados.update');
    Route::patch('/empleados/{empleado}', [EmpleadoController::class, 'update'])->name('empleados.update');
    Route::delete('/empleados/{empleado}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');

    Route::get('/reportes', function () {
        return view('reportes.index');
    })->name('reportes.index');

    Route::get('/perfil', function () {
        return view('profile');
    })->name('profile');
});

// ============================================
// RUTAS PARA USUARIOS/EMPLEADOS (Portal del Empleado)
// ============================================
Route::middleware(['auth', 'user.role:user'])->prefix('app')->name('app.')->group(function () {
    
    // Dashboard del empleado
    Route::get('/mi-sueldo', [UserDashboardController::class, 'miSueldo'])->name('mi-sueldo');
    Route::get('/historial', [UserHistorialController::class, 'index'])->name('historial');
    Route::get('/perfil', [UserProfileController::class, 'index'])->name('perfil');
    
    //GASTOS PERSONALES (Módulo completo)
    Route::get('/gastos', [GastoPersonalController::class, 'index'])->name('gastos');
    Route::post('/gastos', [GastoPersonalController::class, 'store'])->name('gastos.store');
    Route::delete('/gastos/{gasto}', [GastoPersonalController::class, 'destroy'])->name('gastos.destroy');
    
    //METAS DE AHORRO
    Route::get('/metas', [MetaAhorroController::class, 'index'])->name('metas');
    Route::post('/metas', [MetaAhorroController::class, 'store'])->name('metas.store');
    Route::patch('/metas/{meta}', [MetaAhorroController::class, 'update'])->name('metas.update');
    Route::delete('/metas/{meta}', [MetaAhorroController::class, 'destroy'])->name('metas.destroy');
    
    // ALERTAS DE GASTOS
    Route::post('/alertas/{alerta}/leer', [AlertaController::class, 'marcarLeida'])->name('alertas.leer');
    Route::post('/alertas/leer-todas', [AlertaController::class, 'marcarTodasLeidas'])->name('alertas.leer-todas');
    
    // CONFIGURACIÓN DE PERFIL
    Route::get('/perfil/configuracion', [PerfilController::class, 'edit'])->name('perfil.configuracion');
    Route::put('/perfil/configuracion', [PerfilController::class, 'update'])->name('perfil.actualizar');
});