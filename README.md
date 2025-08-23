<p align="center"><a href="https://laravel.com" target="_blank">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</a></p>

# GestorFinanzas

**GestorFinanzas** es una aplicación web desarrollada en **Laravel** para la **gestión financiera de empleados y usuarios**.  
Permite administrar **ingresos, egresos, sueldos, descuentos, bonos y reportes**, con un diseño **minimalista y profesional** inspirado en el estilo clásico de Twitter.  

---

## Características principales
- Dashboard con métricas de ingresos, egresos y balance.
- Gestión de **ingresos y egresos** con formularios detallados.
- Módulo de **empleados**: sueldos brutos, descuentos, sueldos líquidos, bonos y horas extra.
- **Reportes gráficos** de la situación financiera.
- Autenticación de usuarios con **Laravel Breeze**.

---

## Tecnologías utilizadas
- **Laravel 11** (framework PHP)
- **Blade Templates** (frontend)
- **TailwindCSS** (estilos minimalistas)
- **MySQL** (base de datos)
- **GitHub** (control de versiones)

---

## Instalación y uso
```bash
# Clonar repositorio
git clone https://github.com/emili0v/gestor-finanzas.git

# Entrar al directorio
cd gestor-finanzas

# Instalar dependencias
composer install
npm install && npm run dev

# Configurar archivo .env
cp .env.example .env
php artisan key:generate

# Migrar base de datos
php artisan migrate --seed

# Levantar servidor
php artisan serve
