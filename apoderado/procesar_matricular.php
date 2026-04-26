<?php
session_start();
require_once '../config/db.php';

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
            // Si ya existe, enviamos una señal al JS con los datos del niño
            echo "dni_exists|" . $dni . "|" . $estudianteExistente['Nombres'] . " " . $estudianteExistente['ApellidoP'] . " " . $estudianteExistente['ApellidoM'];
            exit;
        }

        // Iniciamos transacción para asegurar que se guarden ambas tablas o ninguna
        $pdo->beginTransaction();

        // 2. Insertar al Estudiante
        // Nota: ID_Estudiante es AUTO_INCREMENT (empezará en 30000 si hiciste el ALTER TABLE)
        $sqlEst = "INSERT INTO Estudiante (DNI, Nombres, ApellidoP, ApellidoM, Fecha_Nacimiento, Nivel, Grado, ID_Investigacion) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, NULL)";
        $stmtEst = $pdo->prepare($sqlEst);
        $stmtEst->execute([$dni, $nombres, $apP, $apM, $fec_nac, $nivel, $grado]);
        
        $id_nuevo_estudiante = $pdo->lastInsertId();

        // 3. Obtener el ID del primer Administrador disponible para asignar el trámite
        $stmtAdmin = $pdo->query("SELECT ID_Administrador FROM Administrador LIMIT 1");
        $id_admin = $stmtAdmin->fetchColumn();

        if (!$id_admin) {
            throw new Exception("No hay administradores registrados en el sistema.");
        }

        // 4. Insertar la Matrícula (Estado: Enviado)
        $sqlMat = "INSERT INTO Matricula (Ano_Escolar, Estado_tramite, Fecha_registro, ID_Administrador, ID_Apoderado, ID_Estudiante) 
                   VALUES (?, 'Enviado', NOW(), ?, ?, ?)";
        $stmtMat = $pdo->prepare($sqlMat);
        $stmtMat->execute([$ano_escolar, $id_admin, $id_apoderado, $id_nuevo_estudiante]);

        // Si todo salió bien, guardamos cambios
        $pdo->commit();
        echo "success";

    } catch (Exception $e) {
        // Si algo falló, deshacemos todo lo anterior
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Acceso denegado o sesión expirada.";
}