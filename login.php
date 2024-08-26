<?php
session_start();

$usuario_alias = $_POST['usuario_alias'];
$usuario_contraseña = $_POST['usuario_contraseña'];

require 'conexion.php';
$sql = 'SELECT usuario_id, usuario_alias, usuario_contraseña FROM usuarion WHERE usuario_alias = ?';
$consulta = $conn->prepare($sql);
$consulta->exec([$usuario_alias]);
$user = $consulta->fetch();

if ($user && password_verify($password, $user['usuario_contraseña'])) {
    // La contraseña es correcta, iniciar la sesión
    $_SESSION['user_id'] = $user['usuario_id'];
    $_SESSION['username'] = $user['usuario_alias'];
    header('Location: registro_productos.php');
    exit();
} else {
    echo 'Nombre de usuario o contraseña incorrectos.';
}

?>