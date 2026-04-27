<?php
session_start();
require_once '../config/db.php';

// Función para procesar y renombrar archivos (Definida afuera para mayor orden)
function subirArchivo($file, $prefix, $dni, $dir) {
    if (!isset($file) || $file['name'] == "") return null;

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = $prefix . "_" . $dni . "_" . time() . "." . $ext;
    $target_file = $dir . $newName;

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        return $newName;
    }
    return null;
}

// Verificamos que la petición sea POST y que el apoderado esté logueado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['ID_Apoderado'])) {
    
    $id_apoderado = $_SESSION['ID_Apoderado'];
    $dni          = trim($_POST['dni_alumno']);
    $nombres      = trim($_POST['nombres']);
    $apP          = trim($_POST['apellidoP']);
    $apM          = trim($_POST['apellidoM']);
    $fec_nac      = $_POST['fec_nac'];
    $nivel        = $_POST['nivel'];
    $grado        = $_POST['grado'];
    $ano_escolar  = 2026;

    try {
        // 1. Verificar si el DNI ya existe en la tabla Estudiante
        $stmtCheck = $pdo->prepare("SELECT Nombres, ApellidoP, ApellidoM FROM Estudiante WHERE DNI = ?");
        $stmtCheck->execute([$dni]);
        $estudianteExistente = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($estudianteExistente) {
            echo "dni_exists|" . $dni . "|" . $estudianteExistente['Nombres'] . " " . $estudianteExistente['ApellidoP'];
            exit;
        }

        // Crear carpeta de subidas si no existe
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Procesamos los 3 archivos ANTES de la transacción
        $nombreDni = subirArchivo($_FILES['dni_file'], "DNI", $dni, $target_dir);
        $nombreMed = subirArchivo($_FILES['med_file'], "MED", $dni, $target_dir);
        $nombreNota = subirArchivo($_FILES['nota_file'], "NOTA", $dni, $target_dir);

        // Iniciamos transacción
        $pdo->beginTransaction();

        // 2. INSERTAR AL ESTUDIANTE (UNA SOLA VEZ)
        $sqlEst = "INSERT INTO Estudiante (DNI, Nombres, ApellidoP, ApellidoM, Fecha_Nacimiento, Nivel, Grado, doc_dni, doc_expediente, doc_notas, ID_Investigacion) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL)";
        $stmtEst = $pdo->prepare($sqlEst);
        $stmtEst->execute([$dni, $nombres, $apP, $apM, $fec_nac, $nivel, $grado, $nombreDni, $nombreMed, $nombreNota]);
        
        $id_nuevo_estudiante = $pdo->lastInsertId();

        // 3. Obtener un Administrador para asignar la matrícula
        $stmtAdmin = $pdo->query("SELECT ID_Administrador FROM Administrador LIMIT 1");
        $id_admin = $stmtAdmin->fetchColumn();

        if (!$id_admin) {
            throw new Exception("No hay administradores para procesar la matrícula.");
        }

        // 4. INSERTAR EN LA TABLA MATRICULA (ESTO TE FALTABA)
        $sqlMat = "INSERT INTO Matricula (Ano_Escolar, Estado_tramite, Fecha_registro, ID_Apoderado, ID_Estudiante, ID_Administrador) 
                   VALUES (?, 'Enviado', NOW(), ?, ?, ?)";
        $stmtMat = $pdo->prepare($sqlMat);
        $stmtMat->execute([$ano_escolar, $id_apoderado, $id_nuevo_estudiante, $id_admin]);

        // Si todo salió bien, guardamos cambios en ambas tablas
        $pdo->commit();
        echo "success";

    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Acceso denegado o sesión expirada.";
}