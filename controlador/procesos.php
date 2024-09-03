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
                    header('Location: ../index.PaginaPrincipal.php');
                    exit;
                }else{
                    echo "<script type='text/javascript'>
                            alert('Error al recolectar datos');
                            window.location.href = '../index.login.php';
                        </script>";
                }
            } else {
                echo "<script type='text/javascript'>
                            alert('Error en el inicio de sesion');
                            window.location.href = '../index.login.php';
                        </script>";
            }
        }elseif($formulario == 'registro_productos'){

            $nombre_producto = $_POST['nombre_producto'];
            $descripcion_producto = $_POST['descripcion_producto'];
            $cantidad_producto = $_POST['cantidad_producto'];
            $precio_producto = $_POST['precio_producto'];
            $file = $_POST['file'];
            $usuario_id = $_POST['usuario_id_productos'];
            $categoria_id = $_POST['categoria_id'];

            $registrar_producto = registrar_producto($nombre_producto, $descripcion_producto, $cantidad_producto, $precio_producto, $file, $usuario_id, $categoria_id);

            if($registrar_producto){
                echo "<script type='text/javascript'>
                        alert('El producto se registro correctamente');
                        window.location.href = '../index.registro_productos.php';
                    </script>";
            }
        }elseif($formulario == 'actualizar_producto'){

            $nombre_producto = $_POST['nombre_producto'];
            $descripcion_producto = $_POST['descripcion_producto'];
            $cantidad_producto = $_POST['cantidad_producto'];
            $precio_producto = $_POST['precio_producto'];
            $file = $_POST['file'];
            $categoria_id = $_POST['categoria_id'];

            $actualizar_producto = actualizar_producto($nombre_producto, $descripcion_producto, $cantidad_producto, $precio_producto, $file, $categoria_id);

            if($actualizar_producto){
                echo "<script type='text/javascript'>
                        alert('El producto se actualizo correctamente');
                        window.location.href = '../index.registro_productos.php';
                    </script>";
            }

        }elseif($formulario == 'eliminar_producto'){
            $producto_id = $_POST['producto_id'];

            $eliminar_producto = eliminar_producto($producto_id);

            if($eliminar_producto){
                echo "<script type='text/javascript'>
                        alert('El producto se elimino correctamente');
                        window.location.href = '../index.registro_productos.php';
                    </script>";
            }
        }else{
            echo "Error en el formulario";
        }

    }

   
}
?>