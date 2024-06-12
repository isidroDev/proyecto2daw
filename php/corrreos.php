<?php
// Conectar a la base de datos
require_once 'conexion.php';


// Obtener los datos del formulario
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$email = $_POST['email'];

// Insertar el nuevo usuario en la base de datos
$sql = "INSERT INTO usuarios (usuario, password, email) VALUES (?, ?, ?)";
$consulta_preparada = $conexion->prepare($sql);
$consulta_preparada->bind_param("sss", $usuario, $password, $email);

if ($consulta_preparada->execute()) {
    // Enviar el correo electrónico
    $para = $email;
    $asunto = "Registro exitoso";
    $mensaje = "Hola $usuario,\n\nTu registro se realizó correctamente. Aquí están tus datos de inicio de sesión:\n\nUsuario: $usuario\nContraseña: $password\n\nSaludos,\nEl equipo de Tu Sitio Web";
    $cabeceras = "From: noreply@tusitioweb.com";

    if (mail($para, $asunto, $mensaje, $cabeceras)) {
        echo "Registro exitoso. Se ha enviado un correo electrónico con tus datos de inicio de sesión.";
    } else {
        echo "Registro exitoso, pero no se pudo enviar el correo electrónico con los datos de inicio de sesión.";
    }
} else {
    echo "Error: " . $consulta_preparada->error;
}

$consulta_preparada->close();
$conexion->close();
?>


<!-- REQUIERE PHPMAILER U OTRO SIMILAR-->