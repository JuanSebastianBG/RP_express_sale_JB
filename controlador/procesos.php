<?php
session_start();
require 'conexion.php';
require 'funciones.php';

$usuario = null;

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['formulario'])){
        $formulario = $_POST['formulario'];

        if($formulario == 'login'){

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
        }elseif($formulario == 'registro_productos'){

            $nombre_producto = $_POST['nombre_producto'];
            $descripcion_producto = $_POST['descripcion_producto'];
            $cantidad_producto = $_POST['cantidad_producto'];
            $precio_producto = $_POST['precio_producto'];
            $file = $_POST['file'];
            $usuario_id = $_POST['usuario_id'];
            $categoria_id = $_POST['categoria_id'];

            $registrar_producto = registrar_producto($nombre_producto, $descripcion_producto, $cantidad_producto, $precio_producto, $file, $usuario_id, $categoria_id);



        }

    }

   
}
?>