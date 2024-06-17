<?php
session_start();
require_once 'conexion.php';
$link = conexion();

// Comprobar si el correo electrónico ya está registrado
$consulta_email = "SELECT email FROM usuarios WHERE email = ?";
$consulta_preparada_email = mysqli_prepare($link, $consulta_email);
mysqli_stmt_bind_param($consulta_preparada_email, "s", $_POST['email']);
mysqli_stmt_execute($consulta_preparada_email);
$resultado_email = mysqli_stmt_get_result($consulta_preparada_email);

// Comprobar si el DNI ya está registrado
$consulta_dni = "SELECT dni FROM usuarios WHERE dni = ?";
$consulta_preparada_dni = mysqli_prepare($link, $consulta_dni);
mysqli_stmt_bind_param($consulta_preparada_dni, "s", $_POST['dni']);
mysqli_stmt_execute($consulta_preparada_dni);
$resultado_dni = mysqli_stmt_get_result($consulta_preparada_dni);

if (mysqli_num_rows($resultado_email) > 0) {
    $_SESSION['mensaje'] = "El correo electrónico ya está registrado";
    header("Location: /preparadoratcae.php?m=registro");
} elseif (mysqli_num_rows($resultado_dni) > 0) {
    $_SESSION['mensaje'] = "El DNI ya está registrado";
    header("Location: /preparadoratcae.php?m=registro");
} else {
       // Registrar, email, password_hash, fecha_registro, dni, comunidad_autonoma, nombre, apellidos y movil
    $consulta = "INSERT INTO usuarios (email, password, fecha_registro, dni, comunidad, nombre, apellidos, movil) VALUES (?, ?, NOW(), ?, ?, ?, ?, ?)";
    $consulta_preparada = mysqli_prepare($link, $consulta);
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($consulta_preparada, "sssssss", $_POST['email'], $hash, $_POST['dni'], $_POST['comunidad'], $_POST['nombre'], $_POST['apellidos'], $_POST['movil']);
    mysqli_stmt_execute($consulta_preparada);

    // Insertar si se ha realizado correctamente el registro
    if (mysqli_stmt_affected_rows($consulta_preparada) == 1) {
        $_SESSION['mensaje'] = "Usuario registrado correctamente, ya puedes iniciar sesión!";
    } else {
        $_SESSION['mensaje'] = "Error al registrar el usuario";
    }

    // Hacer que vuelva a la pantalla de login tras el registro
    header("Location: /preparadoratcae.php?m=inicio");

    // Cerrar la consulta preparada y la conexión
    mysqli_stmt_close($consulta_preparada);
}

mysqli_stmt_close($consulta_preparada_email);
mysqli_stmt_close($consulta_preparada_dni);
mysqli_close($link);
?>
