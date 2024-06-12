<?php
session_start();
require_once 'conexion.php';
$link = conexion();

// Obtener el ID del curso desde la URL
$curso_id = isset($_GET['curso_id']) ? $_GET['curso_id'] : null;
$modulo_id = isset($_GET['modulo_id']) ? $_GET['modulo_id'] : null;

// Verificar si el usuario está logueado
if (!isset($_SESSION['email'])) {
    header('Location: /preparadoratcae.php?m=acceso');
    exit();
}

$email = $_SESSION['email'];


// Obtener el ID del usuario
$stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();

// Obtener el precio del curso
$stmt = $mysqli->prepare("SELECT precio FROM cursos WHERE id = ?");
$stmt->bind_param("i", $curso_id);
$stmt->execute();
$stmt->bind_result($precio_curso);
$stmt->fetch();
$stmt->close();

// Obtener el precio del módulo
$stmt = $mysqli->prepare("SELECT precio FROM modulos WHERE id = ?");
$stmt->bind_param("i", $modulo_id);
$stmt->execute();
$stmt->bind_result($precio_modulo);
$stmt->fetch();
$stmt->close();

$precio = $modulo_id ? $precio_modulo : $precio_curso;

// Insertar la compra en la base de datos
$stmt = $mysqli->prepare("INSERT INTO compras (usuario_id, curso_id, modulo_id, fecha_compra, precio) VALUES (?, ?, ?, NOW(), ?)");
$stmt->bind_param("iiid", $user_id, $curso_id, $modulo_id, $precio);
$stmt->execute();
$stmt->close();

$mysqli->close();

// Redirigir al usuario a su aula virtual
header("Location: /php/area_usuario.php");
exit();
?>