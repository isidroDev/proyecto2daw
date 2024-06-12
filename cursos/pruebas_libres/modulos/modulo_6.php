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
WHERE compras.usuario_id = ? AND (modulos.modulo_id = 6 OR compras.modulo_id IS NULL)");
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
                        echo '<div class="price">Formación y Orientación Laboral (FOL)</div>';
                    } else {
                        echo '<div class="price">60€</div>';
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
                        <input type="hidden" name="hosted_button_id" value="HVWUA5UKR66RE" />
                        <input type="hidden" name="currency_code" value="EUR" />
                        <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" title="PayPal, la forma rápida y segura de pagar en Internet." alt="Comprar ahora" />
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
                                    <span>Orientación Módulo Formación y Orientación Laboral (FOL)</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <a href=""> videoclase de Orientación Módulo Formación y Orientación Laboral (FOL)</a> 
                               
                            <?php else: ?>
                                videoclase de Orientación Módulo Formación y Orientación Laboral (FOL)
                            <?php endif; ?>   
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading2">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 1 - La relación laboral</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                   <a href=""><li>Tema: La relación laboral</li></a>
                                   <a href=""><li>Test</li></a>
                                   <a href=""><li>Solucionario</li></a>
                                   <?php else: ?>
                                      <li>Tema: La relación laboral</li>
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
                                    <span>Tema 2 - El contrato de trabajo y sus modalidades</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Tema: El contrato de trabajo y sus modalidades</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: El contrato de trabajo y sus modalidades</li>
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
                                    <span>Tema 3 - El tiempo de trabajo</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <ul>
                                <?php if (count($cursos) > 0): ?>
                                    <a href=""><li>Tema: El tiempo de trabajo</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: El tiempo de trabajo</li>
                                        <li>Test</li>
                                        <li>Solucionario</li>
                                    <?php endif; ?>
                            <ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading5">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 4 - El salario y la nómina</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Tema: El salario y la nómina</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: El salario y la nómina</li>
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
                                    <span>Tema 5 - Modificación, suspensión y extinción del contrato</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <ul>
                                <?php if (count($cursos) > 0): ?>
                                    <a href=""><li>Tema: Modificación, suspensión y extinción del contrato</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: Modificación, suspensión y extinción del contrato</li>
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
                                    <span>Tema 6 - La Seguridad Social</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <ul>
                                <?php if (count($cursos) > 0): ?>
                                    <a href=""><li>Tema: La Seguridad Social</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: La Seguridad Social</li>
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
                                    <span>Tema 7 - Participación de las personas trabajadoras en la empresa</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <ul>
                                <?php if (count($cursos) > 0): ?>
                                    <a href=""><li>Tema: Participación de las personas trabajadoras en la empresa</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: Participación de las personas trabajadoras en la empresa</li>
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
                                    <span>Tema 8 - Los equipos de trabajo y la gestión de los conflictos</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <ul>
                                <?php if (count($cursos) > 0): ?>
                                    <a href=""><li>Tema: Los equipos de trabajo y la gestión de los conflictos</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: Los equipos de trabajo y la gestión de los conflictos</li>
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
                                    <span>Tema 9 - Búsqueda activa de empleo</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <ul>
                                <?php if (count($cursos) > 0): ?>
                                    <a href=""><li>Tema: Búsqueda activa de empleo</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: Búsqueda activa de empleo</li>
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
                                    <span>Tema 10 - Prevención de riesgos y salud laboral</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading11" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <ul>
                                <?php if (count($cursos) > 0): ?>
                                    <a href=""><li>Tema: Prevención de riesgos y salud laboral</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: Prevención de riesgos y salud laboral</li>
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
                                    <span>Tema 11 - La gestión de la prevención en la empresa </span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <ul>
                                <?php if (count($cursos) > 0): ?>
                                    <a href=""><li>Tema: La gestión de la prevención en la empresa</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: La gestión de la prevención en la empresa</li>
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
                                    <span>Tema 12 - Los riesgos ambientales en el trabajo</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="heading13" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <ul>
                                <?php if (count($cursos) > 0): ?>
                                    <a href=""><li>Tema: Los riesgos ambientales en el trabajo</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: Los riesgos ambientales en el trabajo</li>
                                        <li>Test</li>
                                        <li>Solucionario</li>
                                    <?php endif; ?>
                            </ul>    
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading14">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 13 - Los riesgos de las condiciones de seguridad, ergonómicas y psicosociales</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse14" class="accordion-collapse collapse" aria-labelledby="heading14" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <ul>
                                <?php if (count($cursos) > 0): ?>
                                    <a href=""><li>Tema: Los riesgos de las condiciones de seguridad, ergonómicas y psicosociales</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: Los riesgos de las condiciones de seguridad, ergonómicas y psicosociales</li>
                                        <li>Test</li>
                                        <li>Solucionario</li>
                                    <?php endif; ?>
                            </ul>    
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading15">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 14 - Los primeros auxilios en la empresa</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse15" class="accordion-collapse collapse" aria-labelledby="heading15" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <ul>
                                <?php if (count($cursos) > 0): ?>
                                    <a href=""><li>Tema: Los primeros auxilios en la empresa</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: Los primeros auxilios en la empresa</li>
                                        <li>Test</li>
                                        <li>Solucionario</li>
                                    <?php endif; ?>
                            </ul>    
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading21">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse21" aria-expanded="false" aria-controls="collapse21">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Preparación Práctica</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse21" class="accordion-collapse collapse" aria-labelledby="heading21" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Cálculo de Nóminas</li></a>
                                    <?php else: ?>
                                        <li>Cálculo de Nóminas</li>
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
                                    <a href=""><li>Batería Exámenes Finales: Formación y Orientación Laboral (FOL)</li></a>
                                    <a href=""><li>Batería Exámenes Finales: TBE 800 preguntas</li></a>
                                    <?php else: ?>
                                        <li>Batería Exámenes Finales: Formación y Orientación Laboral (FOL)</li>
                                        <li>Batería Exámenes Finales: TBE 800 preguntas</li>
                                        
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




    