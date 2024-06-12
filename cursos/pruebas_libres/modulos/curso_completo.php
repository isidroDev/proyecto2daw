<!-- Ruta para que me coja el CSS -->
<link rel="stylesheet" href="/css/custom.css">

<!-- Establecer la barra del precio y depende del usuario los botones/enlances correspondientes -->
<?php
require_once 'php/conexion.php';

$link = conexion();

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

// Obtener el ID del usuario
$stmt = $link->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();

// Obtener los cursos y módulos comprados por el usuario
$stmt = $link->prepare("SELECT compras.curso_id, cursos.nombre AS curso_nombre, compras.modulo_id, modulos.nombre AS modulo_nombre 
FROM compras 
JOIN cursos ON compras.curso_id = cursos.curso_id 
LEFT JOIN modulos ON compras.modulo_id = modulos.modulo_id 
WHERE compras.usuario_id = ? AND (modulos.modulo_id = 1 OR compras.modulo_id IS NULL)");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($curso_id, $curso_nombre, $modulo_id, $modulo_nombre);

$cursos = array();
while ($stmt->fetch()) {
    $cursos[] = array("id" => $curso_id, "curso_nombre" => $curso_nombre, "modulo_id" => $modulo_id, "modulo_nombre" => $modulo_nombre);
}
$stmt->close();

?>

    <div class="container mt-5">
        <div class="price-card">
                <div class="text-center">
                <?php
                    if (count($cursos) > 0) {
                        echo '<div class="price">Técnicas Básicas de Enfermería</div>';
                    } else {
                        echo '<div class="price">600€</div>';
                        echo '<div>Incluye: Temario + 1 mes tutoría</div>';
                        
                    }?>
                </div>
                <div class="divider"></div>
            <div class="text-center">
                <?php if (count($cursos) == 0): ?>
                    <?php if (isset($_SESSION['email'])): ?>
                    <!-- Formulario de PayPal solo si el usuario no ha comprado el módulo -->
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick" />
                        <input type="hidden" name="hosted_button_id" value="L4UTPPYDK299E" />
                        <input type="hidden" name="currency_code" value="EUR" />
                        <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" title="PayPal, la forma rápida y segura de pagar en Internet." alt="Comprar ahora" class="btn btn-apuntarme mt-2" />
                    </form>
                    <?php else: ?>
                <!-- Enlace para redirigir a la página de acceso si el usuario no está conectado -->
                <a href="preparadoratcae.php?m=acceso" class="btn btn-secondary mt-2">Debe iniciar sesión para comprar</a>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Enlace para acceder solo si el usuario ha comprado el módulo -->
                    <button type="button" class="btn btn-success" disabled style="opacity: 1;">Activo</button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <hr>






<!-- Formato en linea Para mostrar los módulos -->


<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 d-none d-custom-block">
            <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_1" style="text-decoration: none; color: inherit;">
                <div class="card" style="width: 50%;">
                    <img src="/img/11.png" class="card-img-top " alt="Curso Completo">
                </div>
            </a>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center text-center">
            <p class="textoCursoCompleto">Técnicas Básicas de Enfermería</p>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
            <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_1" class="btn btn-primary boton">Acceder</button></a>
        </div>  
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 d-none d-custom-block">
            <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_2" style="text-decoration: none; color: inherit;">
                <div class="card" style="width: 50%;">
                    <img src="/img/21.png" class="card-img-top" alt="Curso Completo">
                </div>
            </a>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center text-center">
            <p class="textoCursoCompleto">Higiene del Medio Hospitalario</p>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
        <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_2" class="btn btn-primary boton">Acceder</button></a>
        </div>  
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 d-none d-custom-block">
            <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_3" style="text-decoration: none; color: inherit;">
                <div class="card" style="width: 50%;">
                    <img src="/img/22.png" class="card-img-top" alt="Curso Completo">
                </div>
            </a>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center text-center">
            <p class="textoCursoCompleto">Téncias de Ayuda Odontológica</p>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
        <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_3" class="btn btn-primary boton">Acceder</button></a>
        </div>  
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 d-none d-custom-block">
            <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_4" style="text-decoration: none; color: inherit;">
                <div class="card" style="width: 50%;">
                    <img src="/img/23.png" class="card-img-top" alt="Curso Completo">
                </div>
            </a>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center text-center">
            <p class="textoCursoCompleto">Operaciones Administrativas y Documentación Santiraria</p>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
        <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_4" class="btn btn-primary boton">Acceder</button></a>
        </div>  
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 d-none d-custom-block">
            <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_5" style="text-decoration: none; color: inherit;">
                <div class="card" style="width: 50%;">
                    <img src="/img/24.png" class="card-img-top" alt="Curso Completo">
                </div>
            </a>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center text-center">
            <p class="textoCursoCompleto">Promoción de la Salud y Apoyo Psicológico al Paciente</p>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
        <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_5" class="btn btn-primary boton">Acceder</button></a>
        </div>  
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 d-none d-custom-block">
            <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_6" style="text-decoration: none; color: inherit;">
                <div class="card" style="width: 50%;">
                    <img src="/img/25.png" class="card-img-top" alt="Curso Completo">
                </div>
            </a>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center text-center">
            <p class="textoCursoCompleto">Formación y Orientación Laboral (FOL)</p>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
        <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_6" class="btn btn-primary boton">Acceder</button></a>
        </div>  
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 d-none d-custom-block">
            <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_7" style="text-decoration: none; color: inherit;">
                <div class="card" style="width: 50%;">
                    <img src="/img/26.png" class="card-img-top" alt="Curso Completo">
                </div>
            </a>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center text-center">
            <p class="textoCursoCompleto">Relaciones en el Entorno de Trabajo (RET)</p>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
        <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_7" class="btn btn-primary boton">Acceder</button></a>
        </div>  
    </div>
</div>



<?php
    include 'vistas/footer.php';
    ?>