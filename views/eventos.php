<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" href="https://images.emojiterra.com/google/android-nougat/512px/2b50.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos - I.E. 5026 José María Arguedas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .navbar { background-color: var(--azul-corp); padding: 15px 0; }
        .logo-placeholder { width: 50px; height: 50px; background: #ddd; display: inline-block; border-radius: 5px; margin-right: 10px; }

        .event-card {
            height: 280px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s ease;
            border-radius: 12px;
        }

        .event-bg {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-size: cover;
            background-position: center;
            filter: brightness(0.5);
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        .event-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-color: var(--azul-corp);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 2;
        }

        .event-title {
            position: relative;
            z-index: 3;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            font-size: 1.3rem;
            letter-spacing: 1px;
            padding: 0 15px;
        }

        .event-card:hover .event-bg { opacity: 0; }
        .event-card:hover .event-overlay { opacity: 1; }
        .event-card:hover { transform: translateY(-8px); }

        .modal-content { background-color: #ffffff; color: #333; border: none; border-radius: 15px; overflow: hidden; }
        .modal-carousel-img { height: 400px; object-fit: cover; }
        
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
                    <li class="nav-item"><a class="nav-link" href="fechas.php">FECHAS</a></li>
                    <li class="nav-item"><a class="nav-link active" href="eventos.php">EVENTOS</a></li>
                    <li class="nav-item ms-lg-3">
                        <button class="btn btn-outline-light px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal">INTRANET</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold display-5 text-uppercase">Calendario de Eventos</h1>
            <div style="width: 100px; height: 4px; background: var(--rojo-corp); margin: 15px auto;"></div>
            <p class="text-secondary lead">Nuestras actividades integrales para la comunidad educativa.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="event-card shadow" data-bs-toggle="modal" data-bs-target="#modalLunes">
                    <div class="event-bg" style="background-image: url('https://scontent.flim38-1.fna.fbcdn.net/v/t39.30808-6/678388836_1558309966302049_7044037360855805922_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=7b2446&_nc_eui2=AeEgwx6wdcRB4fJ0d6I2f4mhc3mAIIWVjIdzeYAghZWMh2gS2yIHGBkrggF6iNNjAX85S6oNyZcZ6zhicTJI-93U&_nc_ohc=GQQSoOcET9IQ7kNvwFAynbF&_nc_oc=AdplfLToIoQFWYKhedQP6nIuGKfWDiAkdhset9SUz2eLf9j1Frg141Q8gk-9aG5rPLE&_nc_zt=23&_nc_ht=scontent.flim38-1.fna&_nc_gid=s_UkTHa4Ux5zthdQfmpmKw&_nc_ss=7b2a8&oh=00_Af0zBWBVwAkNiFFfx1D6fr6XOfK-dGKG7U2tubmpXRD-0w&oe=69EF12DD');"></div>
                    <div class="event-overlay"></div>
                    <h4 class="event-title">Lunes Cívico</h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="event-card shadow" data-bs-toggle="modal" data-bs-target="#modalCapacitacion">
                    <div class="event-bg" style="background-image: url('https://scontent.flim38-1.fna.fbcdn.net/v/t39.30808-6/675434261_1556793279787051_1717894807549725560_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeHjp1xLqRM_RBC2mnFCM2UpatVBw5S_qhZq1UHDlL-qFpG0JucW1yYWn31l5Rbow1JxPOOm1G9-hsMnTEqn0kIX&_nc_ohc=adDUZkt5V40Q7kNvwHJlhHZ&_nc_oc=Adqjdm8KvwyQiyBUKzUz7Yb-t4nnCMTo3GFXKBdCeJiZQn0Qhn9FeiZRAaTzmwEMCpU&_nc_zt=23&_nc_ht=scontent.flim38-1.fna&_nc_gid=T7AdvCa1hjfrvOf1FFLVqQ&_nc_ss=7b2a8&oh=00_Af2uwkAdxfwyspYcAZam8KeE650HUYoSb6IpvIiwkksqpA&oe=69EEF97F');"></div>
                    <div class="event-overlay"></div>
                    <h4 class="event-title">Capacitaciones</h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="event-card shadow" data-bs-toggle="modal" data-bs-target="#modalLogro">
                    <div class="event-bg" style="background-image: url('https://scontent.flim28-2.fna.fbcdn.net/v/t39.30808-6/675240763_1556792709787108_7678179951427788620_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeFJBOAD2lHqXYb4KiXU0gaaxDojMBXkD73EOiMwFeQPvdAuClyY5Nr68Yh9xjmUndpJKwVUgIit2n2lxLMmyfJL&_nc_ohc=jeOCCMg5MOYQ7kNvwG7Rxuc&_nc_oc=Adqs-FxGsNO-Gs8LjibuJ1374ynQg-xHNJrbGsI74DL5Goffapv_kYdBQeQ8oRIYh7k&_nc_zt=23&_nc_ht=scontent.flim28-2.fna&_nc_gid=irUuvst47eEcxrM2t2ge3A&_nc_ss=7a2a8&oh=00_Af00bk5ZFjOOxaZWz1LyoK0esVUfiemCz3ZXYaanVxUI_g&oe=69EF2352');"></div>
                    <div class="event-overlay"></div>
                    <h4 class="event-title">Día del Logro</h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="event-card shadow" data-bs-toggle="modal" data-bs-target="#modalAniversario">
                    <div class="event-bg" style="background-image: url('https://scontent.flim38-1.fna.fbcdn.net/v/t39.30808-6/545183424_1359802926152755_8783392327017036731_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeHJ0KsExJrudRx8pqMJgm2nlth-IqSZpZqW2H4ipJmlmmW8R37yGQtKPzo3hsE_2OTjs32MgmxHBPOn2AkRdvdH&_nc_ohc=GZRl9eZ20NgQ7kNvwGkTUqj&_nc_oc=AdrMhaNlg-NHXhWtXWW8NyoLtPPj8_VfO0yRNJn_cB0qJPg8R04xbbRRWq7gteUGZhI&_nc_zt=23&_nc_ht=scontent.flim38-1.fna&_nc_gid=FRRSs2262o9jiN8lQoAXmg&_nc_ss=7b2a8&oh=00_Af1c0FtS4e8gQ-xOUeoaI2TkzeuTP_P4I2Puva3ytnmp8A&oe=69EF0F3B');"></div>
                    <div class="event-overlay"></div>
                    <h4 class="event-title">Aniversario</h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="event-card shadow" data-bs-toggle="modal" data-bs-target="#modalNavidad">
                    <div class="event-bg" style="background-image: url('https://scontent.flim33-1.fna.fbcdn.net/v/t39.30808-6/603762906_1453738700092510_8796688162664105910_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeGa5iD4vsGQUvoPhTZlX9ChD78iU7y5yW0PvyJTvLnJbcT8zreLvqVOMRfdYt_aXTqCo5mnUZmoPqzT0897aZ0z&_nc_ohc=_kxlhZ4XyTUQ7kNvwGv-Lfr&_nc_oc=AdoZZlBaVabSGSNoXc4p2YHDfq84Kr3OO_HFtfhKd5CDaKpMCOr5Gvv3U7OSNTXN8WA&_nc_zt=23&_nc_ht=scontent.flim33-1.fna&_nc_gid=BKCmspPlokAwGBCnYs8BpA&_nc_ss=7b2a8&oh=00_Af3TYjtQJ8Jbhn_EgcjW_T78ao3b_0TRgqdHhmzSHMfZsw&oe=69EF0726');"></div>
                    <div class="event-overlay"></div>
                    <h4 class="event-title">Navidad</h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="event-card shadow" data-bs-toggle="modal" data-bs-target="#modalOtros">
                    <div class="event-bg" style="background-image: url('https://scontent.flim33-1.fna.fbcdn.net/v/t39.30808-6/661710898_1542186504581062_8936289313071606448_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=7b2446&_nc_eui2=AeE4urTRrUQIeX9LyX-kC7e6nHK-QC5s1Cyccr5ALmzULCTD8uYtjx268cJKIxbeXaGWlIX0cBLVY5UhApFuJNlm&_nc_ohc=Wbn-wccoNMgQ7kNvwHnhLY6&_nc_oc=Adrye_D3ygkiq-4TStii3hxVCCpTF_CIintFmMyK8o71zaluqVW0_HY43j5LdBJTEEg&_nc_zt=23&_nc_ht=scontent.flim33-1.fna&_nc_gid=kWgbpEvKeaN10R6U3cbzSw&_nc_ss=7b3a8&oh=00_Af2EoLgA3yHpQNAHJ5RW98FItgbi0cG33NHNff4EAY3zGw&oe=69EF01BE');"></div>
                    <div class="event-overlay" style="background-color: var(--rojo-corp);"></div>
                    <h4 class="event-title">Otros</h4>
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
                    <div class="dev-info d-inline-block text-start">
                        <p class="mb-1 fw-bold text-warning small text-uppercase">Software desarrollado por:</p>
                        <p class="mb-0 fs-6 text-white">[Tu Nombre / Grupo de Estudio]</p>
                        <p class="small mb-0 text-secondary">FIIS - Universidad Nacional del Callao</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="modalLunes" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="row g-0">
                        <div class="col-md-7">
                            <div id="carLunes" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://scontent.flim38-1.fna.fbcdn.net/v/t39.30808-6/678119777_1558309342968778_7014248503061213154_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=7b2446&_nc_eui2=AeETz1X-70SxCF8A8yKwLrR6EeQCOwkHVGsR5AI7CQdUaxZzEICGdxPQWWofyW5GUnLsuOTG0A-w0WMqsgd7l5Yh&_nc_ohc=TwSyz_geMHcQ7kNvwE1EhDY&_nc_oc=Adqig0Pj4f3FCUCKsW7AWOTEh68i3Ri9VUpi6ciNNsa7M77YR-i-FV8J0JDLpBfaiEU&_nc_zt=23&_nc_ht=scontent.flim38-1.fna&_nc_gid=pwKTnhyujTRXiVoOoAgL8g&_nc_ss=7b2a8&oh=00_Af36dmZzR0RVJDnCR3X6eJ2lKDw5zXCGu6WObKYfMnwGBw&oe=69EF2907" class="d-block w-100 modal-carousel-img" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://scontent.flim33-1.fna.fbcdn.net/v/t39.30808-6/677937454_1558309096302136_7831407186165713597_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=7b2446&_nc_eui2=AeGUmn2T2zgsUwV4jMeNMFYWIMNTsZziObUgw1OxnOI5tTYI9g7Nm6m8Nt7MbzhWYn9d46Mqkp89jLAUYuhOpT6N&_nc_ohc=vWPGwUwtgekQ7kNvwEpBi5t&_nc_oc=AdrRXZqlISl8Ajb09xtASe_BgEExbByt7Tt-hd0lG121wVO3IoFUeL3rPzKY3VtsmG0&_nc_zt=23&_nc_ht=scontent.flim33-1.fna&_nc_gid=n2Gp9qMvIJxncGxRylYW9A&_nc_ss=7b2a8&oh=00_Af0imYuOMxGE_Fb-fCBAth3BBHGgyxOXIAsd5o1j0W-z6Q&oe=69EF0D21" class="d-block w-100 modal-carousel-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 p-4 d-flex flex-column justify-content-center">
                            <h3 class="fw-bold text-uppercase" style="color: var(--azul-corp);">Lunes Cívico</h3>
                            <p class="text-muted">Actividad semanal orientada a fortalecer la identidad nacional y el respeto por nuestros símbolos patrios.</p>
                            <button type="button" class="btn btn-dark mt-3 text-uppercase fw-bold" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCapacitacion" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="row g-0">
                        <div class="col-md-7">
                            <div id="carCap" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://scontent.flim38-1.fna.fbcdn.net/v/t39.30808-6/673562750_1556792449787134_7588041362529535322_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeHDC59lG0E2VnXAJRkq-lk5JuntUm4_4tQm6e1Sbj_i1LsedsiMCT3Jb_0rvPek-bzMJGQwQVEcwX7dLnN7Nh6e&_nc_ohc=xNJM-M6CqCQQ7kNvwH_mLjW&_nc_oc=AdpjWYIMDO1pFSjTBfXYdPO2h9Ly3Ds6NR8L-Fc-JraLDVUG-dXgrzozfVhFBMAoWw4&_nc_zt=23&_nc_ht=scontent.flim38-1.fna&_nc_gid=9m_61d4pdkLH6NbUJslf0w&_nc_ss=7b2a8&oh=00_Af0YUpRxbU0vhdquqC9bYZJYEManrEj2B93qksuAtJvJaw&oe=69EF24FC" class="d-block w-100 modal-carousel-img" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://scontent.flim28-1.fna.fbcdn.net/v/t39.30808-6/674185866_1556369669829412_7563314593996120679_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=7b2446&_nc_eui2=AeEtavPemTbflQM9bLvj5Gl_xmJu1kt_AlHGYm7WS38CUU0sEf9JD1i4rtDXpepGp3TBIO5iIQKQNOWbRypxPAvb&_nc_ohc=sFiLx-1mqkQQ7kNvwFXL1oC&_nc_oc=AdoIeccn7w_VX61FlzQ7truyejTW57cGQWNzraEHfShC8etKgUBPuii-vSIK1fVZ-Nw&_nc_zt=23&_nc_ht=scontent.flim28-1.fna&_nc_gid=-WJamafjDGx4i3qxmH2qCg&_nc_ss=7a2a8&oh=00_Af3Xr-MlG-3m1PmmZAsiD6BJcaPhMWS8f96Y40O9Toe2NQ&oe=69EEFD52" class="d-block w-100 modal-carousel-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 p-4 d-flex flex-column justify-content-center">
                            <h3 class="fw-bold text-uppercase" style="color: var(--azul-corp);">Capacitaciones</h3>
                            <p class="text-muted">Talleres formativos constantes para docentes y padres de familia buscando la excelencia educativa.</p>
                            <button type="button" class="btn btn-dark mt-3 text-uppercase fw-bold" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalLogro" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="row g-0">
                        <div class="col-md-7">
                            <div id="carLogro" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://scontent.flim28-2.fna.fbcdn.net/v/t39.30808-6/603812800_1453739246759122_2926235647301770198_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeEeigmeWSsilCtj_QniOhZAJkP0C-uDo2EmQ_QL64OjYVZy7p_tVfF_gwCl-xFw9KjM2PlZOg36romt02GMXHze&_nc_ohc=VDTT3j_8ZzQQ7kNvwFSr0LR&_nc_oc=AdpKZuoto08VSoyL6xsU446p-TGGxx7IjmWv_Xcr3ns6as-GsE9qP40RRrkxzgXWUC0&_nc_zt=23&_nc_ht=scontent.flim28-2.fna&_nc_gid=0A5x8jDFfHYHEoB-f1sMJg&_nc_ss=7b2a8&oh=00_Af0DweuD91l5CAXon8jN1eOFhpAKKgN_yfqzIUcm81luQg&oe=69EF1468" class="d-block w-100 modal-carousel-img" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://scontent.flim28-2.fna.fbcdn.net/v/t39.30808-6/603854049_1453739890092391_1528620867571805905_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeF-wQDNo40HvrdWK67c--pAKtiSXIsPwIQq2JJciw_AhNPjIYPTsYKzlJQyqv08VOkms2GoBYtFup6dX2M2Mmf6&_nc_ohc=zHxJjhWayLkQ7kNvwELfrHg&_nc_oc=AdrEoyr60rk9eaNwmz6TWSiggtXs2zO9V9UOqAdFwNJI3HiAYZH3WldG0bUIFfEB0lg&_nc_zt=23&_nc_ht=scontent.flim28-2.fna&_nc_gid=4v_pw30xFIPqCWfxAHmsWg&_nc_ss=7b2a8&oh=00_Af3bnmqPBsjx9tNsc1C3j4Ae1BillTFtI1HTBjwOoa66BQ&oe=69EEF9FC" class="d-block w-100 modal-carousel-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 p-4 d-flex flex-column justify-content-center">
                            <h3 class="fw-bold text-uppercase" style="color: var(--azul-corp);">Día del Logro</h3>
                            <p class="text-muted">Presentación de proyectos y aprendizajes alcanzados por nuestros estudiantes durante el año escolar.</p>
                            <button type="button" class="btn btn-dark mt-3 text-uppercase fw-bold" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAniversario" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="row g-0">
                        <div class="col-md-7">
                            <div id="carAniv" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://scontent.flim38-1.fna.fbcdn.net/v/t39.30808-6/519078133_1312735497526165_6616782515752157946_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeH8t_aToN3PsV3oodN67CtMuxJq6kVjX2a7EmrqRWNfZit7MY5Y9xZF-MmfaMu0lJYYSZ_xt3t-U0pLcpQcZYho&_nc_ohc=3G15BMe2mZ4Q7kNvwEtl-P5&_nc_oc=AdrldMj2TvG2VnDqLAnya43z759IdAwpji9aR6mrBhE9LEO881QcWJ3jOQYVlzinpXM&_nc_zt=23&_nc_ht=scontent.flim38-1.fna&_nc_gid=UjRWP0J0X-L7fKnlu2RiNA&_nc_ss=7b2a8&oh=00_Af25wWanAGAGcrDXVbiUv2m9bMw-ROL4ijERG4nXHHqG8A&oe=69EF0388" class="d-block w-100 modal-carousel-img" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://scontent.flim33-1.fna.fbcdn.net/v/t39.30808-6/521358052_1315293437270371_1818448149691760854_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeHytaCgCCim6jHukxllMRjGeZiGzx6pxsN5mIbPHqnGwzn4C_cBWpmZtE6yuImxKaSvC856yLolhHGHHVXnIGBH&_nc_ohc=SmpmA2tmqwQQ7kNvwHtx4uH&_nc_oc=Ado09XIZVKlfcmefufhdgZeFaA-wOsX97nhObWEAjq4eO_yB8VQyVCI3OR2guIUngKo&_nc_zt=23&_nc_ht=scontent.flim33-1.fna&_nc_gid=eTKf5nLeKuxmdWQM_bdUCw&_nc_ss=7b2a8&oh=00_Af27uD3T0Q3h3AqYkPGyTFKl0XwQjkRif0vBLHjWvJ1t3Q&oe=69EF2B43" class="d-block w-100 modal-carousel-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 p-4 d-flex flex-column justify-content-center">
                            <h3 class="fw-bold text-uppercase" style="color: var(--azul-corp);">Aniversario</h3>
                            <p class="text-muted">Celebración de la fundación de nuestra institución con actividades culturales, deportivas y artísticas.</p>
                            <button type="button" class="btn btn-dark mt-3 text-uppercase fw-bold" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNavidad" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="row g-0">
                        <div class="col-md-7">
                            <div id="carNav" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://scontent.flim28-1.fna.fbcdn.net/v/t39.30808-6/603739309_1453738770092503_7222872127178948392_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeEgOeifmMoPH6j5uF3ogVOOgqE86GnFOsmCoTzoacU6ye3UKtuAW_ooJwQWZX4GRJzgIp3hfDuMYVTS3CJ0YlRs&_nc_ohc=Ak33cvu0624Q7kNvwGY2Myk&_nc_oc=AdqENkXnbu3eTIY4Kfm5j6WKlePqHXRKYZvjtC2x92sAkJBaGBFLKIEGn6RBCNTpk6I&_nc_zt=23&_nc_ht=scontent.flim28-1.fna&_nc_gid=nJ36AfhleY1k3B2D3MQjsg&_nc_ss=7b2a8&oh=00_Af1PagtsvRMaXo44ql1_9So3r2IiicAVSB91UyEkVm6fjA&oe=69EF1C8B" class="d-block w-100 modal-carousel-img" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://scontent.flim38-1.fna.fbcdn.net/v/t39.30808-6/495089509_1256365239829858_8036629027243609953_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeEiY79rur90eZw_jEdXDLN0wsLO2YzkIszCws7ZjOQizMhQCHUcoEYtSSVU_tOBesaZ_7Z8rNk_0D62UHBJigns&_nc_ohc=4p3lN6cv8VcQ7kNvwFoPPPi&_nc_oc=AdrBrEFLlLwqOAkxH3dl3N7GJMmODjIH2cm69gcSj_7McX1ak0TaE7qnYnL9Wm2Eruc&_nc_zt=23&_nc_ht=scontent.flim38-1.fna&_nc_gid=bdKY3bQdMFospV0YiT2oXQ&_nc_ss=7a2a8&oh=00_Af1XohN1KVZ-Gta5-p2AeX9BN6kl67sFgkAriSrmUYpTHQ&oe=69EF24B8" class="d-block w-100 modal-carousel-img" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 p-4 d-flex flex-column justify-content-center">
                            <h3 class="fw-bold text-uppercase" style="color: var(--azul-corp);">Navidad</h3>
                            <p class="text-muted">Compartir navideño institucional para fomentar la unión y solidaridad en toda la familia arguediana.</p>
                            <button type="button" class="btn btn-dark mt-3 text-uppercase fw-bold" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalOtros" tabindex="-1">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-uppercase">Galería Extra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="carOtros" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://scontent.flim38-1.fna.fbcdn.net/v/t39.30808-6/540646677_1357053606427687_6544593921999699304_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeFJw9xo_8gmHzFZ7P0LXJCT0K_2jR5ydy7Qr_aNHnJ3Lp7-pp4TNfNa-EeOi4dZfI6OjeuwZOk2Ip_fayAl4ot_&_nc_ohc=yeU2fctho0sQ7kNvwEUujxt&_nc_oc=AdoReXhob5qmiAK3cH7InGf6M0Hv_EmmaeoahYDcJnI-PztuTmYQX5BNSmfOIvhKcPI&_nc_zt=23&_nc_ht=scontent.flim38-1.fna&_nc_gid=xJlpgWE74Q2LinDZSDLacg&_nc_ss=7a2a8&oh=00_Af1g1tUUhRnBXlLN2uNI-j1qADUTkUURQ3JgBkU2OBDseg&oe=69EF13CB" class="d-block w-100 modal-carousel-img" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://scontent.flim38-1.fna.fbcdn.net/v/t39.30808-6/590983309_1435349158598131_2901853620103314067_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=13d280&_nc_eui2=AeHkn32yGtImlaW1jX_71aZp5KIpIM2JN7PkoikgzYk3s6k20sfqyJ9HwrmrPBYIVkXqFmxdl6nc2LpVirfs2hxA&_nc_ohc=R0lRE5GbNJwQ7kNvwFRFs4z&_nc_oc=Adr1nhvyelgqqE4Y2aiylc1L0Ml71UWzgsgv0jtVXEC1wrppsYvfF-RL5Cn8MHT1nt8&_nc_zt=23&_nc_ht=scontent.flim38-1.fna&_nc_gid=d1HKTDgP4_n_QNN46Fq5DQ&_nc_ss=7a2a8&oh=00_Af3KRLk-HcNmMBeGD3MrZGeLKfJPCljnRmJV9LXcEnJpTA&oe=69EF0359" class="d-block w-100 modal-carousel-img" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
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
                        <button type="submit" class="btn btn-primary w-100 fw-bold py-3 mt-2 text-uppercase">Ingresar al Sistema</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>