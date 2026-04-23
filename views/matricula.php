<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/4078/4078099.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proceso de Matrícula - I.E. 5026 José María Arguedas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --azul-corp: #003366;
            --rojo-corp: #CC0000;
            --negro-footer: #111111;
            --gris-oscuro: #1a1a1a;
        }
        
        body { 
            background-color: var(--gris-oscuro); 
            font-family: 'Segoe UI', sans-serif; 
            color: white; 
        }

        .navbar { background-color: var(--azul-corp); padding: 15px 0; }
        .logo-placeholder { width: 50px; height: 50px; background: #ddd; display: inline-block; border-radius: 5px; margin-right: 10px; }

        /* Estilo de Pasos */
        .step-card {
            background: #ffffff;
            color: #333;
            border-radius: 15px;
            padding: 25px;
            height: 100%;
            border-bottom: 5px solid var(--azul-corp);
            transition: transform 0.3s;
        }
        .step-card:hover { transform: translateY(-10px); }
        .step-number {
            width: 40px; height: 40px;
            background: var(--rojo-corp);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Lista de Requisitos */
        .req-list { list-style: none; padding: 0; }
        .req-list li { margin-bottom: 10px; padding-left: 30px; position: relative; }
        .req-list li::before {
            content: "\F272";
            font-family: "bootstrap-icons";
            position: absolute;
            left: 0;
            color: var(--rojo-corp);
        }

        footer { background-color: var(--negro-footer); color: #888; padding: 50px 0; border-top: 4px solid var(--rojo-corp); }
        .dev-info { color: #fff; font-size: 0.85rem; border: 1px solid #333; padding: 15px; border-radius: 8px; }
    </style>
</head>
<body id="top">

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="../index.php">
                <div class="logo-placeholder">
                    <img src="../assets/img/logo_ie.png" alt="Logo" style="width:100%; height:100%; object-fit:contain;">
                </div>
                <div>
                    <span class="fw-bold d-block text-uppercase">I.E. 5026</span>
                    <small style="font-size: 0.7rem;">José María Arguedas</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto fw-bold text-uppercase">
                    <li class="nav-item"><a class="nav-link" href="../index.php#top">INICIO</a></li>
                    <li class="nav-item"><a class="nav-link active" href="matricula.php">MATRÍCULA</a></li>
                    <li class="nav-item"><a class="nav-link" href="fechas.php">FECHAS</a></li>
                    <li class="nav-item"><a class="nav-link" href="eventos.php">EVENTOS</a></li>
                    <li class="nav-item ms-lg-3">
                        <button class="btn btn-outline-light px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal">INTRANET</button>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="registro_apoderado.php" class="btn btn-danger px-3 fw-bold shadow-sm">
                            <i class="bi bi-person-plus-fill"></i> REGISTRARSE
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold display-5 text-uppercase">Guía de Matrícula 2026</h1>
            <div style="width: 100px; height: 4px; background: var(--rojo-corp); margin: 15px auto;"></div>
            <p class="text-secondary lead">Siga estos pasos para formalizar la inscripción de su menor hijo.</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="step-card shadow">
                    <div class="step-number">1</div>
                    <h5 class="fw-bold text-uppercase">Verificar fechas</h5>
                    <p class="small">Consulte en nuestra sección de <strong>Fechas</strong> los días correspondientes de matrícula.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card shadow">
                    <div class="step-number">2</div>
                    <h5 class="fw-bold text-uppercase">Reunir Requisitos</h5>
                    <p class="small">Prepare el expediente completo con los documentos originales y copias solicitadas por el Ministerio de Educación.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card shadow">
                    <div class="step-number">3</div>
                    <h5 class="fw-bold text-uppercase">Matrícula virtual</h5>
                    <p class="small">Acceda a la intranet el día correspondiente y realice su matrícula, padres nuevos deben registrarse</p>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-lg-6">
                <h3 class="fw-bold text-uppercase mb-4"><i class="bi bi-file-earmark-text"></i> Requisitos Obligatorios</h3>
                <ul class="req-list">
                    <li>Ficha Única de Matrícula (generada por el SIAGIE).</li>
                    <li>Copia simple del DNI del estudiante y de ambos padres.</li>
                    <li>Constancia de No Adeudo (solo para traslados de colegios particulares).</li>
                    <li>Certificado de estudios originales del año anterior.</li>
                    <li>Copia de la tarjeta de vacunación (Nivel Inicial y Primaria).</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="p-4 rounded shadow-sm" style="background: rgba(255,255,255,0.05); border: 1px border-secondary;">
                    <h3 class="fw-bold text-uppercase mb-4"><i class="bi bi-download"></i> Documentos para Descargar</h3>
                    <div class="d-grid gap-3">
                        <a href="#" class="btn btn-outline-light text-start p-3">
                            <i class="bi bi-file-pdf text-danger"></i> Solicitud de Vacante 2026
                        </a>
                        <a href="#" class="btn btn-outline-light text-start p-3">
                            <i class="bi bi-file-pdf text-danger"></i> Contrato de Servicios Educativos
                        </a>
                        <a href="#" class="btn btn-outline-light text-start p-3">
                            <i class="bi bi-file-pdf text-danger"></i> Reglamento Interno (Resumen)
                        </a>
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