<?php
require_once '../config/db.php';

if (isset($_POST['id']) && isset($_POST['estado'])) {
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    $obs = $_POST['observaciones'] ?? '';

    // Actualizamos tanto el estado como la observación
    $sql = "UPDATE Matricula SET Estado_tramite = ?, Observaciones = ? WHERE ID_Matricula = ?";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$estado, $obs, $id])) {
        echo "ok";
    } else {
        echo "error";
    }
}