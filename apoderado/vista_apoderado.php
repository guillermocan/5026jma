<?php
session_start();
$nombreUsuario = $_SESSION['usuario_nombre'] ?? "Usuario"; 
$inicial = strtoupper(substr($nombreUsuario, 0, 1));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/5526/5526487.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I.E. 5026 José María Arguedas - Portal Institucional</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        :root {
            --azul-corp: #003366; 
            --rojo-corp: #CC0000; 
            --amarillo-corp: #ffc107;
            --negro-footer: #111111;
        }
        
        body { 
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }

        /* Navbar Estilizada */
        .navbar { background-color: var(--azul-corp); padding: 12px 0; border-bottom: 3px solid var(--amarillo-corp); }
        
        .typing-container {
            color: white;
            font-size: 1rem;
            font-weight: 600;
            border-right: 3px solid var(--amarillo-corp);
            white-space: nowrap;
            overflow: hidden;
            width: 0;
            animation: typing 4s steps(30) infinite alternate;
            letter-spacing: 1px;
        }

        @keyframes typing { from { width: 0; } to { width: 100%; } }

        /* SECCIÓN CENTRAL: EMOCIÓN Y DINAMISMO */
        .main-container {
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
        }

        .welcome-text h1 {
            color: var(--azul-corp);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: -1px;
            margin-bottom: 10px;
        }

        .card-portal {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 24px;
            padding: 40px;
            width: 320px;
            text-align: center;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            position: relative;
            overflow: hidden;
        }

        /* Efecto de brillo al pasar el mouse */
        .card-portal::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, transparent 70%);
            opacity: 0;
            transition: 0.5s;
        }

        .card-portal:hover::before { opacity: 0.3; }

        .card-portal:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
            background: rgba(255, 255, 255, 0.9);
        }

        .icon-box {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            font-size: 3rem;
            transition: 0.3s;
        }

        /* Estilos específicos para cada botón */
        .card-matricula { color: var(--azul-corp); }
        .card-matricula .icon-box { background: #e7f1ff; color: var(--azul-corp); }
        .card-matricula:hover { border-color: var(--azul-corp); }

        .card-seguimiento { color: #856404; }
        .card-seguimiento .icon-box { background: #fff3cd; color: var(--amarillo-corp); }
        .card-seguimiento:hover { border-color: var(--amarillo-corp); }

        .card-portal span {
            display: block;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .card-portal small {
            color: #6c757d;
            font-weight: 500;
        }

        /* Footer */
        footer { background-color: var(--negro-footer); color: #bbb; padding: 40px 0; border-top: 5px solid var(--rojo-corp); }
        .profile-circle { width: 45px; height: 45px; background-color: var(--amarillo-corp); color: var(--azul-corp); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; border: 2px solid white; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5wh1yqMyIrtbUHApLfrKAR6im571OG_xeuA&s" alt="Logo" style="width:50px; margin-right:10px;">
                <div>
                    <span class="fw-bold d-block">I.E. 5026</span>
                    <small style="font-size: 0.7rem; color: #ccc;">JOSÉ MARÍA ARGUEDAS</small>
                </div>
            </a>
            <div class="mx-auto d-none d-md-block">
                <div class="typing-container">GESTIÓN ACADÉMICA 2026</div>
            </div>
            <div class="ms-auto">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <div class="profile-circle"><?php echo $inicial; ?></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 animate__animated animate__fadeIn">
                        <li><h6 class="dropdown-header">Bienvenido, <?php echo $nombreUsuario; ?></h6></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="../auth/logout.php"><i class="fa-solid fa-power-off me-2"></i>Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main class="main-container">
        <div class="container text-center">
            <div class="welcome-text mb-5 animate__animated animate__fadeInDown">
                <h1 class="display-4">¿Qué haremos hoy?</h1>
                <p class="lead text-muted">Selecciona el proceso que deseas realizar en el sistema</p>
            </div>
            
            <div class="d-flex flex-wrap justify-content-center gap-5">
                <a href="matricula.php" class="card-portal card-matricula animate__animated animate__zoomIn animate__delay-1s">
                    <div class="icon-box">
                        <i class="fa-solid fa-file-signature"></i>
                    </div>
                    <span>MATRÍCULA</span>
                    <small>Proceso Regular 2026</small>
                </a>
                
                <a href="seguimiento.php" class="card-portal card-seguimiento animate__animated animate__zoomIn animate__delay-1s">
                    <div class="icon-box">
                        <i class="fa-solid fa- binoculars"></i>
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <span>SEGUIMIENTO</span>
                    <small>Estado de mis trámites</small>
                </a>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <h5 class="text-white fw-bold">I.E. 5026 José María Arguedas</h5>
                    <p class="small mb-0">Liderazgo, valores y tecnología al servicio de la comunidad.</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-4 mt-md-0">
                    <div class="d-inline-block text-start p-3 rounded" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                        <p class="small text-warning fw-bold mb-1">DESARROLLADO POR:</p>
                        <p class="mb-0 text-white">Grupo 1 - Ingeniería UNAC</p>
                        <p class="small mb-0" style="font-size: 0.75rem;">Contacto: dipradom@unac.edu.pe</p>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: #333;">
            <p class="text-center small mb-0">© 2026 Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>