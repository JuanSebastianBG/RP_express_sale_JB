
<!-- index.login.php -->

<!DOCTYPE html>
<html data-theme="retro" lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body class="flex justify-center items-center h-screen">
    <form action="controlador/procesos.php" method="post" class="bg-violet-600 w-fit  flex flex-col gap-4 p-5 rounded-lg">
        <input type="hidden" name="formulario" value="login">
        <input name="usuario_alias" type="text" placeholder="Usuario Alias" class="input input-bordered input-info w-full max-w-xs">
        <input name="usuario_contra" type="pass" placeholder="Contraseña" class="input input-bordered input-info w-full max-w-xs">
        <input type="submit" value="Enviar" class="btn btn-active btn-secondary">
    </form>
</body>
</html>