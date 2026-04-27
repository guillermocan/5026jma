<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['ID_Usuario']) || $_SESSION['Rol'] !== 'Administrador') {
    header("Location: ../index.php?error=acceso_prohibido");
    exit();
}

$sql = "SELECT m.ID_Matricula, m.Fecha_registro, m.Estado_tramite, m.Observaciones,
               e.Nombres AS Alumno_Nom, e.ApellidoP AS Alumno_Ap, e.DNI AS Alumno_DNI,
               e.doc_dni, e.doc_expediente, e.doc_notas,
               CONCAT(u.Nombres, ' ', u.Apellidos) AS Apoderado_Nom
        FROM Matricula m
        INNER JOIN Estudiante e ON m.ID_Estudiante = e.ID_Estudiante
        INNER JOIN Apoderado a ON m.ID_Apoderado = a.ID_Apoderado
        INNER JOIN Usuario u ON a.ID_Usuario = u.ID_Usuario
        ORDER BY m.Fecha_registro DESC";

$stmt = $pdo->query($sql);
$matriculas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Matrículas - I.E. 5026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <style>
        :root { --azul-corp: #003366; --rojo-corp: #CC0000; --gris-fondo: #f4f7f6; }
        body { background-color: var(--gris-fondo); font-family: 'Segoe UI', sans-serif; }
        .navbar-admin { background-color: var(--azul-corp); border-bottom: 4px solid var(--rojo-corp); }
        .card-table { border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        
        .badge-enviado { background-color: #ffc107; color: #000; }
        .badge-revisado { background-color: #0dcaf0; color: #000; }
        .badge-aprobado { background-color: #198754; }
        .badge-rechazado { background-color: #dc3545; }
        
        .btn-action { transition: transform 0.2s; }
        .btn-action:hover { transform: scale(1.1); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-admin sticky-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="vista_admin.php">
                <i class="bi bi-shield-check me-2"></i>SISTEMA DE MATRÍCULA
            </a>
            <div class="ms-auto d-flex align-items-center">
                <span class="text-white me-3 small d-none d-md-inline"><?php echo $_SESSION['NombreFull']; ?></span>
                <a href="../auth/logout.php" class="btn btn-sm btn-danger text-white fw-bold">SALIR</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-uppercase m-0"><i class="bi bi-file-earmark-text text-primary me-2"></i> Solicitudes Recibidas</h3>
        </div>
        
        <div class="card card-table p-4">
            <table id="tablaMatriculas" class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Fecha</th>
                        <th>Estudiante / DNI</th>
                        <th>Apoderado</th>
                        <th>Documentos</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matriculas as $m): ?>
                    <tr>
                        <td class="small"><?php echo date('d/m/Y', strtotime($m['Fecha_registro'])); ?></td>
                        <td>
                            <span class="fw-bold text-dark"><?php echo $m['Alumno_Ap'] . ", " . $m['Alumno_Nom']; ?></span><br>
                            <small class="text-muted"><i class="bi bi-card-text me-1"></i><?php echo $m['Alumno_DNI']; ?></small>
                        </td>
                        <td class="small text-muted"><?php echo $m['Apoderado_Nom']; ?></td>
                        <td>
                            <div class="btn-group shadow-sm">
                                <a href="../apoderado/uploads/<?php echo $m['doc_dni']; ?>" target="_blank" class="btn btn-sm btn-outline-primary" title="DNI"><i class="bi bi-person-badge"></i></a>
                                <a href="../apoderado/uploads/<?php echo $m['doc_expediente']; ?>" target="_blank" class="btn btn-sm btn-outline-info" title="Expediente"><i class="bi bi-file-earmark-pdf"></i></a>
                                <a href="../apoderado/uploads/<?php echo $m['doc_notas']; ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="Notas"><i class="bi bi-journal-text"></i></a>
                            </div>
                        </td>
                        <td>
                            <span class="badge rounded-pill p-2 px-3 badge-<?php echo strtolower($m['Estado_tramite']); ?>">
                                <?php echo strtoupper($m['Estado_tramite']); ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <?php if ($m['Estado_tramite'] == 'Rechazado'): ?>
                                <span class="text-danger small fw-bold"><i class="bi bi-exclamation-triangle-fill me-1"></i> Observado</span>
                            <?php elseif ($m['Estado_tramite'] == 'Aprobado'): ?>
                                <span class="text-success small fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Finalizado</span>
                            <?php else: ?>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-sm btn-success rounded-pill px-3 me-2 btn-action" 
                                            onclick="abrirModalEstado(<?php echo $m['ID_Matricula']; ?>, 'Aprobado')">
                                        <i class="bi bi-check-lg me-1"></i> Aprobar
                                    </button>
                                    <button class="btn btn-sm btn-danger rounded-pill px-3 btn-action" 
                                            onclick="abrirModalEstado(<?php echo $m['ID_Matricula']; ?>, 'Rechazado')">
                                        <i class="bi bi-x-lg me-1"></i> Rechazar
                                    </button>
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalEstado" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div id="modalHeader" class="modal-header text-white">
                    <h5 class="modal-title fw-bold"><i class="bi bi-arrow-repeat me-2"></i>Actualizar Estado del Trámite</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="input_id">
                    <input type="hidden" id="input_estado">
                    
                    <div class="text-center mb-4">
                        <p class="text-muted m-0">Vas a cambiar el estado de esta matrícula a:</p>
                        <h4 id="text_estado" class="fw-bold text-uppercase mt-1"></h4>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold"><i class="bi bi-chat-left-text me-2"></i>Observaciones / Motivo:</label>
                        <textarea id="input_obs" class="form-control" rows="4" 
                                  placeholder="Escriba aquí los motivos del rechazo o indicaciones adicionales..." 
                                  oninput="validarObservacion()"></textarea>
                        <div id="feedback_rechazo" class="form-text text-danger d-none mt-2">
                            <i class="bi bi-exclamation-circle me-1"></i> Es obligatorio explicar el motivo para rechazar el trámite (mín. 10 caracteres).
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnConfirmar" class="btn btn-primary px-4 fw-bold" onclick="procesarCambio()">Confirmar y Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const miModal = new bootstrap.Modal(document.getElementById('modalEstado'));
        const btnConfirmar = document.getElementById('btnConfirmar');
        const inputObs = document.getElementById('input_obs');
        const feedback = document.getElementById('feedback_rechazo');
        const modalHeader = document.getElementById('modalHeader');

        function abrirModalEstado(id, estado) {
            document.getElementById('input_id').value = id;
            document.getElementById('input_estado').value = estado;
            document.getElementById('text_estado').innerText = estado;
            inputObs.value = "";
            
            // Estilo dinámico según la acción
            if (estado === 'Aprobado') {
                modalHeader.className = "modal-header bg-success text-white";
                document.getElementById('text_estado').className = "fw-bold text-uppercase mt-1 text-success";
            } else {
                modalHeader.className = "modal-header bg-danger text-white";
                document.getElementById('text_estado').className = "fw-bold text-uppercase mt-1 text-danger";
            }
            
            validarObservacion();
            miModal.show();
        }

        function validarObservacion() {
            const estado = document.getElementById('input_estado').value;
            const obsValue = inputObs.value.trim();

            if (estado === 'Rechazado') {
                // Forzamos al menos 10 caracteres para asegurar una explicación clara
                if (obsValue.length < 10) {
                    btnConfirmar.disabled = true;
                    feedback.classList.remove('d-none');
                } else {
                    btnConfirmar.disabled = false;
                    feedback.classList.add('d-none');
                }
            } else {
                btnConfirmar.disabled = false;
                feedback.classList.add('d-none');
            }
        }

        function procesarCambio() {
            const id = document.getElementById('input_id').value;
            const estado = document.getElementById('input_estado').value;
            const obs = inputObs.value;

            btnConfirmar.disabled = true;
            btnConfirmar.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Procesando...';

            const formData = new FormData();
            formData.append('id', id);
            formData.append('estado', estado);
            formData.append('observaciones', obs);

            fetch('actualizar_estado.php', { method: 'POST', body: formData })
            .then(r => r.text())
            .then(res => {
                if(res.trim() === 'ok') {
                    location.reload();
                } else {
                    alert('Error en el servidor: ' + res);
                    btnConfirmar.disabled = false;
                    btnConfirmar.innerText = 'Confirmar y Guardar';
                }
            });
        }

        $(document).ready(function() {
            $('#tablaMatriculas').DataTable({ 
                language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json' },
                order: [[0, 'desc']],
                pageLength: 10
            });
        });
    </script>
</body>
</html>