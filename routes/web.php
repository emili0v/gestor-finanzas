<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\EmpleadoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BonoController;
use App\Http\Controllers\Admin\DescuentoController; // NUEVA LÍNEA

// Landing page (pública)
Route::get('/', function () {
    return view('landing');
})->name('landing');

// === AUTENTICACIÓN ===
Route::middleware('guest')->group(function () {
    // Mostrar formulario de login
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    // Procesar login (REAL)
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    // Mostrar formulario de registro
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    // Procesar registro
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
Route::middleware(['auth', 'user.role:Administrador'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Bonos y Comisiones (antes ingresos)
    Route::get('/ingresos', [BonoController::class, 'index'])->name('ingresos.index');
    Route::get('/ingresos/crear', [BonoController::class, 'create'])->name('ingresos.create');
    Route::post('/ingresos', [BonoController::class, 'store'])->name('ingresos.store');
    Route::get('/ingresos/{bono}', [BonoController::class, 'show'])->name('ingresos.show');
    Route::get('/ingresos/{bono}/editar', [BonoController::class, 'edit'])->name('ingresos.edit');
    Route::put('/ingresos/{bono}', [BonoController::class, 'update'])->name('ingresos.update');
    Route::delete('/ingresos/{bono}', [BonoController::class, 'destroy'])->name('ingresos.destroy');

    // === NUEVAS RUTAS PARA DESCUENTOS Y ADELANTOS ===
    Route::get('/egresos', [DescuentoController::class, 'index'])->name('egresos.index');
    Route::get('/egresos/crear', [DescuentoController::class, 'create'])->name('egresos.create');
    Route::post('/egresos', [DescuentoController::class, 'store'])->name('egresos.store');
    Route::get('/egresos/{descuento}', [DescuentoController::class, 'show'])->name('egresos.show');
    Route::get('/egresos/{descuento}/editar', [DescuentoController::class, 'edit'])->name('egresos.edit');
    Route::put('/egresos/{descuento}', [DescuentoController::class, 'update'])->name('egresos.update');
    Route::delete('/egresos/{descuento}', [DescuentoController::class, 'destroy'])->name('egresos.destroy');

    // === RUTAS COMPLETAS PARA EMPLEADOS (CRUD) ===
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

// === RUTAS PARA EMPLEADOS ===
Route::middleware(['auth', 'user.role:Empleado'])->prefix('app')->name('app.')->group(function () {
    Route::get('/mi-sueldo', [App\Http\Controllers\User\UserDashboardController::class, 'miSueldo'])
        ->name('mi-sueldo');

    Route::get('/historial', [App\Http\Controllers\User\UserHistorialController::class, 'index'])
        ->name('historial');

    Route::get('/gastos', [App\Http\Controllers\User\UserExpenseController::class, 'index'])
        ->name('gastos');
    Route::post('/gastos', [App\Http\Controllers\User\UserExpenseController::class, 'store'])
        ->name('gastos.store');

    Route::get('/metas', [App\Http\Controllers\User\UserGoalsController::class, 'index'])
        ->name('metas');

    Route::get('/perfil', [App\Http\Controllers\User\UserProfileController::class, 'index'])
        ->name('perfil');
});