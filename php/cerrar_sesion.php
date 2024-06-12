<?php
session_start();

// Destruye todas las variables de la sesión.
$_SESSION = array();

// para destruir la sesión completamente, se borra también la cookie de la sesión.

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruye todas las variables de la sesión
session_destroy();

header('Location: preparadoratcae.php?m=acceso');
exit();
?>