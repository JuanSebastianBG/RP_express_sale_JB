<!DOCTYPE html>
<html data-theme="retro" lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body class="flex justify-center items-center h-screen bg-gray-100">
    <div class="flex justify-between w-full max-w-4xl">
        <div class="text-right">
            <h1 class="text-4xl font-bold text-violet-700">Bienvenido a Express Sale</h1>
        </div>

        <div class="w-full max-w-md">
            <form action="controlador/procesos.php" method="post" class="bg-violet-600 p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-white mb-4">Iniciar sesión</h2>
                <input type="hidden" name="formulario" value="login">
                <input name="usuario_alias" type="text" placeholder="Usuario Alias" class="input input-bordered input-info w-full mb-4">
                <input name="usuario_contra" type="password" placeholder="Contraseña" class="input input-bordered input-info w-full mb-4">
                <input type="submit" value="Iniciar sesion" class="btn btn-active btn-secondary w-full">
            </form>

            <button class="btn mt-4" onclick="my_modal_1.showModal()">Registrarse</button>
            <dialog id="my_modal_1" class="modal">
                <div class="modal-box">
                    <form action="controlador/procesos.php" method="post" class="flex flex-col gap-4">
                        <input type="hidden" name="formulario" value="registrarUsuario" required>
                        <input type="text" name="nombre" placeholder="Nombre" class="input input-bordered input-info w-full" required>
                        <input type="text" name="apellidos" placeholder="Apellidos" class="input input-bordered input-info w-full" required>
                        <input type="email" name="email" placeholder="Email" class="input input-bordered input-info w-full" required>
                        <input type="number" name="telefono" placeholder="Teléfono" class="input input-bordered input-info w-full" required>
                        <input type="text" name="alias" placeholder="Alias" class="input input-bordered input-info w-full" required>
                        <input type="password" name="pass" placeholder="Contraseña" class="input input-bordered input-info w-full" required>
                        <input type="text" name="direccion" placeholder="Dirección" class="input input-bordered input-info w-full" required>
                        <input type="submit" value="Registrarse" class="btn btn-active btn-secondary w-full">
                    </form>
                    <div class="modal-action">
                        <form method="dialog">
                            <button class="btn">Cerrar</button>
                        </form>
                    </div>
                </div>
            </dialog>
        </div>
    </div>
</body>

</html>
