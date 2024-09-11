<?php
require 'controlador/procesos.php';
require_once 'controlador/funciones.php';
if (isset($_GET['search'])) {
    $productos = busqueda($_GET['search']);
} else {
    $productos = obtenerProductosPP();
}
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
?>

<!DOCTYPE html>
<html data-theme="retro" lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <div class="navbar bg-base-100 shadow-md mb-5">
        <div class="flex-1">
            <a class="btn btn-ghost normal-case text-xl">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <h1>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']['usuario_alias']); ?></h1>
                <?php else: ?>
                    <h1>Error: No hay usuario logueado o la sesión no está configurada correctamente</h1>
                <?php endif; ?>
            </a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <div class="dropdown dropdown-end">
                    <div class="indicator ">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <span class="badge badge-sm indicator-item"><?= count($carrito) ?></span>
                    </div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                        <?php if (empty($carrito)): ?>
                            <span class="text-lg font-bold">El carrito está vacío.</span>
                        <?php else: ?>
                            <?php foreach ($carrito as $item): ?>
                                <li>
                                    <a>
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <span class="text-lg font-bold"><?= $item['producto_nombre'] ?></span>
                                                <span class="text-info"><?= number_format($item['producto_precio']) ?> COP</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <li>
                                <form action="" method="post">
                                    <input type="hidden" name="formulario" value="vaciar_carrito">
                                    <button class="btn btn-outline" name="vaciar_carrito">Vaciar carrito</button>
                                </form>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <li>
                    <form action="controlador/cerrar_sesion.php" method="post">
                        <button type="submit" class="btn btn-outline btn-sm">Cerrar sesión</button>
                    </form>
                </li>
                <?php if (isset($_SESSION['usuario'])): ?>
                    <?php if ($_SESSION['usuario']['rol_id'] == 4): ?>
                        <li><a href="index.registro_productos.php" class="btn btn-outline btn-sm">Admin</a></li>
                    <?php elseif ($_SESSION['usuario']['rol_id'] == 3): ?>
                        <li><a href="domiciliario.php" class="btn btn-outline btn-sm">Domiciliario</a></li>
                    <?php elseif ($_SESSION['usuario']['rol_id'] == 2): ?>
                        <li><a href="vendedor.php" class="btn btn-outline btn-sm">Vendedor</a></li>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="text-red-500">No se ha iniciado sesión correctamente.</p>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container mx-auto mt-5 grid grid-cols-1 lg:grid-cols-4 gap-6">

        <!-- Left Column: Product List -->
        <div class="lg:col-span-3 space-y-4">
            <?php foreach ($productos as $index => $producto): ?>
                <div class="card card-side bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
                    <figure>
                        <img src="https://via.placeholder.com/150" alt="Imagen del producto" class="w-36 h-36 object-cover rounded-l-md" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title text-lg font-semibold"><?= htmlspecialchars($producto['producto_nombre']) ?></h2>
                        <p class="text-gray-600"><?= htmlspecialchars($producto['producto_descripcion']) ?></p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-neutral btn-sm" onclick="document.getElementById('my_modal_<?= $index ?>').showModal()">Ver completo</button>
                            <dialog id="my_modal_<?= $index ?>" class="modal">
                                <div class="modal-box">
                                    <h1 class="font-bold text-xl mb-2"><?= htmlspecialchars($producto['producto_nombre']) ?></h1>
                                    <p class="mb-1"><?= htmlspecialchars($producto['producto_descripcion']) ?></p>
                                    <p class="text-gray-700">Cantidad: <?= htmlspecialchars($producto['producto_cantidad']) ?></p>
                                    <p class="text-gray-700">Precio: $<?= htmlspecialchars($producto['producto_precio']) ?></p>

                                    <div class="modal-action">
                                        <form action="" method="post">
                                            <input type="hidden" name="formulario" value="anadir_carrito">
                                            <input type="hidden" name="producto_id" value="<?= htmlspecialchars($producto['producto_id']) ?>" />
                                            <button class="btn btn-primary" name="anadir_al_carrito">Añadir al carrito</button>
                                        </form>
                                        <form method="dialog">

                                            <button class="btn btn-sm">Cerrar</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Right Column: Search Box -->
        <div class="lg:col-span-1 bg-white p-6 rounded-md shadow-md">
            <h2 class="text-lg font-bold mb-4">Buscar Producto</h2>
            <form method="get" action="" class="space-y-4">
                <input type="text" name="search" placeholder="Buscar..." class="input input-bordered w-full" />
                <button type="submit" class="btn btn-primary w-full">Buscar</button>
            </form>
        </div>

    </div>

</body>

</html>