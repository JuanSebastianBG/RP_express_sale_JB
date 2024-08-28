
<!-- index.login.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="controlador/procesos.php" method="post">
        <input name="usuario_alias" type="text" placeholder="Usuario Alias">
        <input name="usuario_contra" type="pass" placeholder="Contraseña">
        <input type="submit">
    </form>
</body>
</html>