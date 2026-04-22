<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I.E. 5026 José María Arguedas - Portal Institucional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --azul-corp: #003366; 
            --rojo-corp: #CC0000; 
            --gris-fondo: #252525; 
            --negro-footer: #111111;
        }
        
        /* Desplazamiento suave */
         /* Desplazamiento suave
        
        
        */
         /* Desplazamiento suave2
        
        
        */
        /* Desplazamiento suave50
        
        
        */
        html { scroll-behavior: smooth; }
        
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* Navbar */
        .navbar { background-color: var(--azul-corp); padding: 15px 0; }
        .logo-placeholder { width: 50px; height: 50px; background: #ddd; display: inline-block; border-radius: 5px; margin-right: 10px; }
        
        /* Hero */
        .hero-section {
            background: linear-gradient(rgba(0,51,102,0.7), rgba(0,0,0,0.7)), url('assets/img/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            min-height: 500px;
            display: flex;
            align-items: center;
            color: white;
        }

        /* Secciones */
        .section-padding { padding: 80px 0; }
        .bg-dark-section { background-color: var(--negro-footer); color: white; }
        .bg-azul-section { background-color: var(--azul-corp); color: white; }
        
        /* Footer */
        footer { background-color: var(--negro-footer); color: #888; padding: 40px 0; border-top: 4px solid var(--rojo-corp); }
        .dev-info { color: #fff; font-size: 0.9rem; }

        /* Tarjetas de Propuesta */
        .card-pilar {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s;
        }
        .card-pilar:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.2);
        }

        /* Ajuste para las imágenes del Carrusel */
        .carousel-item img {
            height: 350px;
            object-fit: cover;
        }
    </style>
</head>
<body id="top">

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#top">
                <div class="logo-placeholder">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5wh1yqMyIrtbUHApLfrKAR6im571OG_xeuA&s" alt="Logo" style="width:100%; height:100%; object-fit:contain;">
                </div>
                <div>
                    <span class="fw-bold d-block">I.E. 5026</span>
                    <small style="font-size: 0.7rem;">José María Arguedas</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto fw-bold text-uppercase">
                    <li class="nav-item"><a class="nav-link" href="#top">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="../views/hola.php">Matrícula</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fechas">Fechas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#eventos">Eventos</a></li>
                    <li class="nav-item ms-lg-3">
                        <button class="btn btn-outline-light px-4" data-bs-toggle="modal" data-bs-target="#loginModal">INTRANET</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <div class="col-lg-7">
                <h1 class="display-4 fw-bold">Accede a la <span style="color: #ffc107;">Matrícula 2026</span></h1>
                <p class="lead mb-4">Liderazgo, valores y tecnología al servicio de la comunidad del Callao.</p>
                <a href="#matricula" class="btn btn-warning btn-lg fw-bold px-5">MÁS INFORMACIÓN</a>
            </div>
        </div>
    </section>

    <section id="inicio" class="section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="fw-bold mb-4" style="color: var(--azul-corp);">Sobre nuestra Institución</h2>
                    <p class="fs-5 text-muted">Somos una institución emblemática dedicada a la formación integral de niños y jóvenes. Nuestro compromiso es brindar un entorno seguro y moderno para el aprendizaje.</p>
                    <div class="mt-4">
                        <span class="badge bg-primary p-2 px-3">Excelencia</span>
                        <span class="badge bg-danger p-2 px-3">Disciplina</span>
                        <span class="badge bg-dark p-2 px-3">Innovación</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="carouselFachada" class="carousel slide shadow-lg" data-bs-ride="carousel" style="border-radius:15px; overflow:hidden;">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="4000">
                                <img src="assets/img/foto_colegio_1.jpg" class="d-block w-100" alt="Fachada 1">
                            </div>
                            <div class="carousel-item" data-bs-interval="4000">
                                <img src="https://lh3.googleusercontent.com/gps-cs-s/APNQkAF_Goc2H4HRoUniXjKfblCxwMgb4FLvkG6PTlS2IavSHueu_iq1XHJGBuC9WI0KCY1EtsNGJn5jRbn8EAEmabBstp8Ad64js2Qg9Ny70Y2JXfOHFldf3PQ9KQvEeBvgzRi5zMhijg=s680-w680-h510-rw" class="d-block w-100" alt="Fachada 2">
                            </div>
                            <div class="carousel-item" data-bs-interval="4000">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTx4k58KWX97g7nlbKMN8xNrKsvo-0qsYXqww&s" class="d-block w-100" alt="Fachada 3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding bg-dark-section">
        <div class="container text-center">
            <h2 class="fw-bold mb-2">Metodología con impacto real</h2>
            <p class="mb-5">Potenciamos 4 aspectos fundamentales en el crecimiento de nuestros alumnos</p>
            <div class="row g-4 text-start">
                <div class="col-md-3">
                    <div class="p-4 border border-secondary h-100">
                        <h4 class="text-warning">01</h4>
                        <h5>Desarrollo Académico</h5>
                        <small>Enfoque en ciencias, letras y tecnología con estándares nacionales.</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4 border border-secondary h-100">
                        <h4 class="text-warning">02</h4>
                        <h5>Desarrollo Emocional</h5>
                        <small>Acompañamiento psicológico y fomento de la inteligencia emocional.</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4 border border-secondary h-100">
                        <h4 class="text-warning">03</h4>
                        <h5>Desarrollo Social</h5>
                        <small>Promovemos el trabajo en equipo y la responsabilidad ciudadana.</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4 border border-secondary h-100">
                        <h4 class="text-warning">04</h4>
                        <h5>Valores</h5>
                        <small>Integridad, respeto y honestidad en cada acción diaria.</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding bg-azul-section">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold display-6">Nuestra Propuesta Educativa</h2>
                    <div style="width: 80px; height: 5px; background: var(--rojo-corp); margin-top: 15px;"></div>
                </div>
                <div class="col-lg-6">
                    <p class="lead opacity-75">En la I.E. 5026 nos enfocamos en una formación que trasciende las aulas, preparando a los estudiantes para los retos del futuro.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 card-pilar h-100 shadow-sm rounded">
                        <div class="mb-3">
                            <div style="width: 45px; height: 45px; background: var(--rojo-corp); border-radius: 50%; display: flex; align-items: center; justify-content: center;" class="fw-bold">P</div>
                        </div>
                        <h4 class="fw-bold">Primaria</h4>
                        <p class="small opacity-75">Desarrollamos habilidades fundamentales en lectura, razonamiento lógico y convivencia.</p>
                        <hr class="border-secondary">
                        <ul class="list-unstyled small">
                            <li>• Talleres de Mini-robótica</li>
                            <li>• Plan Lector dinámico</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 card-pilar h-100 shadow-sm rounded">
                        <div class="mb-3">
                            <div style="width: 45px; height: 45px; background: var(--rojo-corp); border-radius: 50%; display: flex; align-items: center; justify-content: center;" class="fw-bold">S</div>
                        </div>
                        <h4 class="fw-bold">Secundaria</h4>
                        <p class="small opacity-75">Fomentamos el pensamiento crítico y la orientación vocacional para la universidad.</p>
                        <hr class="border-secondary">
                        <ul class="list-unstyled small">
                            <li>• Laboratorios de Ciencias</li>
                            <li>• Preparación Pre-U</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 card-pilar h-100 shadow-sm rounded">
                        <div class="mb-3">
                            <div style="width: 45px; height: 45px; background: var(--rojo-corp); border-radius: 50%; display: flex; align-items: center; justify-content: center;" class="fw-bold">T</div>
                        </div>
                        <h4 class="fw-bold">Tecnología</h4>
                        <p class="small opacity-75">Integramos herramientas digitales modernas en el aprendizaje diario.</p>
                        <hr class="border-secondary">
                        <ul class="list-unstyled small">
                            <li>• Aula de Innovación</li>
                            <li>• Matrícula 100% Digital</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container text-center text-md-start">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h5 class="text-white fw-bold mb-3 uppercase">I.E. 5026 J.M. Arguedas</h5>
                    <p class="small">Av. Principal s/n, Callao, Perú.<br>Teléfono: (01) 456-7890</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="dev-info p-3 border border-secondary d-inline-block text-start">
                        <p class="mb-1 fw-bold text-warning small">SOFTWARE DESARROLLADO POR:</p>
                        <p class="mb-0 fs-6 text-white">[Nombre de tu Empresa]</p>
                        <p class="small mb-0">Contacto: desarrolladores@u-unac.edu.pe</p>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <p class="text-center small mb-0">&copy; 2026 Todos los derechos reservados.</p>
        </div>
    </footer>

    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header bg-dark text-white border-0">
                    <h5 class="modal-title fw-bold">ACCESO INTRANET</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="auth/login_auth.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold small">DNI USUARIO</label>
                            <input type="text" name="username" class="form-control form-control-lg" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">CONTRASEÑA</label>
                            <input type="password" name="password" class="form-control form-control-lg" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold py-3 mt-2">INGRESAR AL SISTEMA</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
