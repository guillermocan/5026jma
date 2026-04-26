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

// Consulta con JOIN para traer datos del estudiante
$sql = "SELECT m.ID_Matricula, m.Estado_tramite, m.Fecha_registro, 
               e.Nombres, e.ApellidoP, e.ApellidoM, e.Nivel, e.Grado
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
    <title>Seguimiento - I.E. 5026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --azul: #003366; --amarillo: #ffc107; }
        body { background-color: #f4f7f6; }
        .navbar { background: var(--azul); border-bottom: 3px solid var(--amarillo); }
        
        /* Círculo de Perfil */
        .profile-circle { 
            width: 40px; height: 40px; 
            background: var(--amarillo); 
            color: var(--azul); 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-weight: bold; 
        }

        /* Stepper Personalizado */
        .stepper-wrapper { display: flex; justify-content: space-between; margin-top: 30px; position: relative; }
        .stepper-item { position: relative; display: flex; flex-direction: column; align-items: center; flex: 1; z-index: 2; }
        .stepper-item::before { 
            position: absolute; content: ""; border-bottom: 2px solid #ddd; 
            width: 100%; top: 20px; left: -50%; z-index: 1; 
        }
        .stepper-item:first-child::before { content: none; }
        .step-counter { 
            position: relative; z-index: 5; display: flex; justify-content: center; 
            align-items: center; width: 40px; height: 40px; border-radius: 50%; 
            background: #ddd; color: white; margin-bottom: 8px; 
        }
        
        /* Estados del Stepper */
        .active .step-counter { background-color: var(--azul); }
        .completed .step-counter { background-color: #198754; }
        .active .step-name { font-weight: bold; color: var(--azul); }
        
        .card-tramite { border: none; border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark sticky-top p-2">
        <div class="container">
            <a class="navbar-brand fw-bold" href="vista_apoderado.php">
                <i class="fa-solid fa-graduation-cap me-2"></i> JOSÉ MARÍA ARGUEDAS
            </a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3 d-none d-md-inline small"><?php echo $nombreUsuario; ?></span>
                <div class="profile-circle"><?php echo $inicial; ?></div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h3 class="fw-bold mb-4" style="color: var(--azul);">Seguimiento de Trámites</h3>
                
                <?php if (empty($solicitudes)): ?>
                    <div class="card card-tramite p-5 text-center">
                        <i class="fa-solid fa-folder-open display-1 text-muted mb-3"></i>
                        <p class="text-muted">No se encontraron matrículas registradas para su cuenta.</p>
                        <a href="matricular.php" class="btn btn-primary px-4">Iniciar Matrícula</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($solicitudes as $s): 
                        // Lógica de progreso
                        $estado = $s['Estado_tramite'];
                        $progreso = 1; // Enviado
                        if ($estado == 'En Revisión' || $estado == 'Observado') $progreso = 2;
                        if ($estado == 'Finalizado') $progreso = 3;
                    ?>
                    <div class="card card-tramite mb-4 p-4">
                        <div class="row align-items-center">
                            <div class="col-md-5 border-end">
                                <span class="badge bg-primary mb-2">ID: #<?php echo $s['ID_Matricula']; ?></span>
                                <h4 class="fw-bold mb-1"><?php echo $s['Nombres'] . " " . $s['ApellidoP']; ?></h4>
                                <p class="text-muted mb-3"><?php echo $s['Grado'] . "° " . $s['Nivel']; ?></p>
                                <p class="small mb-0"><strong>Fecha de Solicitud:</strong> <?php echo date('d/m/Y', strtotime($s['Fecha_registro'])); ?></p>
                                <div class="mt-3">
                                    <a href="reporte_matricula.php?id=<?php echo $s['ID_Matricula']; ?>" target="_blank" class="btn btn-outline-danger btn-sm">
                                        <i class="fa-solid fa-file-pdf me-1"></i> Imprimir Constancia
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-md-7 mt-4 mt-md-0">
                                <div class="stepper-wrapper">
                                    <div class="stepper-item <?php echo ($progreso >= 1) ? 'active' : ''; ?>">
                                        <div class="step-counter"><i class="fa-solid fa-check"></i></div>
                                        <div class="step-name small">Enviado</div>
                                    </div>
                                    <div class="stepper-item <?php echo ($progreso >= 2) ? 'active' : ''; ?>">
                                        <div class="step-counter">
                                            <i class="fa-solid <?php echo ($estado == 'Observado') ? 'fa-triangle-exclamation text-warning' : 'fa-magnifying-glass'; ?>"></i>
                                        </div>
                                        <div class="step-name small"><?php echo ($estado == 'Observado') ? 'Observado' : 'Revisión'; ?></div>
                                    </div>
                                    <div class="stepper-item <?php echo ($progreso >= 3) ? 'completed' : ''; ?>">
                                        <div class="step-counter"><i class="fa-solid fa-flag-checkered"></i></div>
                                        <div class="step-name small">Finalizado</div>
                                    </div>
                                </div>

                                <?php if ($estado == 'Observado'): ?>
                                    <div class="alert alert-warning mt-4 py-2 border-0 shadow-sm animate__animated animate__shakeX">
                                        <i class="fa-solid fa-circle-exclamation me-2"></i> 
                                        <strong>Observación:</strong> Por favor, verifique sus documentos en secretaría.
                                    </div>
                                <?php endif; ?>
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