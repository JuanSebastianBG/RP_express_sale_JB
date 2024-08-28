<?php
    function login($usuario_alias, $usuario_contra) {
        require 'conexion.php';

        $sql = 'SELECT * FROM usuarios WHERE usuario_alias = :usuario';
        $consulta = $conn->prepare($sql);
        $consulta->bindValue(':usuario', $usuario_alias);
        $consulta->execute();
        $user = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['usuario_contra'] == md5($usuario_contra)) {
                $_SESSION['usuario_id'] = $user['usuario_id'];
                return $_SESSION['usuario_id'];
            } else {
                echo 'La contraseña no coincide';
                return false;
            }
        } else {
            echo 'El usuario no se encuentra';
            return false;
        }
    }

    function getInfo($usuario_id){
        require 'conexion.php';

        if (isset($usuario_id)) {
            
            $consulta_session = $conn->prepare("SELECT * FROM usuarios WHERE usuario_id = :usuario_id ;");
            $consulta_session->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $consulta_session->execute();
            $usuario = $consulta_session->fetch(PDO::FETCH_ASSOC);
            
            if ($usuario) {
                return $usuario;  // Retorna la información del usuario
            }
            return null;
        }
    }

    function registrar_producto($producto_nombre, $producto_descripcion, $producto_cantidad, $producto_precio, $producto_imagen_url, $usuario_id, $categoria_id){
        

        $sql = "INSERT INTO productos(producto_nombre, producto_descripcion, producto_cantidad, producto_precio, producto_imagen_url, usuario_id, categoria_id) 
        VALUES (':producto_nombre',':producto_descripcion',':producto_cantidad',':producto_precio',':producto_imagen_url','usuario_id','categoria_id')";
    }

?>