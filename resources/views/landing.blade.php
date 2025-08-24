@extends('layouts.landing')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="hero-title">
                        <span class="brand-name">SueldoVivo</span>
                        <span class="hero-subtitle">Gestión Financiera en Tiempo Real</span>
                    </h1>
                    <p class="hero-description">
                        Transforma la manera en que tu empresa maneja las finanzas. 
                        Visualiza ingresos, egresos y nóminas con transparencia total 
                        y control inteligente.
                    </p>
                    <div class="hero-cta">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">
                            <i class="bi bi-rocket-takeoff me-2"></i>Comenzar Gratis
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-mockup">
                    <div class="dashboard-preview">
                        <div class="preview-header">
                            <div class="preview-dots">
                                <span></span><span></span><span></span>
                            </div>
                            <span class="preview-title">SueldoVivo Dashboard</span>
                        </div>
                        <div class="preview-content">
                            <!-- Dashboard Cards Preview -->
                            <div class="row mb-3">
                                <div class="col-4">
                                    <div class="preview-card success">
                                        <div class="preview-card-icon">
                                            <i class="bi bi-arrow-up-circle"></i>
                                        </div>
                                        <div class="preview-card-content">
                                            <small>Ingresos</small>
                                            <strong>$125,450</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="preview-card danger">
                                        <div class="preview-card-icon">
                                            <i class="bi bi-arrow-down-circle"></i>
                                        </div>
                                        <div class="preview-card-content">
                                            <small>Egresos</small>
                                            <strong>$89,320</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="preview-card primary">
                                        <div class="preview-card-icon">
                                            <i class="bi bi-wallet2"></i>
                                        </div>
                                        <div class="preview-card-content">
                                            <small>Balance</small>
                                            <strong>$36,130</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Table Preview -->
                            <div class="preview-table">
                                <div class="table-header">Últimos Movimientos</div>
                                <div class="table-row">
                                    <span>Venta de productos</span>
                                    <span class="text-success">+$15,500</span>
                                </div>
                                <div class="table-row">
                                    <span>Pago de nómina</span>
                                    <span class="text-danger">-$8,200</span>
                                </div>
                                <div class="table-row">
                                    <span>Servicios profesionales</span>
                                    <span class="text-success">+$3,750</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="section-title">¿Por qué elegir SueldoVivo?</h2>
                <p class="section-subtitle">Herramientas poderosas para una gestión financiera eficiente</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <h4>Dashboard Intuitivo</h4>
                    <p>Visualiza toda tu información financiera en un panel centralizado y fácil de entender.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h4>Análisis en Tiempo Real</h4>
                    <p>Monitorea ingresos, egresos y tendencias financieras con actualizaciones instantáneas.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h4>Gestión de Empleados</h4>
                    <p>Administra nóminas, bonos y información de empleados de manera centralizada.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-bar-chart"></i>
                    </div>
                    <h4>Reportes Avanzados</h4>
                    <p>Genera reportes detallados y exporta datos para análisis profundos.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4>Seguridad Total</h4>
                    <p>Protección avanzada de datos con encriptación y respaldos automáticos.</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                    <h4>Acceso Móvil</h4>
                    <p>Gestiona tus finanzas desde cualquier dispositivo, en cualquier momento.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="cta-title">¿Listo para transformar tu gestión financiera?</h2>
                <p class="cta-description">
                    Únete a cientos de empresas que ya confían en SueldoVivo para 
                    optimizar sus procesos financieros y tomar decisiones inteligentes.
                </p>
                <div class="cta-buttons">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">
                        <i class="bi bi-rocket-takeoff me-2"></i>Comenzar Ahora
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-eye me-2"></i>Ver Demo
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* SueldoVivo Landing Page Styles */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.brand-name {
    display: block;
    font-size: 3.5rem;
    font-weight: 800;
    background: linear-gradient(45deg, #ffffff, #e3f2fd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.hero-subtitle {
    display: block;
    font-size: 1.5rem;
    font-weight: 300;
    opacity: 0.9;
    margin-bottom: 1.5rem;
}

.hero-description {
    font-size: 1.2rem;
    line-height: 1.6;
    opacity: 0.9;
    margin-bottom: 2rem;
}

.hero-mockup {
    position: relative;
    z-index: 2;
}

.dashboard-preview {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    transform: perspective(1000px) rotateY(-5deg) rotateX(5deg);
    transition: transform 0.3s ease;
}

.dashboard-preview:hover {
    transform: perspective(1000px) rotateY(0deg) rotateX(0deg);
}

.preview-header {
    background: #f8f9fa;
    padding: 1rem;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.preview-dots {
    display: flex;
    gap: 0.5rem;
}

.preview-dots span {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #dc3545;
}

.preview-dots span:nth-child(2) {
    background: #ffc107;
}

.preview-dots span:nth-child(3) {
    background: #28a745;
}

.preview-title {
    font-weight: 600;
    color: #495057;
}

.preview-content {
    padding: 1.5rem;
    color: #495057;
}

.preview-card {
    background: white;
    border-radius: 8px;
    padding: 1rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
}

.preview-card.success {
    border-left: 4px solid #28a745;
}

.preview-card.danger {
    border-left: 4px solid #dc3545;
}

.preview-card.primary {
    border-left: 4px solid #0d6efd;
}

.preview-card-icon {
    font-size: 1.5rem;
}

.preview-card.success .preview-card-icon {
    color: #28a745;
}

.preview-card.danger .preview-card-icon {
    color: #dc3545;
}

.preview-card.primary .preview-card-icon {
    color: #0d6efd;
}

.preview-card-content small {
    display: block;
    font-size: 0.75rem;
    opacity: 0.7;
}

.preview-card-content strong {
    font-size: 1rem;
    font-weight: 600;
}

.preview-table {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.table-header {
    background: #f8f9fa;
    padding: 0.75rem 1rem;
    font-weight: 600;
    border-bottom: 1px solid #dee2e6;
}

.table-row {
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #f8f9fa;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-row:last-child {
    border-bottom: none;
}

.features-section {
    background: #f8f9fa;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: 1.2rem;
    color: #6c757d;
    margin-bottom: 0;
}

.feature-card {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    text-align: center;
    height: 100%;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.feature-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: white;
}

.feature-card h4 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.feature-card p {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 0;
}

.cta-section {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

.cta-description {
    font-size: 1.2rem;
    line-height: 1.6;
    opacity: 0.9;
    margin-bottom: 2rem;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    padding: 0.75rem 2rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.btn-outline-light {
    border: 2px solid rgba(255, 255, 255, 0.3);
    padding: 0.75rem 2rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-light:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .brand-name {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
    }
    
    .hero-description {
        font-size: 1rem;
    }
    
    .dashboard-preview {
        transform: none;
        margin-top: 2rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .cta-title {
        font-size: 2rem;
    }
}
</style>
@endsection
