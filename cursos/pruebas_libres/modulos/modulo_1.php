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
                        echo '<div class="price">190€</div>';
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
                        <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" title="PayPal, la forma rápida y segura de pagar en Internet." alt="Comprar ahora" />
                    </form>
                    <?php else: ?>
                <!-- Enlace para redirigir a la página de acceso si el usuario no está conectado -->
                <a href="preparadoratcae.php?m=acceso" class="btn btn-primary mt-2">Debe iniciar sesión para comprar</a>
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
                                    <span>Orientación Módulo TBE</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <a href=""> videoclase de orientación TBE</a> 
                               
                            <?php else: ?>
                                videoclase de orientación TBE
                            <?php endif; ?>   
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading2">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 1 - Introducción</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                                <?php if (count($cursos) > 0): ?>
                                    <ul>
                                        <a href=""><li>Tema</li></a>
                                        <a href=""><li>Test</li></a>
                                        <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema</li>
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
                                    <span>Tema 2 - La Piel</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                                <?php if (count($cursos) > 0): ?>
                                    <ul>
                                        <a href=""><li>Tema: la Piel</li></a>
                                        <a href=""><li>Test</li></a>
                                        <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: la Piel</li>
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
                                    <span>Tema 3 - Sistema Osteo Musucular</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                                <?php if (count($cursos) > 0): ?>
                                    <ul>
                                        <a href=""><li>Tema: Sistema Osteo Muscular</li></a>
                                        <a href=""><li>Test</li></a>
                                        <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: Sistema Osteo Muscular</li>
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
                                    <span>Tema 4 - Movilización y Posiciones Corporales</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                                <?php if (count($cursos) > 0): ?>
                                    <ul>
                                        <a href=""><li>Tema: Movilización y Posiciones Corporales</li></a>
                                        <a href=""><li>Test</li></a>
                                        <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Tema: Movilización y Posiciones Corporales</li>
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
                                    <span>Tema 5 - Úlceras por Presión (UPP)</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                                <?php if (count($cursos) > 0): ?>
                                    <ul>
                                        <a href=""><li>Videoclase UPP</li></a>
                                        <a href=""><li>Tema: Úlceras por Presión (UPP)</li></a>
                                        <a href=""><li>Test</li></a>
                                        <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Videoclase UPP</li>
                                        <li>Tema: Úlceras por Presión (UPP)</li>
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
                                    <span>Tema 6 - Sistema Cardiovascular</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                                <?php if (count($cursos) > 0): ?>
                                    <ul>
                                        <a href=""><li>Videoclase Sistema Cardiovascular</li></a>
                                        <a href=""><li>Tema: Sistema Cardiovascular</li></a>
                                        <a href=""><li>Test</li></a>
                                        <a href=""><li>Solucionario</li></a>
                                        <a href=""><li>Anexo: Carro de Parada</li></a>
                                        <a href=""><li>Practica: Obtención de muestras sanguineas</li></a>
                                    <?php else: ?>
                                        <li>Videoclase Sistema Cardiovascular</li>
                                        <li>Tema: Sistema Cardiovascular</li>
                                        <li>Test</li>
                                        <li>Solucionario</li>
                                        <li>Anexo: Carro de Parada</li>
                                        <li>Practica: Obtención de muestras sanguineas</li>
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
                                    <span>Tema 7 - Constantes Vitales. Gráfica Hospitalaria</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                                <?php if (count($cursos) > 0): ?>
                                    <ul>
                                        <a href=""><li>Videoclase Constantes Vitales</li></a>
                                        <a href=""><li>Tema: Constantes Vitales. Gráfica Hospitalaria</li></a>
                                        <a href=""><li>Test</li></a>
                                        <a href=""><li>Solucionario</li></a>
                                        <a href=""><li>Práctica: Gráfica Hospitalaria</li></a>
                                    <?php else: ?>
                                        <li>Videoclase Constantes Vitales</li>
                                        <li>Tema: Constantes Vitales. Gráfica Hospitalaria</li>
                                        <li>Test</li>
                                        <li>Solucionario</li>
                                        <li>Práctica: Gráfica Hospitalaria</li>
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
                                    <span>Tema 8 - Aparato Urinario y Sondas Vesicales</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                                <?php if (count($cursos) > 0): ?>
                                    <ul>
                                        <a href=""><li>Videoclase Aparato Urinario</li></a>
                                        <a href=""><li>Tema: Aparato Urinario</li></a>
                                        <a href=""><li>Test</li></a>
                                        <a href=""><li>Solucionario</li></a>
                                        <a href=""><li>videoclase: Sondas Vesicales</li></a>
                                        <a href=""><li>Tema: Sondas Vesicales</li></a>
                                        <a href=""><li>Test</li></a>
                                        <a href=""><li>Solucionario</li></a>
                                    <?php else: ?>
                                        <li>Videoclase Aparato Urinario</li>
                                        <li>Tema: Aparato Urinario</li>
                                        <li>Test</li>
                                        <li>Solucionario</li>
                                        <li>videoclase: Sondas Vesicales</li>
                                        <li>Tema: Sondas Vesicales</li>
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
                                    <span>Tema 9 - Aparato Digestivo</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                                <?php if (count($cursos) > 0): ?>
                                    <ul>
                                        <a href=""><li>Videoclase Aparato Digestivo</li></a>
                                        <a href=""><li>Tema: Aparato Digestivo</li></a>
                                        <a href=""><li>Test</li></a>
                                        <a href=""><li>Solucionario</li></a>
                                        <a href=""><li>Anexo: Sondas Nasogástricas</li></a>
                                        <a href=""><li>Anexo: Ostomías</li></a>
                                    <?php else: ?>
                                        <li>Videoclase Aparato Digestivo</li>
                                        <li>Tema: Aparato Digestivo</li>
                                        <li>Test</li>
                                        <li>Solucionario</li>
                                        <li>Anexo: Sondas Nasogástricas</li>
                                        <li>Anexo: Ostomías</li>
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
                                    <span>Tema 10 - Alimentación, Metabolismo y Nutrición</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading11" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Videoclase Alimentación, Metabolismo y Nutrición</li></a>
                                    <a href=""><li>Tema: Alimentación, Metabolismo y Nutrición</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <a href=""><li>Anexo: Nutrición Enteral y Parenteral</li></a>
                                <?php else: ?>
                                    <li>Videoclase Alimentación, Metabolismo y Nutrición</li>
                                    <li>Tema: Alimentación, Metabolismo y Nutrición</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                    <li>Anexo: Nutrición Enteral y Parenteral</li>
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
                                    <span>Tema 11 - Preparación al Paciente para la Exploración </span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Tema: Preparación al Paciente para la Exploración</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <a href=""><li>Anexo: Posiciones Anatómicas</li></a>
                                    <a href=""><li>Práctica: Instrumental de Exploración</li></a>
                                <?php else: ?>
                                    <li>Tema: Preparación al Paciente para la Exploración</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                    <li>Anexo: Posiciones Anatómicas</li>
                                    <li>Práctica: Instrumental de Exploración</li>
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
                                    <span>Tema 12 - Vía de Administración de Medicamentos</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="heading13" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Videoclase Vía de Administración de Medicamentos</li></a>
                                    <a href=""><li>Tema: Vía de Administración de Medicamentos</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                <?php else: ?>
                                    <li>Videoclase Vía de Administración de Medicamentos</li>
                                    <li>Tema: Vía de Administración de Medicamentos</li>
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
                                    <span>Tema 13 - Aparato Respiratorio</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse14" class="accordion-collapse collapse" aria-labelledby="heading14" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Videoclase Aparato Respiratorio</li></a>
                                    <a href=""><li>Tema: Aparato Respiratorio</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <a href=""><li>Anexo: Oxigenoterapia</li></a>
                                <?php else: ?>
                                    <li>Videoclase Aparato Respiratorio</li>
                                    <li>Tema: Aparato Respiratorio</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                    <li>Anexo: Oxigenoterapia</li>
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
                                    <span>Tema 14 - Cuidados pre-intra y post operatorios</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse15" class="accordion-collapse collapse" aria-labelledby="heading15" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Tema: Cuidados pre-intra y post operatorios</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                    <a href=""><li>Anexo: Drenajes</li></a>
                                <?php else: ?>
                                    <li>Tema: Cuidados pre-intra y post operatorios</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                                    <li>Anexo: Drenajes</li>
                            <?php endif; ?>
                                </ul>    
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading16">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 15 - El Paciente Terminal. Cuidados Paliativos</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse16" class="accordion-collapse collapse" aria-labelledby="heading16" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Tema: El Paciente Terminal. Cuidados Paliativos</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                <?php else: ?>
                                    <li>Tema: El Paciente Terminal. Cuidados Paliativos</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                            <?php endif; ?>
                                </ul>    
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading17">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse17" aria-expanded="false" aria-controls="collapse17">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 16 - Sistema Neuroendocrino</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse17" class="accordion-collapse collapse" aria-labelledby="heading17" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Tema: Sistema Neuroendocrino</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                <?php else: ?>
                                    <li>Tema: Sistema Neuroendocrino</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                            <?php endif; ?>
                                </ul>    
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading18">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse18" aria-expanded="false" aria-controls="collapse18">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 17 - El Anciano</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse18" class="accordion-collapse collapse" aria-labelledby="heading18" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Tema: El Anciano</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                <?php else: ?>
                                    <li>Tema: El Anciano</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                            <?php endif; ?>
                                </ul>    
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading19">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse19" aria-expanded="false" aria-controls="collapse19">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 18 - Ostetricia y Recién Nacido </span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse19" class="accordion-collapse collapse" aria-labelledby="heading19" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Videoclase Recién Nacido</li></a>
                                    <a href=""><li>Tema: Recién Nacido</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                <?php else: ?>
                                    <li>Videoclase Recién Nacido</li>
                                    <li>Tema: Recién Nacido</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
                            <?php endif; ?>
                                </ul>    
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading20">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse20" aria-expanded="false" aria-controls="collapse20">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 19 - Urgencias 1</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse20" class="accordion-collapse collapse" aria-labelledby="heading20" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Tema: Urgencias 1: Heridas, Quemaduras, Fractuas, Hemorragias</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                <?php else: ?>
                                    <li>Tema: Urgencias 1: Heridas, Quemaduras, Fractuas, Hemorragias</li>
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
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse20" aria-expanded="false" aria-controls="collapse21">
                                <div style="display: flex; justify-content: space-between; width: 97%;">
                                    <span>Tema 19 - Urgencias 2</span> <span class="d-none d-md-block">Expandir</span>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse21" class="accordion-collapse collapse" aria-labelledby="heading21" data-bs-parent="#accordionTemas">
                            <div class="accordion-body">
                            <?php if (count($cursos) > 0): ?>
                                <ul>
                                    <a href=""><li>Tema: Urgencias 2: RCP, Soporte Vital Básico y Avanzado</li></a>
                                    <a href=""><li>Test</li></a>
                                    <a href=""><li>Solucionario</li></a>
                                <?php else: ?>
                                    <li>Tema: Urgencias 2: RCP, Soporte Vital Básico y Avanzado</li>
                                    <li>Test</li>
                                    <li>Solucionario</li>
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
                                    <a href=""><li>Batería Exámenes Finales: TBE 800 preguntas</li></a>
                                    <a href=""><li>Simulacros oficiales TBE por CCAA</li></a>
                                <?php else: ?>
                                    <li>Batería Exámenes Finales: TBE 800 preguntas</li>
                                    <li>Simulacros oficiales TBE por CCAA</li>
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




    