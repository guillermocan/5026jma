<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Apoderado - I.E. 5026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root { --azul-corp: #003366; --rojo-corp: #CC0000; --gris-oscuro: #1a1a1a; }
        body { background-color: var(--gris-oscuro); color: white; font-family: 'Segoe UI', sans-serif; }
        
        .navbar { background-color: var(--azul-corp); padding: 15px 0; }
        .logo-placeholder { width: 50px; height: 50px; background: #ddd; display: inline-block; border-radius: 5px; margin-right: 10px; }
        
        .registro-container { background: white; border-radius: 15px; overflow: hidden; color: #333; }
        .img-colegio {
            background: url('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEg3znDJ0zqjni-ZS6U-g_DTOsHTlLRls0EWHsecFUriBNhZOBVk5mkhEEYkVfZzfjS8X94_QxFAQkKVfzbpTxI3BGDS8wzgwYDPvmxpzM3sbqSkNaXPI6yDm27mQhC3BrmsuRYzAy0W-5U/w1200-h630-p-k-no-nu/FOTO-1.jpg') center/cover;
            min-height: 400px;
        }
        
        footer { background-color: #111; color: #888; padding: 50px 0; border-top: 4px solid var(--rojo-corp); }
        .dev-info { color: #fff; font-size: 0.85rem; border: 1px solid #333; padding: 15px; border-radius: 8px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="../index.php">
                <div class="logo-placeholder">
                    <img src="../assets/img/logo_ie.png" alt="Logo" style="width:100%; height:100%; object-fit:contain;">
                </div>
                <span class="fw-bold text-uppercase">I.E. 5026</span>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto fw-bold text-uppercase align-items-center">
                    <li class="nav-item"><a class="nav-link" href="../index.php">INICIO</a></li>
                    <li class="nav-item"><a class="nav-link" href="matricula.php">MATRÍCULA</a></li>
                    <li class="nav-item"><a class="nav-link" href="fechas.php">FECHAS</a></li>
                    <li class="nav-item"><a class="nav-link" href="eventos.php">EVENTOS</a></li>
                    <li class="nav-item ms-lg-3">
                        <button class="btn btn-outline-light px-3" data-bs-toggle="modal" data-bs-target="#loginModal">INTRANET</button>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <button class="btn btn-secondary px-3 disabled" disabled>REGISTRARSE</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="registro-container shadow-lg">
            <div class="row g-0">
                <div class="col-lg-6 p-5">
                    <h2 class="fw-bold text-uppercase mb-4" style="color: var(--azul-corp);">Crear Cuenta de Apoderado</h2>
                    <p class="text-muted mb-4">Complete sus datos para iniciar el proceso de matrícula.</p>
                    
                    <form action="../auth/procesar_registro.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">NOMBRES</label>
                                <input type="text" name="nombres" class="form-control" placeholder="Ej. Juan" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold small">APELLIDOS</label>
                                <input type="text" name="apellidos" class="form-control" placeholder="Ej. Pérez" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">DNI (Será su usuario)</label>
                            <input type="text" name="dni" class="form-control" maxlength="8" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">TELÉFONO</label>
                            <input type="tel" name="telefono" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">DIRECCIÓN</label>
                            <input type="text" name="direccion" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold small">CONTRASEÑA TEMPORAL</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold text-uppercase shadow">
                            Finalizar Registro
                        </button>
                    </form>
                </div>
                
                <div class="col-lg-6 d-none d-lg-block img-colegio">
                    <div class="h-100 w-100 p-5 d-flex align-items-end" style="background: linear-gradient(to top, rgba(0,51,102,0.8), transparent);">
                        <p class="text-white fw-light italic">"Educar es dar al cuerpo y al alma toda la belleza y perfección de que son capaces."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <h5 class="text-white fw-bold mb-3 text-uppercase">I.E. 5026 José María Arguedas</h5>
                    <p class="small mb-0">Av. Principal s/n, Callao, Perú.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="dev-info d-inline-block text-start">
                        <p class="mb-1 fw-bold text-warning small text-uppercase">Software desarrollado por:</p>
                        <p class="mb-0 fs-6 text-white">Grupo 1</p>
                        <p class="small mb-0 text-secondary">Contacto: dipradom@unac.edu.pe</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-dark text-white border-0">
                    <h5 class="modal-title fw-bold text-uppercase">Acceso Intranet</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-dark">
                    <form action="../auth/login_auth.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold small">DNI USUARIO</label>
                            <input type="text" name="username" class="form-control form-control-lg" placeholder="Ingrese su DNI" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">CONTRASEÑA</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="********" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold py-3 mt-2 text-uppercase">Ingresar al Sistema</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>