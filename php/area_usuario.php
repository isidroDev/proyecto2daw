<?php
require_once 'conexion.php';
$link = conexion();

// Comprobar si el usuario está logueado y si no redirigirlo a la página de acceso

if (!isset($_SESSION['email'])) {
    header('Location: /preparadoratcae.php?m=acceso');
    exit();
}

$email = $_SESSION['email'];

// Obtener el ID del usuario
$stmt = $link->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();


// Obtener los cursos y módulos comprados por el usuario
$stmt = $link->prepare("SELECT compras.curso_id, cursos.nombre AS curso_nombre, compras.modulo_id, modulos.nombre AS modulo_nombre FROM compras JOIN cursos ON compras.curso_id = cursos.curso_id LEFT JOIN modulos ON compras.modulo_id = modulos.modulo_id WHERE compras.usuario_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($curso_id, $curso_nombre, $modulo_id, $modulo_nombre);

$cursos = array();
while ($stmt->fetch()) {
    $cursos[] = array("id" => $curso_id, "curso_nombre" => $curso_nombre, "modulo_id" => $modulo_id, "modulo_nombre" => $modulo_nombre);
}
$stmt->close();
$link->close();


?>


<div class="container mt-5">
    <h1>Bienvenido al Aula Virtual</h1>
    <h2>Cursos Disponibles</h2>
        <ul style="list-style-type: none" ;>
            <?php foreach ($cursos as $curso) : ?>
                <li>
                    <?php if ($curso['id'] == 1 && $curso['modulo_id'] == null) : ?>
                        <a href="/preparadoratcae.php?m=curso_completo"><?php echo $curso['curso_nombre']; ?></a>
                    <?php elseif ($curso['id'] == 1 && $curso['modulo_id'] == 1) : ?>
                        <div class="col-4">
                            <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_1" style="text-decoration: none; color: inherit;">
                                <div class="card" style="width: 100%;">
                                    <img src="/img/11.png" class="card-img-top" alt="TBE">
                                    <div class="card-body">
                                        <h5 class="card-title">Técnicas Básicas de Enfermería.</h5>
                                        <p class="card-text">Módulo 1</p>
                                        <div class="d-flex flex-column align-items-center mt-extra">
                                            <button class="btn btn-primary">Comenzar</button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <br>
                    <?php elseif ($curso['id'] == 1 && $curso['modulo_id'] == 2 || $curso['modulo_id'] == null) : ?>
                        <div class="col-4">
                            <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_2" style="text-decoration: none; color: inherit;">
                                <div class="card" style="width: 100%;">
                                    <img src="/img/21.png" class="card-img-top" alt="Higiene">
                                    <div class="card-body">
                                        <h5 class="card-title">Higiene del Medio Hospitalario</h5>
                                        <p class="card-text">Módulo 2</p>
                                        <div class="d-flex flex-column align-items-center mt-extra">
                                            <button class="btn btn-primary">Comenzar</button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <br>
            <?php elseif ($curso['id'] == 1 && $curso['modulo_id'] == 3) : ?>
                <div class="col-4">
                    <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_3" style="text-decoration: none; color: inherit;">
                        <div class="card" style="width: 100%;">
                            <img src="/img/22.png" class="card-img-top" alt="Ontologica">
                            <div class="card-body">
                                <h5 class="card-title">Téncias de Ayuda Odontológica</h5>
                                <p class="card-text">Módulo 3</p>
                                <div class="d-flex flex-column align-items-center mt-extra">
                                    <button class="btn btn-primary">Comenzar</button>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <br>
            <?php elseif ($curso['id'] == 1 && $curso['modulo_id'] == 4) : ?>
                <div class="col-4">
                    <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_4" style="text-decoration: none; color: inherit;">
                        <div class="card" style="width: 100%;">
                            <img src="/img/23.png" class="card-img-top" alt="Administrativo">
                            <div class="card-body">
                                <h5 class="card-title">Operaciones Administrativas y Documentación Santiraria</h5>
                                <p class="card-text">Módulo 4</p>
                                <div class="d-flex flex-column align-items-center mt-extra">
                                    <button class="btn btn-primary">Comenzar</button>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <br>
                 <?php elseif ($curso['id'] == 1 && $curso['modulo_id'] == 5) : ?> <div class="col-4">
                    <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_5" style="text-decoration: none; color: inherit;">
                        <div class="card" style="width: 100%;">
                            <img src="/img/24.png" class="card-img-top" alt="Psicologia">
                            <div class="card-body">
                                <h5 class="card-title">Promoción de la Salud y Apoyo Psicológico al Paciente</h5>
                                <p class="card-text">Módulo 5</p>
                                <div class="d-flex flex-column align-items-center mt-extra">
                                    <button class="btn btn-primary">Comenzar</button>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                    <br>
                <?php elseif ($curso['id'] == 1 && $curso['modulo_id'] == 6) : ?>
                    <div class="col-4">
                        <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_6" style="text-decoration: none; color: inherit;">
                            <div class="card" style="width: 100%;">
                                <img src="/img/25.png" class="card-img-top" alt="FOL">
                                <div class="card-body">
                                    <h5 class="card-title">Formación y Orientación Laboral (FOL)</h5>
                                    <p class="card-text">Módulo 6</p>
                                    <div class="d-flex flex-column align-items-center mt-extra">
                                        <button class="btn btn-primary">Comenzar</button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <br>
                <?php elseif ($curso['id'] == 1 && $curso['modulo_id'] == 7) : ?>
                    <div class="col-4">
                        <a href="/preparadoratcae.php?m=cursos/pruebas_libres/modulo_7" style="text-decoration: none; color: inherit;">
                            <div class="card" style="width: 100%;">
                                <img src="/img/26.png" class="card-img-top" alt="RET">
                                <div class="card-body">
                                    <h5 class="card-title">Relaciones en el Entorno de Trabajo (RET)</h5>
                                    <p class="card-text">Módulo 7</p>
                                    <div class="d-flex flex-column align-items-center mt-extra">
                                        <button class="btn btn-primary">Comenzar</button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <br>
                <?php else : ?>
                    <a href="curso.php?curso_id=<?php echo $curso['id']; ?>"><?php echo $curso['curso_nombre']; ?></a>
                <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
</div>

<?php
include 'vistas/footer.php';
?>
