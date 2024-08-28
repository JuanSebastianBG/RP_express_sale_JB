
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
<body>
    <div class="flex w-full flex-col border-opacity-50">
        <form action="controlador/procesos.php" method="post" >
            <input name="usuario_alias" type="text" placeholder="Usuario Alias" class="input input-bordered input-secondary w-full max-w-xs">
            <input name="usuario_contra" type="pass" placeholder="Contraseña" class="input input-bordered input-secondary w-full max-w-xs">
            <input class="btn btn-outline" type="submit">
        </form>
    </div>
</body>
</html>