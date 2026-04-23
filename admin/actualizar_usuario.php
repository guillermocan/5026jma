<?php
// admin/actualizar_usuario.php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_usuario'];
    $nom = $_POST['nombres'];
    $ape = $_POST['apellidos'];
    $tel = $_POST['telefono'];
    $dir = $_POST['direccion'];
    $est = $_POST['estado'];

    try {
        $pdo->beginTransaction();

        // 1. Actualizar tabla Usuario
        $sqlU = "UPDATE Usuario SET Nombres = ?, Apellidos = ?, Estado = ? WHERE ID_Usuario = ?";
        $stmtU = $pdo->prepare($sqlU);
        $stmtU->execute([$nom, $ape, $est, $id]);

        // 2. Actualizar tabla Apoderado
        $sqlA = "UPDATE Apoderado SET Telefono = ?, Direccion = ? WHERE ID_Usuario = ?";
        $stmtA = $pdo->prepare($sqlA);
        $stmtA->execute([$tel, $dir, $id]);

        $pdo->commit();
        echo "success"; // IMPORTANTE: Esto es lo que lee el JS
    } catch (Exception $e) {
        $pdo->rollBack();
        http_response_code(500); // Esto hace que el .catch del JS funcione
        echo "error: " . $e->getMessage();
    }
}