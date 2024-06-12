<!DOCTYPE html>
<html lang="es">

<head>
    <title>TCAE INTEGRAL</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/custom.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
 
</head>

<body>
    <!-- Aqui va el menú de navegación-->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="d-lg-flex justify-content-lg-between w-100">
                <div class="navbar-nav">
                    <li class="nav-item nav-item-custom">
                        <a class="nav-link text-white menu-link"  href="/preparadoratcae.php?m=cursos">CURSOS</a>
                    </li>
                    <li class="nav-item nav-item-custom">
                        <a class="nav-link text-white menu-link" href="https://www.tcaeintegral.es/" target="_blank">BLOG</a>
                    </li>
                    <li class="nav-item nav-item-custom">
                        <a class="nav-link text-white menu-link" href="https://www.youtube.com/@TCAEINTEGRAL" target="_blank">VIDEOCLASES</a>
                    </li>
                </div>

                <div class="navbar-nav">
                    
                    <li class="nav-item nav-item-custom1 dropdown">
                        <?php if (isset($_SESSION['email'])) : ?>
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="email-style">Hola <?php echo $_SESSION['nombre']; ?>!</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/preparadoratcae.php?m=area_usuario">Aula Virtual</a></li>
                                <?php if ($_SESSION['email'] == 'admin@tcaeintegral.com'): ?>
                                    <li><a class="dropdown-item" href="/preparadoratcae.php?m=administracion">Administracion</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="/preparadoratcae.php?m=cerrar">Cerrar sesión</a></li>
                            </ul>
                        <?php else : ?>
                            <a class="nav-link text-white menu-link" href="/preparadoratcae.php?m=acceso">ACCESO</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item nav-item-custom1">
                        <a class="nav-link text-white menu-link" href="/preparadoratcae.php?m=contacto">CONTACTO</a>
                    </li>
                </div>
            </div>
        </div>
        <div class="navbar-logo">
            <a href="/preparadoratcae.php?m=inicio">
                <img src="/img/logo2.png" alt="Logo">
            </a>
        </div>
    </nav>
    
</body>

</html>