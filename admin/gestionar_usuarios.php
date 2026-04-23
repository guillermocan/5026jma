<?php
session_start();
require_once '../config/db.php';

// SEGURIDAD: Solo Administradores
if (!isset($_SESSION['ID_Usuario']) || $_SESSION['Rol'] !== 'Administrador') {
    header("Location: ../index.php?error=acceso_prohibido");
    exit();
}

// CONSULTA DE APODERADOS (Relacionando Usuario y Apoderado)
try {
    $sql = "SELECT u.ID_Usuario, u.Username, u.Nombres, u.Apellidos, u.Estado, 
                   a.Telefono, a.Direccion 
            FROM Usuario u
            INNER JOIN Apoderado a ON u.ID_Usuario = a.ID_Usuario
            WHERE u.Rol = 'Apoderado'";
    $stmt = $pdo->query($sql);
    $apoderados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Usuarios - I.E. 5026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --azul-corp: #003366;
            --rojo-corp: #CC0000;
            --gris-fondo: #f4f7f6;
        }
        
        html, body { height: 100%; }
        body { 
            display: flex; 
            flex-direction: column; 
            background-color: var(--gris-fondo); 
            font-family: 'Segoe UI', sans-serif; 
        }

        .main-content { flex: 1 0 auto; }
        .navbar-admin { background-color: var(--azul-corp); border-bottom: 4px solid var(--rojo-corp); }
        
        /* Pestaña desactivada */
        .nav-link.disabled-custom { color: #aaa !important; cursor: not-allowed; pointer-events: none; }

        .user-avatar {
            width: 35px; height: 35px;
            background-color: #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--azul-corp);
        }

        .table-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        footer { 
            flex-shrink: 0;
            background-color: #111; 
            color: #888; 
            padding: 25px 0; 
            border-top: 3px solid var(--rojo-corp);
        }
        .dev-tag { border: 1px solid #333; padding: 8px 15px; border-radius: 8px; display: inline-block; }
    </style>
</head>
<body>

    <div class="main-content">
        <nav class="navbar navbar-expand-lg navbar-dark navbar-admin sticky-top shadow">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="vista_admin.php">
                    <div class="bg-light p-1 rounded me-2" style="width: 35px; height: 35px;">
                        <img src="../assets/img/logo_ie.png" alt="Logo" style="width:100%; height:100%; object-fit:contain;">
                    </div>
                    <span class="fw-bold text-uppercase">Panel Admin</span>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navAdmin">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navAdmin">
                    <ul class="navbar-nav me-auto fw-bold text-uppercase">
                        <li class="nav-item"><a class="nav-link" href="vista_admin.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="gestionar_matriculas.php">Gestionar Matrículas</a></li>
                        <li class="nav-item"><a class="nav-link disabled-custom" href="#">Gestionar Usuarios</a></li>
                        <li class="nav-item"><a class="nav-link" href="dashboards.php">Dashboards</a></li>
                    </ul>

                    <div class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="text-white me-2 d-none d-lg-inline small fw-bold"><?php echo $_SESSION['NombreFull']; ?></span>
                            <div class="user-avatar border shadow-sm">
                                <i class="bi bi-person-fill"></i>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item py-2 text-danger fw-bold" href="../auth/logout.php"><i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-dark"><i class="bi bi-people-fill text-primary me-2"></i> Lista de Apoderados</h3>
                <button class="btn btn-primary fw-bold shadow-sm"><i class="bi bi-person-plus-fill me-2"></i>Nuevo Apoderado</button>
            </div>

            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>DNI (User)</th>
                                <th>Nombres y Apellidos</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($apoderados as $apo): ?>
                            <tr>
                                <td class="fw-bold text-primary"><?php echo $apo['Username']; ?></td>
                                <td><?php echo $apo['Nombres'] . " " . $apo['Apellidos']; ?></td>
                                <td><?php echo $apo['Telefono']; ?></td>
                                <td class="small text-muted"><?php echo $apo['Direccion']; ?></td>
                                <td>
                                    <?php if($apo['Estado'] == 'Activado'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success">Activado</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger">Inactivo</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-outline-dark btn-sm me-1 btn-editar" 
                                            data-id="<?php echo $apo['ID_Usuario']; ?>"
                                            data-nombres="<?php echo $apo['Nombres']; ?>"
                                            data-apellidos="<?php echo $apo['Apellidos']; ?>"
                                            data-telefono="<?php echo $apo['Telefono']; ?>"
                                            data-direccion="<?php echo $apo['Direccion']; ?>"
                                            data-estado="<?php echo $apo['Estado']; ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" title="Suspender">
                                        <i class="bi bi-slash-circle"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditarUsuario" class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">Editar Datos de Apoderado</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_usuario" id="edit_id">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nombres</label>
                    <input type="text" name="nombres" id="edit_nombres" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Apellidos</label>
                    <input type="text" name="apellidos" id="edit_apellidos" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold">Teléfono</label>
                        <input type="text" name="telefono" id="edit_telefono" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold">Estado</label>
                        <select name="estado" id="edit_estado" class="form-select">
                            <option value="Activado">Activado</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Dirección</label>
                    <textarea name="direccion" id="edit_direccion" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success fw-bold">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

    <footer>
        <div class="container text-center">
            <p class="mb-2 text-white">© 2026 I.E. 5026 José María Arguedas - Callao, Perú</p>
            <div class="dev-tag bg-dark text-secondary">
                <small>Software de Gestión Académica | <strong>FIIS - UNAC</strong></small>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEditar = new bootstrap.Modal(document.getElementById('modalEditar'));
    
        // 1. Al hacer clic en el botón editar
        document.querySelectorAll('.btn-editar').forEach(btn => {
            btn.addEventListener('click', function() {
                // Pasamos los datos del botón al modal
                document.getElementById('edit_id').value = this.dataset.id;
                document.getElementById('edit_nombres').value = this.dataset.nombres;
                document.getElementById('edit_apellidos').value = this.dataset.apellidos;
                document.getElementById('edit_telefono').value = this.dataset.telefono;
                document.getElementById('edit_direccion').value = this.dataset.direccion;
                document.getElementById('edit_estado').value = this.dataset.estado;
            
                modalEditar.show();
            });
        });

        // 2. Al enviar el formulario (AJAX)
        document.getElementById('formEditarUsuario').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('actualizar_usuario.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert('¡Usuario actualizado correctamente!');
                location.reload(); // Recargamos para ver los cambios en la tabla
            })
            .catch(error => console.error('Error:', error));
        });
    });
    </script>
</body>
</html>