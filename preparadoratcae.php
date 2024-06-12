<?php

// Inicialización de configuraciones globales (menú y conexión a la base de datos)
session_start();
include 'php/menu.php';
include 'php/conexion.php';

// Verifica si se ha pasado el parámetro 'm'
if (isset($_GET['m'])) {
    // Sanitiza el parámetro para evitar inyecciones
    $module = htmlspecialchars($_GET['m']);
    
    // Mapea los nombres de módulos a sus ubicaciones correspondientes
    $modulesMap = [
        'inicio' => 'vistas/index.php',
        'acceso' => 'vistas/acceso_interfaz.php',
        'contacto'=> 'vistas/contacto.php',
        'cursos' => 'vistas/cursos.php',
        'area_usuario' => 'php/area_usuario.php',
        'registro' => 'vistas/registro_html.php',
        'administracion' => 'php/admin.php',
        'registrarse' => 'php/insertar_registro.php',
        'cursos/pruebas_libres' => 'cursos/pruebas_libres/pruebas_libres.php',
        'curso_completo' => 'cursos/pruebas_libres/modulos/curso_completo.php',
        'cursos/pruebas_libres/modulo_1'=> 'cursos\pruebas_libres\modulos\modulo_1.php',
        'cursos/pruebas_libres/modulo_2'=> 'cursos\pruebas_libres\modulos\modulo_2.php',
        'cursos/pruebas_libres/modulo_3'=> 'cursos\pruebas_libres\modulos\modulo_3.php',
        'cursos/pruebas_libres/modulo_4'=> 'cursos\pruebas_libres\modulos\modulo_4.php',
        'cursos/pruebas_libres/modulo_5'=> 'cursos\pruebas_libres\modulos\modulo_5.php',
        'cursos/pruebas_libres/modulo_6'=> 'cursos\pruebas_libres\modulos\modulo_6.php',
        'cursos/pruebas_libres/modulo_7'=> 'cursos\pruebas_libres\modulos\modulo_7.php',
        'cerrar' => 'php/cerrar_sesion.php',

    ];
    
    // Verifica si el módulo está en el mapa de módulos
    if (array_key_exists($module, $modulesMap)) {
        // Incluye el archivo correspondiente
        include($modulesMap[$module]);
    } else {
        echo "página no encontrada.";
    }
} else {
    echo "página no encontrada.";
}

?>

<!-- Enlace al CSS para que carge los estilos específicos en todas las páginas -->
<link rel="stylesheet" href="/css/custom.css">