<?php
session_start();
require_once '../config/db.php';

// 1. SEGURIDAD: Solo apoderados
if (!isset($_SESSION['ID_Apoderado'])) {
    header("Location: ../index.php");
    exit();
}

$id_matricula = $_GET['id'] ?? null;
$id_apoderado = $_SESSION['ID_Apoderado'];

if (!$id_matricula) {
    header("Location: seguimiento.php");
    exit();
}

// 2. OBTENER DATOS ACTUALES (Agregamos e.DNI a la consulta)
$sql = "SELECT m.*, e.DNI, e.Nombres, e.ApellidoP, e.ApellidoM, e.doc_dni, e.doc_expediente, e.doc_notas 
        FROM Matricula m 
        INNER JOIN Estudiante e ON m.ID_Estudiante = e.ID_Estudiante 
        WHERE m.ID_Matricula = ? AND m.ID_Apoderado = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_matricula, $id_apoderado]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die("Acceso no autorizado o registro no encontrado.");
}

// 3. PROCESAR ACTUALIZACIÓN
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_estudiante = $data['ID_Estudiante'];
    $dni_estudiante = $data['DNI']; // Usaremos este DNI para los nombres de archivo
    $carpeta_destino = "uploads/";

    // Función para reemplazar archivos y borrar el anterior
    function reemplazarArchivo($campo_file, $archivo_actual, $prefijo, $carpeta) {
        if (isset($_FILES[$campo_file]) && $_FILES[$campo_file]['error'] == 0) {
            // Borrar el anterior si existe
            if (!empty($archivo_actual) && file_exists($carpeta . $archivo_actual)) {
                unlink($carpeta . $archivo_actual);
            }
            // Subir el nuevo
            $ext = pathinfo($_FILES[$campo_file]['name'], PATHINFO_EXTENSION);
            // El nombre ahora será PREFIJO_DNI_TIMESTAMP.ext
            $nuevo_nombre = $prefijo . "_" . time() . "." . $ext;
            move_uploaded_file($_FILES[$campo_file]['tmp_name'], $carpeta . $nuevo_nombre);
            return $nuevo_nombre;
        }
        return $archivo_actual; // Mantener el actual si no se subió nada
    }

    // CORRECCIÓN: Ahora pasamos el DNI del estudiante como parte del prefijo
    $nuevo_dni = reemplazarArchivo('u_dni', $data['doc_dni'], "DNI_" . $dni_estudiante, $carpeta_destino);
    $nuevo_exp = reemplazarArchivo('u_exp', $data['doc_expediente'], "EXP_" . $dni_estudiante, $carpeta_destino);
    $nuevo_not = reemplazarArchivo('u_notas', $data['doc_notas'], "NOT_" . $dni_estudiante, $carpeta_destino);

    // Actualizar Base de Datos
    try {
        $pdo->beginTransaction();

        // Actualizar documentos en tabla Estudiante
        $sqlEst = "UPDATE Estudiante SET doc_dni = ?, doc_expediente = ?, doc_notas = ? WHERE ID_Estudiante = ?";
        $pdo->prepare($sqlEst)->execute([$nuevo_dni, $nuevo_exp, $nuevo_not, $id_estudiante]);

        // Resetear estado en tabla Matricula y limpiar observaciones para que el admin vea el reenvío limpio
        $sqlMat = "UPDATE Matricula SET Estado_tramite = 'Enviado', Fecha_registro = NOW() WHERE ID_Matricula = ?";
        $pdo->prepare($sqlMat)->execute([$id_matricula]);

        $pdo->commit();
        header("Location: seguimiento.php?update=success");
    } catch (Exception $e) {
        $pdo->rollBack();
        $error = "Error al actualizar: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corregir Matrícula - I.E. 5026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card-header { background-color: #ffc107 !important; }
        .form-label { color: #003366; }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-header text-dark fw-bold py-3">
                        <i class="fa-solid fa-pen-to-square me-2"></i> Subsanar Documentos del Estudiante
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-warning small">
                            <strong><i class="fa-solid fa-comment-dots me-1"></i> Observación de Secretaría:</strong><br>
                            <?php echo htmlspecialchars($data['Observaciones']); ?>
                        </div>

                        <form method="POST" enctype="multipart/form-data">
                            <h5 class="mb-3 text-primary fw-bold">
                                <?php echo $data['ApellidoP'] . " " . $data['ApellidoM'] . ", " . $data['Nombres']; ?>
                                <small class="text-muted d-block" style="font-size: 0.9rem;">DNI: <?php echo $data['DNI']; ?></small>
                            </h5>
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold small">Documento Nacional de Identidad (DNI):</label>
                                <input type="file" name="u_dni" class="form-control mb-1" accept=".pdf,.jpg,.png">
                                <div class="text-muted" style="font-size: 0.75rem;">
                                    Archivo actual: <span class="badge bg-light text-dark border"><?php echo $data['doc_dni']; ?></span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small">Expediente Académico:</label>
                                <input type="file" name="u_exp" class="form-control mb-1" accept=".pdf,.jpg,.png">
                                <div class="text-muted" style="font-size: 0.75rem;">
                                    Archivo actual: <span class="badge bg-light text-dark border"><?php echo $data['doc_expediente']; ?></span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small">Libreta de Notas:</label>
                                <input type="file" name="u_notas" class="form-control mb-1" accept=".pdf,.jpg,.png">
                                <div class="text-muted" style="font-size: 0.75rem;">
                                    Archivo actual: <span class="badge bg-light text-dark border"><?php echo $data['doc_notas']; ?></span>
                                </div>
                            </div>

                            <hr class="my-4">
                            <div class="d-flex justify-content-between">
                                <a href="seguimiento.php" class="btn btn-light border px-4 rounded-pill">Volver</a>
                                <button type="submit" class="btn btn-primary px-4 rounded-pill fw-bold">Actualizar y Reenviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>