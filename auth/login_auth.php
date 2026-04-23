<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpiamos espacios en blanco para evitar errores de tipeo
    $user_input = trim($_POST['username']); 
    $pass_input = trim($_POST['password']);

    try {
        // Buscamos al usuario. Filtramos por Username y Estado.
        $stmt = $pdo->prepare("SELECT * FROM Usuario WHERE Username = :user AND Estado = 'Activado' LIMIT 1");
        $stmt->execute(['user' => $user_input]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificamos si existe el usuario y si la contraseña coincide (Texto plano según tu BD actual)
        if ($usuario && $pass_input === $usuario['Contrasena']) {
            
            // Seteamos variables de sesión
            $_SESSION['ID_Usuario'] = $usuario['ID_Usuario'];
            $_SESSION['NombreFull'] = $usuario['Nombres'] . " " . $usuario['Apellidos'];
            $_SESSION['Rol']        = $usuario['Rol'];

            // Obtenemos el rol limpio para comparar
            $rol = $usuario['Rol'];

            // Redirección con validación estricta
            if ($rol === 'Administrador') {
                header("Location: ../admin/vista_admin.php");
                exit();
            } else if ($rol === 'Apoderado') {
                header("Location: ../apoderado/vista_apoderado.php");
                exit();
            } else {
                // Si tiene otro rol no definido, lo enviamos al index
                header("Location: ../index.php?error=rol_no_autorizado");
                exit();
            }

        } else {
            // Si el usuario no existe, está desactivado o la contraseña es incorrecta
            header("Location: ../index.php?error=credenciales_invalidas");
            exit();
        }

    } catch (PDOException $e) {
        // En caso de error de base de datos
        header("Location: ../index.php?error=db_error");
        exit();
    }
} else {
    // Si intentan entrar al archivo sin usar el formulario POST
    header("Location: ../index.php");
    exit();
}