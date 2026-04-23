<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2858/2858416.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechas de Matrícula - I.E. 5026 José María Arguedas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --azul-corp: #003366;
            --rojo-corp: #CC0000;
            --negro-footer: #111111;
            --gris-oscuro: #1a1a1a;
        }
        
        body { 
            background-color: var(--gris-oscuro); 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: white; 
        }

        /* Navbar */
        .navbar { background-color: var(--azul-corp); padding: 15px 0; }
        .logo-placeholder { width: 50px; height: 50px; background: #ddd; display: inline-block; border-radius: 5px; margin-right: 10px; }

        /* Estilos de la Tabla */
        .card-fechas {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            border: none;
        }

        .table thead {
            background-color: var(--azul-corp);
            color: white;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 51, 102, 0.05);
        }

        .badge-proceso {
            background-color: var(--rojo-corp);
            font-weight: bold;
            padding: 8px 12px;
            letter-spacing: 1px;
        }

        /* Footer */
        footer { background-color: var(--negro-footer); color: #888; padding: 50px 0; border-top: 4px solid var(--rojo-corp); }
        .dev-info { color: #fff; font-size: 0.85rem; border: 1px solid #333; padding: 15px; border-radius: 8px; }
    </style>
</head>
<body id="top">

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="../index.php">
                <div class="logo-placeholder">
                    <img src="../assets/img/logo_ie.png" alt="Logo" style="width:100%; height:100%; object-fit:contain;">
                </div>
                <div>
                    <span class="fw-bold d-block text-uppercase">I.E. 5026</span>
                    <small style="font-size: 0.7rem;">José María Arguedas</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto fw-bold text-uppercase">
                    <li class="nav-item"><a class="nav-link" href="../index.php#top">INICIO</a></li>
                    <li class="nav-item"><a class="nav-link" href="matricula.php">MATRÍCULA</a></li>
                    <li class="nav-item"><a class="nav-link active" href="fechas.php">FECHAS</a></li>
                    <li class="nav-item"><a class="nav-link" href="eventos.php">EVENTOS</a></li>
                    <li class="nav-item ms-lg-3">
                        <button class="btn btn-outline-light px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal">INTRANET</button>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="registro_apoderado.php" class="btn btn-danger px-3 fw-bold shadow-sm">
                            <i class="bi bi-person-plus-fill"></i> REGISTRARSE
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold display-5 text-uppercase">Cronograma de Matrícula 2026</h1>
            <div style="width: 100px; height: 4px; background: var(--rojo-corp); margin: 15px auto;"></div>
            <p class="text-secondary lead">Organización por fechas para la correcta gestión de vacantes.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card-fechas shadow-lg">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="p-4">Etapa del Proceso</th>
                                    <th class="p-4 text-center">Fecha Única</th>
                                    <th class="p-4">Observación</th>
                                    <th class="p-4 text-center">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark">
                                <tr>
                                    <td class="p-4 fw-bold">Ratificación de Matrícula (Alumnos Antiguos)</td>
                                    <td class="text-center text-primary fw-bold">12 de Enero</td>
                                    <td class="small">Prioridad exclusiva para asegurar la continuidad de nuestros estudiantes.</td>
                                    <td class="text-center"><span class="badge badge-proceso text-uppercase">En Proceso</span></td>
                                </tr>
                                <tr class="bg-light">
                                    <td class="p-4 fw-bold text-muted">Procesamiento Administrativo (Interno)</td>
                                    <td class="text-center text-muted fw-bold">13 de Enero</td>
                                    <td class="small text-muted italic">Carga de datos al sistema SIAGIE. <strong>No hay atención al público.</strong></td>
                                    <td class="text-center"><span class="badge badge-proceso text-uppercase">En Proceso</span></td>
                                </tr>
                                <tr>
                                    <td class="p-4 fw-bold">Registro de Estudiantes (Alumnos Nuevos)</td>
                                    <td class="text-center text-primary fw-bold">14 de Enero</td>
                                    <td class="small">Ingreso de expedientes según disponibilidad de vacantes liberadas.</td>
                                    <td class="text-center"><span class="badge badge-proceso text-uppercase">En Proceso</span></td>
                                </tr>
                                <tr class="bg-light">
                                    <td class="p-4 fw-bold text-muted">Procesamiento Administrativo (Interno)</td>
                                    <td class="text-center text-muted fw-bold">13 de Enero</td>
                                    <td class="small text-muted italic">Carga de datos al sistema SIAGIE. <strong>No hay atención al público.</strong></td>
                                    <td class="text-center"><span class="badge badge-proceso text-uppercase">En Proceso</span></td>
                                </tr>
                                <tr>
                                    <td class="p-4 fw-bold">Regularización y Traslados</td>
                                    <td class="text-center fw-bold text-dark">16 de Enero</td>
                                    <td class="small">Atención para estudiantes de otras regiones o situaciones especiales.</td>
                                    <td class="text-center"><span class="badge badge-proceso text-uppercase">En Proceso</span></td>
                                </tr>
                                <tr>
                                    <td class="p-4 fw-bold">Inicio de Año Escolar 2026</td>
                                    <td class="text-center fw-bold text-dark">09 de Marzo</td>
                                    <td class="small">Ceremonia de inauguración y bienvenida a la familia arguediana.</td>
                                    <td class="text-center"><span class="badge badge-proceso text-uppercase">En Proceso</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="mt-4 p-4 border-start border-4 border-danger bg-white text-dark rounded shadow-sm">
                    <h6 class="fw-bold text-danger text-uppercase"><i class="bi bi-exclamation-triangle-fill"></i> Aviso Importante:</h6>
                    <p class="small mb-0">La ratificación de alumnos antiguos garantiza su vacante. Si el padre de familia no se presenta el día 12 de enero, la vacante se considerará **disponible** para el proceso de alumnos nuevos del día 14.</p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <h5 class="text-white fw-bold mb-3 text-uppercase">I.E. 5026 José María Arguedas</h5>
                    <p class="small mb-0">Av. Principal s/n, Callao, Perú.</p>
                    <p class="small mb-0">Teléfono: (01) 456-7890</p>
                    <p class="small">Email: contacto@ie5026.edu.pe</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="dev-info d-inline-block text-start shadow-sm">
                        <p class="mb-1 fw-bold text-warning small text-uppercase">Software desarrollado por:</p>
                        <p class="mb-0 fs-6 text-white">[Tu Nombre / Grupo de Estudio]</p>
                        <p class="small mb-0 text-secondary">FIIS - Universidad Nacional del Callao</p>
                        <p class="small mb-0 text-secondary">Versión 1.0 - 2026</p>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-secondary opacity-25">
            <div class="text-center small text-secondary text-uppercase">
                &copy; 2026 Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-dark text-white border-0">
                    <h5 class="modal-title fw-bold text-uppercase">Acceso Intranet</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="../auth/login_auth.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-dark">DNI USUARIO</label>
                            <input type="text" name="username" class="form-control form-control-lg" placeholder="Ingrese su DNI" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-dark">CONTRASEÑA</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="********" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold py-3 mt-2 text-uppercase shadow-sm">Ingresar al Sistema</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>