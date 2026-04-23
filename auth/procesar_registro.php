<?php
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres   = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $dni       = $_POST['dni'];
    $telefono  = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $password  = $_POST['password']; // Recomendado: password_hash($password, PASSWORD_DEFAULT)

    try {
        $pdo->beginTransaction();

        // 1. Calcular ID_Usuario (Inicia en 1000)
        $stmtU = $pdo->query("SELECT MAX(ID_Usuario) AS max_id FROM Usuario");
        $resU = $stmtU->fetch(PDO::FETCH_ASSOC);
        $nextID_Usuario = ($resU['max_id'] < 1000) ? 1000 : $resU['max_id'] + 1;

        // 2. Insertar en tabla Usuario
        $sqlU = "INSERT INTO Usuario (ID_Usuario, Username, Contrasena, Rol, Estado, Nombres, Apellidos) 
                 VALUES (:id, :user, :pass, 'Apoderado', 'Activado', :nom, :ape)";
        $stmtInsertU = $pdo->prepare($sqlU);
        $stmtInsertU->execute([
            'id'   => $nextID_Usuario,
            'user' => $dni,
            'pass' => $password,
            'nom'  => $nombres,
            'ape'  => $apellidos
        ]);

        // 3. Calcular ID_Apoderado (Inicia en 10000)
        $stmtA = $pdo->query("SELECT MAX(ID_Apoderado) AS max_id FROM Apoderado");
        $resA = $stmtA->fetch(PDO::FETCH_ASSOC);
        $nextID_Apoderado = ($resA['max_id'] < 10000) ? 10000 : $resA['max_id'] + 1;

        // 4. Insertar en tabla Apoderado
        $sqlA = "INSERT INTO Apoderado (ID_Apoderado, Telefono, Direccion, ID_Usuario) 
                 VALUES (:idA, :tel, :dir, :idU)";
        $stmtInsertA = $pdo->prepare($sqlA);
        $stmtInsertA->execute([
            'idA' => $nextID_Apoderado,
            'tel' => $telefono,
            'dir' => $direccion,
            'idU' => $nextID_Usuario
        ]);

        $pdo->commit();
        // Redirigir al inicio con éxito
        header("Location: ../index.php");

    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Error en el registro: " . $e->getMessage();
    }
}