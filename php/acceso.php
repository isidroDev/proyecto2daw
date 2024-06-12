
<?php
session_start();
require_once 'conexion.php';
$link = conexion();



// Buscar usuario con el correo proporcionado
$consulta = "SELECT * FROM usuarios WHERE email = ?";
$consulta_preparada = mysqli_prepare($link, $consulta);
mysqli_stmt_bind_param($consulta_preparada, "s", $_POST['email']);
mysqli_stmt_execute($consulta_preparada);


$resultado = mysqli_stmt_get_result($consulta_preparada);

// Verificar si se encontró un usuario
if (mysqli_num_rows($resultado) == 1) {
    $usuario = mysqli_fetch_assoc($resultado);

    // Verificar la contraseña
    if (password_verify($_POST['password'], $usuario['password'])) {
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['nombre'] = $usuario['nombre'];
        // Si el usuario es 'admin', redirigir a la página de administración
        if ($_POST['email'] == 'admin@tcaeintegral.com') {
            header("Location: /preparadoratcae.php?m=administracion");
        } else {
            header("Location: /preparadoratcae.php?m=area_usuario");
        }

        exit(); // Asegurar que el script se detenga después de la redirección
    } else {
        unset($_SESSION['email']); // Eliminar el email de la sesión si la contraseña es incorrecta
        header("Location: /preparadoratcae.php?m=acceso");
        // Mensaje de error si la contraseña es incorrecta que aparecerá en la página de acceso
        $_SESSION['mensaje'] = "Contraseña incorrecta!";
        exit();
    }
} else {
    header("Location: /preparadoratcae.php?m=acceso");
    // Mensaje de error si el usuario no existe
    $_SESSION['mensaje'] = "No existe ese email";
    unset($_SESSION['email']); //Eliminar el email de la sesión si el email es incorrecto
}

// Cerrar la consulta preparada y la conexión
mysqli_stmt_close($consulta_preparada);
mysqli_close($link);
?>