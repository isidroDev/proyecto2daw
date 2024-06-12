<?php

require_once 'conexion.php';
$link = conexion();

if ($_SESSION['email'] !== 'admin@tcaeintegral.com') {
    // Si el usuario no es admin@tcaeintegral.com, se redirige a la página de acceso
    header('Location: /preparadoratcae.php?m=acceso');
    exit();
}

$email = $_SESSION['email'];

// Obtener los datos de los usuarios y los cursos que han comprado

$consulta = "SELECT u.fecha_registro, u.email, u.nombre, u.apellidos, u.movil, c.nombre AS curso_nombre, m.nombre AS modulo_nombre, cp.precio AS precio_compra, cp.fecha_compra 
                FROM usuarios u 
                JOIN compras cp ON u.id = cp.usuario_id 
                JOIN cursos c ON cp.curso_id = c.curso_id 
                LEFT JOIN modulos m ON cp.modulo_id = m.modulo_id;";
$resultado = mysqli_query($link, $consulta);
?>

<div class="row">
    <div class="col-12">
        <h1 class="text-center">Usuarios y cursos matriculados</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Fecha de registro</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Móvil</th>
                    <th>Curso</th>
                    <th>Módulo</th>
                    <th>Precio de compra</th>
                    <th>Fecha de compra</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['fecha_registro'] . "</td>";
                    echo "<td>" . $fila['nombre'] . "</td>";
                    echo "<td>" . $fila['apellidos'] . "</td>";
                    echo "<td>" . $fila['email'] . "</td>";
                    echo "<td>" . $fila['movil'] . "</td>";
                    echo "<td>" . $fila['curso_nombre'] . "</td>";
                    echo "<td>" . $fila['modulo_nombre'] . "</td>";
                    echo "<td>" . $fila['precio_compra'] . "</td>";
                    echo "<td>" . $fila['fecha_compra'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>