<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

// 📊 Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// 🔐 Autenticación
// Login
Route::get('/login', function () {
    return view('auth.login'); // Mostrar formulario
})->name('login');

Route::post('/login', function () {
    // 👇 Lógica dummy con redirección basada en rol
    // En implementación real, aquí iría la autenticación
    return redirect()->route('app.mi-sueldo');
})->name('login.post');

// Register
Route::get('/register', function () {
    return view('auth.register'); // Mostrar formulario
})->name('register');

Route::post('/register', function () {
    // 👇 Lógica dummy
    return redirect()->route('dashboard');
})->name('register.post');

// Logout
Route::post('/logout', function () {
    // 👇 Lógica dummy (cerrar sesión real vendrá con Auth)
    return redirect()->route('login');
})->name('logout');

// 💰 Finanzas
Route::get('/ingresos', function () {
    return view('ingresos.index');
})->name('ingresos.index');

Route::get('/egresos', function () {
    return view('egresos.index');
})->name('egresos.index');

// 👥 Empleados
Route::get('/empleados', function () {
    return view('empleados.index');
})->name('empleados.index');

// 📑 Reportes
Route::get('/reportes', function () {
    return view('reportes.index');
})->name('reportes.index');

// 👤 Perfil
Route::get('/perfil', function () {
    return view('profile');
})->name('profile');

Route::prefix('app')->name('app.')->group(function () {
    Route::get('/mi-sueldo', [App\Http\Controllers\User\UserDashboardController::class, 'miSueldo'])->name('mi-sueldo');
    
    Route::get('/historial', [App\Http\Controllers\User\UserHistorialController::class, 'index'])->name('historial');
    
    Route::get('/gastos', [App\Http\Controllers\User\UserExpenseController::class, 'index'])->name('gastos');
    Route::post('/gastos', [App\Http\Controllers\User\UserExpenseController::class, 'store'])->name('gastos.store');
    
    Route::get('/metas', [App\Http\Controllers\User\UserGoalsController::class, 'index'])->name('metas');
    
    Route::get('/perfil', [App\Http\Controllers\User\UserProfileController::class, 'index'])->name('perfil');
});
