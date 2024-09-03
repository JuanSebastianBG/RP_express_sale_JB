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

    function registrar_producto($nombre_producto, $producto_descripcion, $producto_cantidad, $producto_precio, $file, $usuario_id, $categoria_id){ 
    
        require 'conexion.php';
    
        $sql = ("INSERT INTO productos(producto_nombre, producto_descripcion, producto_cantidad, producto_precio, producto_imagen_url, usuario_id, categoria_id) 
        VALUES (:producto_nombre, :producto_descripcion, :producto_cantidad, :producto_precio, :producto_imagen_url, :usuario_id, :categoria_id)"); 
        $stmt = $conn->prepare($sql);
    
        $stmt->bindValue(':producto_nombre', $nombre_producto);
        $stmt->bindValue(':producto_descripcion', $producto_descripcion);
        $stmt->bindValue(':producto_cantidad', $producto_cantidad);
        $stmt->bindValue(':producto_precio', $producto_precio);
        $stmt->bindValue(':usuario_id', $usuario_id);
        $stmt->bindValue(':categoria_id', $categoria_id);
    
    
        $direccion = "../imagenes/";
        $ruta = $direccion.basename($file['name']);
    
        if($_FILES['file']['size']>0){
            if(move_uploaded_file($_FILES['file']['tmp_name'], $ruta)){
                $stmt->bindValue(':producto_imagen_url', $ruta);
                $stmt->execute(); // Ejecuta la consulta preparada
                return true;
            }else{
                return false;
            }
        }
    }


    function obtenerProductos($usuario_id){

        require 'conexion.php';

        $sql = "SELECT * FROM productos WHERE usuario_id = :usuario_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    function actualizar_producto($nombre_producto, $producto_descripcion, $producto_cantidad, $producto_precio, $file, $categoria_id){

        require 'conexion.php';
        
        $sql = ("UPDATE productos SET 
        producto_nombre = :producto_nombre, producto_descripcion = :producto_descripcion, producto_cantidad = :producto_cantidad, producto_imagen_url = :producto_imagen_url, producto_precio = :producto_precio, categoria_id = :categoria_id WHERE usuario_id = :usuario_id");

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':producto_nombre', $nombre_producto);
        $stmt->bindValue(':producto_descripcion', $producto_descripcion);
        $stmt->bindValue(':producto_cantidad', $producto_cantidad);
        $stmt->bindValue(':producto_precio', $producto_precio);
        $stmt->bindValue(':usuario_id', $_SESSION['usuario']['usuario_id']);
        $stmt->bindValue(':categoria_id', $categoria_id);
    

        $direccion = "../imagenes/";
        $ruta = $direccion.basename($_FILES['file']['name']);
    
        if($_FILES['file']['size']>0){
            if(move_uploaded_file($_FILES['file']['tmp_name'], $ruta)){
                $stmt->bindValue(':producto_imagen_url', $ruta);
                $stmt->execute();
                return true;
            }else{
                return false;
            }
        }
    
    }
    
    function eliminar_producto($producto_id){
        require 'conexion.php';
        $sql = "DELETE FROM productos WHERE producto_id = :producto_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':producto_id', $producto_id, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt){
            return true;
        }

        return false;

    }

    function obtenerProductosPP(){
        require 'conexion.php';

        $sql = "SELECT * FROM productos";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function registrarUsuario($nombre, $apellidos, $email, $telefono, $alias, $pass, $direccion){

        require 'conexion.php';

        $sql = 'INSERT INTO usuarios( usuario_nombre, usuario_apellido, usuario_correo, usuario_alias, usuario_telefono, usuario_direccion, usuario_contra) VALUES (:nombre,:apellidos,:email,:alias,:telefono,:direccion,:pass)';
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':apellidos', $apellidos);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':alias', $alias);
        $stmt->bindValue(':telefono', $telefono);
        $stmt->bindValue(':direccion', $direccion);
        $stmt->bindValue(':pass', md5($pass));
        $stmt->execute();

        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($registro){
            return true;
        }
        return null;
    }
?>