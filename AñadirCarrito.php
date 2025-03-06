<?php
    session_start();

    // Verificar si el usuario está logueado
    $usuarioLogueado = isset($_SESSION['usuario']);  // Esto verifica si la variable de sesión 'usuario' existe

?>