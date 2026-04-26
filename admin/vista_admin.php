<?php
session_start();
require_once '../config/db.php';

// SEGURIDAD: Solo Administradores
if (!isset($_SESSION['ID_Usuario']) || $_SESSION['Rol'] !== 'Administrador') {
    header("Location: ../index.php?error=acceso_prohibido");
    exit();
}

// Consultas rápidas para los indicadores
try {
    $totalUsuarios = $pdo->query("SELECT COUNT(*) FROM Usuario")->fetchColumn();
    $totalMatriculas = $pdo->query("SELECT COUNT(*) FROM Matricula")->fetchColumn();
    $vacantesDisponibles = $pdo->query("SELECT SUM(Vacantes_asignadas) FROM Configuracion_Matricula WHERE Ano_escolar = 2026")->fetchColumn();
} catch (PDOException $e) {
    $totalUsuarios = 0; $totalMatriculas = 0; $vacantesDisponibles = 0;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administración - I.E. 5026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --azul-corp: #003366;
            --rojo-corp: #CC0000;
            --gris-fondo: #f4f7f6;
        }
        
        /* Layout para que el footer siempre esté al fondo */
        html, body { height: 100%; }
        body { 
            display: flex; 
            flex-direction: column; 
            background-color: var(--gris-fondo); 
            font-family: 'Segoe UI', sans-serif; 
        }

        .main-content { flex: 1 0 auto; }

        .navbar-admin { background-color: var(--azul-corp); border-bottom: 4px solid var(--rojo-corp); }
        .nav-link.active { color: #aaa !important; cursor: not-allowed; }
        
        /* Estilos del Avatar Dropdown */
        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--azul-corp);
            font-size: 1.2rem;
            border: 2px solid rgba(255,255,255,0.2);
            transition: 0.3s;
        }
        .dropdown-toggle::after { display: none; }
        .user-avatar:hover { background-color: #f1f1f1; transform: scale(1.05); }

        .welcome-section {
            background: linear-gradient(135deg, var(--azul-corp) 0%, #004080 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Estilo para las Acciones Rápidas */
        .action-card {
            border: none;
            border-radius: 12px;
            transition: 0.3s;
            background: white;
        }
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }

        footer { 
            flex-shrink: 0;
            background-color: #111; 
            color: #888; 
            padding: 25px 0; 
            border-top: 3px solid var(--rojo-corp);
        }
        .dev-tag { border: 1px solid #333; padding: 8px 15px; border-radius: 8px; display: inline-block; }
    </style>
</head>
<body>

    <div class="main-content">
        <nav class="navbar navbar-expand-lg navbar-dark navbar-admin sticky-top shadow">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <div class="bg-light p-1 rounded me-2" style="width: 35px; height: 35px;">
                        <img src="../assets/img/logo_ie.png" alt="Logo" style="width:100%; height:100%; object-fit:contain;">
                    </div>
                    <span class="fw-bold text-uppercase">Panel Admin</span>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navAdmin">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navAdmin">
                    <ul class="navbar-nav me-auto fw-bold text-uppercase">
                        <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="gestionar_matriculas.php">Gestionar Matrículas</a></li>
                        <li class="nav-item"><a class="nav-link" href="mantenimiento.php">Mantenimiento</a></li>
                        <li class="nav-item"><a class="nav-link" href="dashboards.php">Dashboards</a></li>
                    </ul>

                    <div class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="text-white me-2 d-none d-lg-inline small fw-bold"><?php echo $_SESSION['NombreFull']; ?></span>
                            <div class="user-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userDropdown">
                            <li class="px-3 py-2 d-lg-none">
                                <span class="fw-bold text-primary"><?php echo $_SESSION['NombreFull']; ?></span>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item py-2 text-danger fw-bold" href="../auth/logout.php"><i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container py-5">
            <div class="welcome-section d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-1">¡Bienvenido, <?php echo $_SESSION['NombreFull']; ?>!</h2>
                    <p class="mb-0 opacity-75">Panel de Gestión Académica e Inteligencia de Datos</p>
                </div>
                <i class="bi bi-shield-lock-fill d-none d-md-block" style="font-size: 3.5rem; opacity: 0.3;"></i>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-4 text-center">
                        <h6 class="text-muted small fw-bold text-uppercase">Usuarios Totales</h6>
                        <h2 class="fw-bold mb-0 text-primary"><?php echo $totalUsuarios; ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-4 text-center">
                        <h6 class="text-muted small fw-bold text-uppercase">Matrículas</h6>
                        <h2 class="fw-bold mb-0 text-success"><?php echo $totalMatriculas; ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-4 text-center">
                        <h6 class="text-muted small fw-bold text-uppercase">Vacantes 2026</h6>
                        <h2 class="fw-bold mb-0 text-danger"><?php echo ($vacantesDisponibles ?? '0'); ?></h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-4">
                    <h4 class="fw-bold text-uppercase"><i class="bi bi-grid-fill me-2 text-primary"></i> Acciones Rápidas</h4>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card action-card shadow-sm h-100 p-2">
                        <a href="gestionar_usuarios.php" class="text-decoration-none p-3">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="bg-primary bg-opacity-10 p-3 rounded text-primary">
                                    <i class="bi bi-people-fill fs-3"></i>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Control de Usuarios</h5>
                            <p class="text-muted small mb-0">Administre el acceso, roles y estados de los apoderados registrados en el sistema.</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card action-card shadow-sm h-100 p-2">
                        <a href="dashboards.php" class="text-decoration-none p-3">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="bg-danger bg-opacity-10 p-3 rounded text-danger">
                                    <i class="bi bi-graph-up-arrow fs-3"></i>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Métricas de Satisfacción</h5>
                            <p class="text-muted small mb-0">Analice los resultados de las encuestas de retención y satisfacción por grupo.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container text-center">
            <p class="mb-2 text-white">© 2026 I.E. 5026 José María Arguedas - Callao, Perú</p>
            <div class="dev-tag bg-dark">
                <small class="text-secondary">Desarrollo de Software | <strong>FIIS - UNAC</strong></small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>