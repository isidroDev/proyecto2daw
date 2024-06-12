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


$stmt = $link->prepare("SELECT compras.curso_id, cursos.nombre AS curso_nombre, compras.modulo_id, modulos.nombre AS modulo_nombre 
FROM compras 
JOIN cursos ON compras.curso_id = cursos.curso_id 
LEFT JOIN modulos ON compras.modulo_id = modulos.modulo_id 
WHERE compras.usuario_id = ? AND (modulos.modulo_id = 3 OR compras.modulo_id IS NULL)");
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
                        echo '<div class="price">Técnicas de Ayuda Odontológica</div>';
                    } else {
                        echo '<div class="price">160€</div>';
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

    <div class="container mt-5">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="accordion w-50 no-border" id="accordionTemas">
                    <div class="accordion-item ">
                        <h2 class="accordion-header" id="heading1">
                            <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Orientación Módulo Odontología</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <a href=""> videoclase de orientación Odontología></a> 
                               
                            <?php else: ?>
                                videoclase de orientación Odontología
                            <?php endif; ?>   
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading2">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 1 - El equipo de Salud Bucodental</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href="">Tema: El equipo de Salud Bucodental</a>
                                    <a href="">Test</a>
                                    <a href="">Solucionario</a>
                             <?php else: ?>
                                <ul>
                                    <li>Tema: El equipo de Salud Bucodental</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                <?php endif; ?>       
                                </ul>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading3">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 2 - Componentes Técncicos y Materiales en el Consultorio Dental </span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href="">Tema: Componentes Técncicos y Materiales en el Consultorio Dental</a>
                                    <a href="">Test</a>
                                    <a href="">Solucionario</a>
                             <?php else: ?>
                                <ul>
                                    <li>Tema: Componentes Técncicos y Materiales en el Consultorio Dental</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                <?php endif; ?>       
                                </ul>
                            
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading4">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 3 - Anatomía Cavidad Bucal</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href="">Videoclase Anatomía Cavidad Bucal</a>
                                    <a href="">Tema: Anatomía Cavidad Bucal</a>
                                    <a href="">Test</a>
                                    <a href="">Solucionario</a>
                             <?php else: ?>
                                <ul>
                                    <li>Videoclase Anatomía Cavidad Bucal</li>
                                    <li>Tema: Anatomía Cavidad Bucal</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                <?php endif; ?>       
                                </ul>
                            
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading5">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 4 - Exploración Clínica</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href="">Tema: Exploración Clínica</a>
                                    <a href="">Test</a>
                                    <a href="">Solucionario</a>
                             <?php else: ?>
                                <ul>
                                    <li>Tema: Exploración Clínica</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                <?php endif; ?>       
                                </ul>
                           
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading6">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 5 - Rayos X</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href="">Tema: Rayos X</a>
                                    <a href="">Test</a>
                                    <a href="">Solucionario</a>
                             <?php else: ?>
                                <ul>
                                    <li>Tema: Rayos X</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                <?php endif; ?>       
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading7">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 6 - Farmacología y Control del Dolor</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href="">Tema: Farmacología y Control del Dolor</a>
                                    <a href="">Test</a>
                                    <a href="">Solucionario</a>
                             <?php else: ?>
                                <ul>
                                    <li>Tema: Farmacología y Control del Dolor</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                <?php endif; ?>       
                                </ul>
                            
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading8">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 7 - Pautas Generales de Asistencia en el Gabinete</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href="">Tema: Pautas Generales de Asistencia en el Gabinete</a>
                                    <a href="">Test</a>
                                    <a href="">Solucionario</a>
                             <?php else: ?>
                                <ul>
                                    <li>Tema: Pautas Generales de Asistencia en el Gabinete</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                <?php endif; ?>       
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading9">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 8 - Instrumental Dental 1</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href="">Tema: Instrumental Dental 1</a>
                                    <a href="">Test</a>
                                    <a href="">Solucionario</a>
                             <?php else: ?>
                                <ul>
                                    <li>Tema: Instrumental Dental 1</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                <?php endif; ?>       
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading10">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 9 - Instrumental Dental 2</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href="">Tema: Instrumental Dental 2</a>
                                    <a href="">Test</a>
                                    <a href="">Solucionario</a>
                             <?php else: ?>
                                <ul>
                                    <li>Tema: Instrumental Dental 2</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                <?php endif; ?>       
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading11">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 10 - Materiales Dentales</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading11" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href="">Tema: Materiales Dentales</a>
                                    <a href="">Test</a>
                                    <a href="">Solucionario</a>
                             <?php else: ?>
                                <ul>
                                    <li>Tema: Materiales Dentales</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                <?php endif; ?>       
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading12">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 11 - Odontología Preventiva y Comunitaria </span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href="">Tema: Odontología Preventiva y Comunitaria</a>
                                    <a href="">Test</a>
                                    <a href="">Solucionario</a>
                             <?php else: ?>
                                <ul>
                                    <li>Tema: Odontología Preventiva y Comunitaria</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                <?php endif; ?>       
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading13">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Preparación Práctica</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="heading13" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Idenfiticación de Instrumental Odontológico</li></a>
                                    <a href=""><li>Realización de Odontogramas</li></a>
                                    <a href=""><li>Radiografías Dentales</li></a>
                                    <a href=""><li>Materiales Dentales</li></a>
                                    <a href=""><li>Bandejas de Exploración</li></a>
                                <?php else: ?>
                                    <li>Idenfiticación de Instrumental Odontológico</li>
                                    <li>Realización de Odontogramas</li>
                                    <li>Radiografías Dentales</li>
                                    <li>Materiales Dentales</li>
                                    <li>Bandejas de Exploración</li>
                                <?php endif; ?>
                            </ul>    
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading22">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse22" aria-expanded="false" aria-controls="collapse22">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Simulacros Pruebas Libres TCAE</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse22" class="accordion-collapse collapse" aria-labelledby="heading21" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href="">Batería Exámenes Finales: Odontología</a>
                                    <a href="">Simulacros oficiales Odontología por CCAA</a>
                                <?php else: ?>
                                    <li>Batería Exámenes Finales: Odontología</li>
                                    <li>Simulacros oficiales Odontología por CCAA</li>
                                <?php endif; ?>
                                
                            </ul>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
    include 'vistas/footer.php';
?>





    