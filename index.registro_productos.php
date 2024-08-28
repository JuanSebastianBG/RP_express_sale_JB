<!-- index.registro_productos.php -->

<?php require 'controlador/procesos.php';  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de productos</title>
</head>
<body>
    <?php if(isset($_SESSION['usuario'])): ?>
        <p>Bienvenido usuario <?= $_SESSION['usuario']['usuario_alias'];?></p>
    <?php else: ?>
        <p>No se ha iniciado sesión correctamente.</p>
    <?php endif; ?>

    <form action="procesos.php" method="post">
        <input type="hidden" name="formulario" value="registro_productos">
        <input type="text" placeholder="Nombre del producto" name="nombre_producto">
        <input type="text" name="descripcion_producto" placeholder="Descripción del producto">
        <input type="number" placeholder="Cantidad del producto" name="cantidad_producto">
        <input type="number" placeholder="Precio del producto" name="precio_producto">
        <input type="file" placeholder="Imagen del producto" name="file">
        <input type="hidden" name="usuario_id" value="<?= $_SESSION['usuario']['usuario_id']; ?>">
        <input type="hidden" name="categoria_id" value="">
        <input type="submit" value="Registrar producto">
    </form>
    <form action="controlador/cerrar_sesion.php" method="post">
        <input type="submit" value="Cerrar sesión">
    </form>
</body>
</html>