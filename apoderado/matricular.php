<?php
session_start();
require_once '../config/db.php';

// SEGURIDAD: Solo Apoderados
if (!isset($_SESSION['ID_Usuario']) || $_SESSION['Rol'] !== 'Apoderado') {
    header("Location: ../index.php?error=acceso_prohibido");
    exit();
}

$id_apoderado = $_SESSION['ID_Apoderado'];
$nombreUsuario = $_SESSION['NombreFull'] ?? "Usuario";
$inicial = strtoupper(substr($nombreUsuario, 0, 1));

// LÓGICA: Verificar si ya tiene un hijo matriculado o en proceso
$stmtHijos = $pdo->prepare("SELECT COUNT(*) FROM Matricula WHERE ID_Apoderado = ?");
$stmtHijos->execute([$id_apoderado]);
$tieneMatriculas = $stmtHijos->fetchColumn() > 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matricular Estudiante - I.E. 5026</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        :root { --azul: #003366; --rojo: #CC0000; --amarillo: #ffc107; }
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .navbar { background-color: var(--azul); border-bottom: 3px solid var(--amarillo); }
        .form-card { background: white; border-radius: 20px; padding: 35px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .profile-circle { width: 40px; height: 40px; background: var(--amarillo); color: var(--azul); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; }
        .modal-header-custom { background: var(--azul); color: white; border-radius: 15px 15px 0 0; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="vista_apoderado.php">
                <i class="fa-solid fa-school me-2"></i> I.E. 5026 ARGUEDAS
            </a>
            <div class="ms-auto d-flex align-items-center">
                <div class="profile-circle"><?php echo $inicial; ?></div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="form-card animate__animated animate__fadeInUp">
                    <h2 class="text-center fw-bold text-primary mb-4">Ficha de Matrícula 2026</h2>
                    <hr>
                    
                    <form id="formMatricula" enctype="multipart/form-data">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">DNI del Estudiante</label>
                                <input type="text" name="dni_alumno" id="dni_alumno" class="form-control" maxlength="8" pattern="\d{8}" required placeholder="8 dígitos">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-bold">Nombres</label>
                                <input type="text" name="nombres" id="nombres" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Apellido Paterno</label>
                                <input type="text" name="apellidoP" id="apellidoP" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Apellido Materno</label>
                                <input type="text" name="apellidoM" id="apellidoM" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Fecha de Nacimiento</label>
                                <input type="date" name="fec_nac" id="fec_nac" class="form-control" required>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Nivel</label>
                                <select name="nivel" id="nivel" class="form-select" required>
                                    <option value="" selected disabled>Seleccione...</option>
                                    <option value="Primaria">Primaria</option>
                                    <option value="Secundaria">Secundaria</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Grado</label>
                                <select name="grado" id="grado" class="form-select" required>
                                    <option value="" selected disabled>Seleccione...</option>
                                    <option value="1">1° Grado</option>
                                    <option value="2">2° Grado</option>
                                    <option value="3">3° Grado</option>
                                    <option value="4">4° Grado</option>
                                    <option value="5">5° Grado</option>
                                    <option value="6">6° Grado</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mt-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Copia de DNI (PDF/JPG)</label>
                                <input type="file" name="dni_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Expediente Médico</label>
                                <input type="file" name="med_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Acta de Notas 2025</label>
                                <input type="file" name="nota_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button type="button" onclick="mostrarResumen()" class="btn btn-primary btn-lg px-5 shadow">
                                <i class="fa-solid fa-check-double me-2"></i> REGISTRAR MATRÍCULA
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAvisoInicial" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <i class="fa-solid fa-circle-info text-primary display-4 mb-3"></i>
                    <h4 class="fw-bold">Aviso del Sistema</h4>
                    <p class="text-muted">Ya tiene un hijo matriculado o su solicitud está en proceso.</p>
                    <div class="mt-4">
                        <a href="vista_apoderado.php" class="btn btn-outline-secondary px-4">Volver</a>
                        <button class="btn btn-primary px-4 ms-2" data-bs-dismiss="modal">Continuar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalResumen" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title fw-bold">Resumen de Matrícula</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="resumenDetalle">
                    </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver y Editar</button>
                    <button type="button" onclick="enviarFormulario()" class="btn btn-success px-4">Confirmar y Enviar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // 1. Mostrar aviso inicial si ya tiene historial
        <?php if($tieneMatriculas): ?>
        window.addEventListener('DOMContentLoaded', () => {
            new bootstrap.Modal(document.getElementById('modalAvisoInicial')).show();
        });
        <?php endif; ?>

        // 2. Función para mostrar el resumen (Modal 2)
        function mostrarResumen() {
            const form = document.getElementById('formMatricula');
            if(!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const html = `
                <div class="p-2">
                    <p><strong>DNI:</strong> ${document.getElementById('dni_alumno').value}</p>
                    <p><strong>Estudiante:</strong> ${document.getElementById('nombres').value} ${document.getElementById('apellidoP').value} ${document.getElementById('apellidoM').value}</p>
                    <p><strong>F. Nacimiento:</strong> ${document.getElementById('fec_nac').value}</p>
                    <p><strong>Nivel:</strong> ${document.getElementById('nivel').value}</p>
                    <p><strong>Grado:</strong> ${document.getElementById('grado').value}°</p>
                    <hr>
                    <p class="text-danger small fw-bold text-center">¿Desea enviar esta solicitud para revisión?</p>
                </div>
            `;
            document.getElementById('resumenDetalle').innerHTML = html;
            new bootstrap.Modal(document.getElementById('modalResumen')).show();
        }

        // 3. Envío final al procesador
        function enviarFormulario() {
            const btn = event.target; // Captura el botón que hizo clic
            btn.disabled = true;      // Bloquea el botón para evitar doble clic
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Enviando...';

            const formData = new FormData(document.getElementById('formMatricula'));
    
            fetch('procesar_matricular.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(data => {
                const response = data.trim();
        
                if(response === 'success') {
                    alert('¡Matrícula realizada con éxito!');
                    window.location.href = 'vista_apoderado.php';
                } else if(response.startsWith('dni_exists')) {
                    const parts = response.split('|');
                    alert(`Aviso: El DNI ${parts[1]} ya está registrado a nombre de ${parts[2]}.`);
                    btn.disabled = false;
                    btn.innerText = 'Confirmar y Enviar';
                } else {
                    alert('Error: ' + response);
                    btn.disabled = false;
                    btn.innerText = 'Confirmar y Enviar';
                    console.log("Detalle del error:", response); // Para que veas el error real en consola
                }
            })
            .catch(err => {
                alert('Error de conexión.');
                btn.disabled = false;
                btn.innerText = 'Confirmar y Enviar';
            });
        }
    </script>
</body>
</html>