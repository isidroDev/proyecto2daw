<?php
function conexion()
{
    $link = mysqli_connect("localhost", "root", "", "tcae_v1");
    if ($link) {
        return $link;
    } else {
        echo "Error conexion base de datos";
        exit;
    }
}

$link = conexion();
