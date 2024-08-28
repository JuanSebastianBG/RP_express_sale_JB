<?php
session_start();
require 'conexion.php';
require 'funciones.php';

$usuario = null;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $usuario_alias = $_POST['usuario_alias'];
    $usuario_contra = $_POST['usuario_contra'];

    $usuario_id = login($usuario_alias, $usuario_contra); 
    

    if ($usuario_id) {
        $usuario = getInfo($usuario_id);
        if($usuario){
            $_SESSION['usuario'] = $usuario;
            header('Location: ../index.registro_productos.php');
            exit;
        }else{
            echo "Error al recolectar informacion";
        }
    } else {
        echo "Error en el inicio de sesión";
    }
}
?>