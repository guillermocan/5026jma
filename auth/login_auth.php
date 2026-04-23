<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // En tu formulario el input se llama 'username' y 'password'
    $user_input = $_POST['username']; 
    $pass_input = $_POST['password'];

    // Buscamos en tu tabla 'Usuario'
    $stmt = $pdo->prepare("SELECT * FROM Usuario WHERE Username = :user AND Estado = 'Activo'");
    $stmt->execute(['user' => $user_input]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si existe el usuario y la contraseña coincide
    // NOTA: Si tus contraseñas en la BD no están encriptadas con password_hash, 
    // cambia 'password_verify($pass_input, $usuario['Contrasena'])' por '$pass_input == $usuario['Contrasena']'
    if ($usuario && password_verify($pass_input, $usuario['Contrasena'])) {
        
        $_SESSION['ID_Usuario'] = $usuario['ID_Usuario'];
        $_SESSION['NombreFull'] = $usuario['Nombres'] . " " . $usuario['Apellidos'];
        $_SESSION['Rol']        = $usuario['Rol'];

        // Redirección según tu columna 'Rol'
        if ($usuario['Rol'] == 'Administrador') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../portal/inicio.php");
        }
        exit();
    } else {
        header("Location: ../index.php?error=credenciales_invalidas");
        exit();
    }
}