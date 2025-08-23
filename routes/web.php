<?php

use Illuminate\Support\Facades\Route;

// 📊 Dashboard
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// 🔐 Autenticación
// Login
Route::get('/login', function () {
    return view('auth.login'); // Mostrar formulario
})->name('login');

Route::post('/login', function () {
    // 👇 Lógica dummy (más adelante se reemplaza con Auth real)
    return redirect()->route('dashboard');
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
