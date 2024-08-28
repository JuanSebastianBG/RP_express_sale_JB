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

    <form action="controlador/cerrar_sesion.php" method="post">
        <input type="submit" value="Cerrar sesión">
    </form>
</body>
</html>