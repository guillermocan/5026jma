<?php
session_start();
require_once '../config/db.php';

// Seguridad: Solo apoderados
if (!isset($_SESSION['ID_Apoderado'])) {
    header("Location: ../index.php");
    exit();
}

$id_apoderado = $_SESSION['ID_Apoderado'];
$nombreUsuario = $_SESSION['NombreFull'] ?? "Usuario";
$inicial = strtoupper(substr($nombreUsuario, 0, 1));

// Consulta para traer datos de matrícula
$sql = "SELECT m.ID_Matricula, m.Estado_tramite, m.Fecha_registro, m.Observaciones,
               e.ID_Estudiante, e.Nombres, e.ApellidoP, e.ApellidoM, e.Nivel, e.Grado
        FROM Matricula m
        INNER JOIN Estudiante e ON m.ID_Estudiante = e.ID_Estudiante
        WHERE m.ID_Apoderado = ?
        ORDER BY m.Fecha_registro DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id_apoderado]);
$solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Matrícula - I.E. 5026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --azul: #003366; --amarillo: #ffc107; --rojo: #CC0000; --verde: #198754; }
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: var(--azul); border-bottom: 3px solid var(--rojo); }
        .profile-circle { 
            width: 40px; height: 40px; background: #fff; color: var(--azul); 
            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
            font-weight: bold; border: 2px solid var(--amarillo);
        }
        
        /* Stepper Mejorado */
        .stepper-wrapper { display: flex; justify-content: space-between; margin-top: 20px; position: relative; }
        .stepper-item { position: relative; display: flex; flex-direction: column; align-items: center; flex: 1; z-index: 2; }
        .stepper-item::before { 
            position: absolute; content: ""; border-bottom: 3px solid #dee2e6; 
            width: 100%; top: 20px; left: -50%; z-index: 1; 
        }
        .stepper-item:first-child::before { content: none; }
        
        .step-counter { 
            position: relative; z-index: 5; display: flex; justify-content: center; 
            align-items: center; width: 40px; height: 40px; border-radius: 50%; 
            background: #dee2e6; color: white; margin-bottom: 8px; transition: 0.4s;
        }
        
        /* Estados del Stepper */
        .active .step-counter { background-color: var(--azul); box-shadow: 0 0 0 4px rgba(0, 51, 102, 0.2); }
        .completed .step-counter { background-color: var(--verde); }
        .rejected .step-counter { background-color: var(--rojo); }
        
        .step-name { font-size: 0.75rem; text-transform: uppercase; font-weight: 600; color: #6c757d; }
        .active .step-name { color: var(--azul); }
        .completed .step-name { color: var(--verde); }
        .rejected .step-name { color: var(--rojo); }

        .card-tramite { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); overflow: hidden; }
        .status-banner { padding: 10px; text-align: center; font-weight: bold; font-size: 0.9rem; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark sticky-top p-2 shadow">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="vista_apoderado.php">
                <i class="fa-solid fa-graduation-cap me-2 text-warning"></i> INTRANET MATRÍCULA
            </a>
            <div class="d-flex align-items-center">
                <div class="profile-circle me-2"><?php echo $inicial; ?></div>
                <div class="text-white small d-none d-md-block">
                    <strong><?php echo $nombreUsuario; ?></strong>
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold m-0" style="color: var(--azul);">Estado de Solicitudes</h3>
                    <a href="matricular.php" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="fa-solid fa-plus me-2"></i>Nueva Matrícula
                    </a>
                </div>
                
                <?php if (empty($solicitudes)): ?>
                    <div class="card card-tramite p-5 text-center bg-white">
                        <img src="https://cdn-icons-png.flaticon.com/512/6598/6598519.png" style="width: 120px; opacity: 0.5;" class="mb-4">
                        <h5>Aún no has registrado ninguna matrícula</h5>
                        <p class="text-muted">Inicia el proceso dándole clic al botón de "Nueva Matrícula".</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($solicitudes as $s): 
                        $estado = $s['Estado_tramite'];
                        
                        // Lógica de clases para el stepper
                        $claseStep2 = ($estado != 'Enviado') ? 'active' : '';
                        $claseStep3 = '';
                        $iconoStep3 = 'fa-flag-checkered';
                        $textoStep3 = 'Finalizado';

                        if ($estado == 'Aprobado') {
                            $claseStep3 = 'completed';
                            $iconoStep3 = 'fa-check-double';
                            $textoStep3 = 'Aprobado';
                        } elseif ($estado == 'Rechazado') {
                            $claseStep3 = 'rejected';
                            $iconoStep3 = 'fa-circle-xmark';
                            $textoStep3 = 'Rechazado';
                        }
                    ?>
                    <div class="card card-tramite mb-4 bg-white border-start border-4 <?php echo ($estado == 'Rechazado' ? 'border-danger' : ($estado == 'Aprobado' ? 'border-success' : 'border-warning')); ?>">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-4 border-end">
                                    <div class="mb-2">
                                        <span class="badge bg-light text-primary border">ID Trámite: #<?php echo $s['ID_Matricula']; ?></span>
                                        <span class="text-muted small ms-2"><i class="fa-regular fa-calendar me-1"></i><?php echo date('d/m/Y', strtotime($s['Fecha_registro'])); ?></span>
                                    </div>
                                    <h4 class="fw-bold mb-1 text-dark"><?php echo $s['ApellidoP'] . " " . $s['ApellidoM'] . ", " . $s['Nombres']; ?></h4>
                                    <p class="text-muted mb-3"><i class="fa-solid fa-school me-2"></i><?php echo $s['Grado'] . "° " . $s['Nivel']; ?></p>
                                    
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="reporte_matricula.php?id=<?php echo $s['ID_Matricula']; ?>" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                            <i class="fa-solid fa-file-pdf me-1"></i> Constancia
                                        </a>
                                        <?php if ($estado == 'Rechazado'): ?>
                                            <a href="editar_matricula.php?id=<?php echo $s['ID_Matricula']; ?>" class="btn btn-warning btn-sm rounded-pill px-3 shadow-sm fw-bold">
                                                <i class="fa-solid fa-pen-to-square me-1"></i> CORREGIR AHORA
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="col-md-8 mt-4 mt-md-0">
                                    <div class="stepper-wrapper">
                                        <div class="stepper-item active">
                                            <div class="step-counter"><i class="fa-solid fa-paper-plane"></i></div>
                                            <div class="step-name">Enviado</div>
                                        </div>
                                        <div class="stepper-item <?php echo $claseStep2; ?>">
                                            <div class="step-counter"><i class="fa-solid fa-spinner"></i></div>
                                            <div class="step-name">En Revisión</div>
                                        </div>
                                        <div class="stepper-item <?php echo $claseStep3; ?>">
                                            <div class="step-counter"><i class="fa-solid <?php echo $iconoStep3; ?>"></i></div>
                                            <div class="step-name"><?php echo $textoStep3; ?></div>
                                        </div>
                                    </div>

                                    <?php if (!empty($s['Observaciones'])): ?>
                                        <div class="alert mt-4 mb-0 py-3 border-0 shadow-sm d-flex align-items-center <?php echo ($estado == 'Rechazado' ? 'alert-danger' : 'alert-info'); ?>" style="border-radius: 15px;">
                                            <i class="fa-solid fa-comment-dots me-3 fs-4"></i>
                                            <div>
                                                <strong class="d-block">Mensaje de Secretaría:</strong>
                                                <span class="small"><?php echo htmlspecialchars($s['Observaciones']); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>