<?php

//cerrar_sesion.php
session_start(); // Iniciar la sesión
session_unset(); // Eliminar todas las variables de sesión
session_destroy(); // Destruir la sesión
header("Location: ../index.login.php"); // Redirigir a la página de inicio de sesión
exit;
?>