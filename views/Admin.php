<?php 
require_once '../controllers/pageController.php';
require_once '../models/pageModel.php'; 
$productos = obtenerProductos();
?>

<!DOCTYPE html>
<html data-theme="retro" lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de productos</title>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <?php if (isset($_SESSION['usuario'])): ?>
            <div class="bg-gradient-to-r from-indigo-600 to-pink-500 text-white font-bold p-4 rounded-lg mb-4">
                Bienvenido usuario <?= htmlspecialchars($_SESSION['usuario']['usuario_alias']); ?>
            </div>
        <?php else: ?>
            <p class="text-red-500">No se ha iniciado sesión correctamente.</p>
        <?php endif; ?>

        <div class="bg-gradient-to-r from-indigo-600 to-pink-500 text-white font-bold p-4 rounded-lg mb-4">
            Registrar productos
            
        </div>
        

        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <!-- Modal Registrar Producto -->
            <button class="btn btn-primary" onclick="document.getElementById('modal_registrar').showModal()">Registrar producto</button>
            <form action="../models/closeSession.php" method="post">
                <input type="submit" value="Cerrar sesión" class="btn btn-secondary">
            </form>
            <dialog id="modal_registrar" class="modal">
                <div class="modal-box">
                    <form class="flex flex-col gap-4" action="controlador/procesos.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="formulario" value="registro_productos">
                        <input type="text" name="nombre_producto" placeholder="Nombre del producto" class="input input-bordered input-primary w-full" required>
                        <input type="text" name="descripcion_producto" placeholder="Descripción del producto" class="input input-bordered input-primary w-full" required>
                        <input type="number" name="cantidad_producto" placeholder="Cantidad del producto" class="input input-bordered input-primary w-full" required>
                        <input type="number" name="precio_producto" placeholder="Precio del producto" class="input input-bordered input-primary w-full" required>
                        <input type="file" name="file" class="file-input file-input-bordered file-input-primary w-full" required>
                        <input type="hidden" name="usuario_id_productos" value="<?= htmlspecialchars($_SESSION['usuario']['usuario_id']); ?>" required>
                        <select class="select select-bordered w-full" name="categoria_id">
                            <option value="1">Tecnología</option>
                            <option value="2">Comida</option>
                            <option value="3">Otros</option>
                        </select>
                        <input type="submit" value="Registrar producto" class="btn btn-primary">
                    </form>
                    <form method="dialog">
                        <button class="btn">Cerrar</button>
                    </form>
                </div>
            </dialog>
        </div>

        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Categoria</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($productos as $index => $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['producto_id']) ?></td>
                        <td><?= htmlspecialchars($producto['producto_nombre']) ?></td>
                        <td><?= htmlspecialchars($producto['producto_descripcion']) ?></td>
                        <td><?= htmlspecialchars($producto['producto_cantidad']) ?></td>
                        <td><?= htmlspecialchars($producto['producto_precio']) ?></td>
                        <td><img src="<?= htmlspecialchars($producto['producto_imagen_url']) ?>" alt="Imagen no encontrada"></td>
                        <td><?= htmlspecialchars($producto['producto_estado']) ?></td>
                        <td><?= htmlspecialchars($producto['producto_fecha']) ?></td>
                        <td><?= htmlspecialchars($producto['usuario_id']) ?></td>
                        <td><?= htmlspecialchars($producto['categoria_id']) ?></td>
                        <td>
                            <!-- Modal Eliminar Producto -->
                            <button class="btn btn-error" onclick="document.getElementById('modal_eliminar_<?= $index ?>').showModal()">Eliminar</button>
                            <dialog id="modal_eliminar_<?= $index ?>" class="modal">
                                <div class="modal-box">
                                    <label>¿Desea eliminar este producto?</label>
                                    <form action="controlador/procesos.php" method="post">
                                        <input type="hidden" name="formulario" value="eliminar_producto">
                                        <input type="hidden" name="producto_id" value="<?= htmlspecialchars($producto['producto_id']) ?>">
                                        <input type="submit" value="Eliminar" class="btn btn-error">
                                    </form>
                                    <div class="modal-action">
                                        <form method="dialog">
                                            <button class="btn">Cerrar</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>

                            <!-- Modal Actualizar Producto -->
                            <button class="btn btn-info" onclick="document.getElementById('modal_actualizar_<?= $index ?>').showModal()">Actualizar</button>
                            <dialog id="modal_actualizar_<?= $index ?>" class="modal modal-bottom sm:modal-middle">
                                <div class="modal-box">
                                    <form class="flex flex-col gap-4" action="controlador/procesos.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="formulario" value="actualizar_producto">
                                        <input type="hidden" name="producto_id" value="<?= htmlspecialchars($producto['producto_id']) ?>">
                                        <input type="text" name="nombre_producto" placeholder="Nombre del producto" class="input input-bordered input-primary w-full" required>
                                        <input type="text" name="descripcion_producto" placeholder="Descripción del producto" class="input input-bordered input-primary w-full" required>
                                        <input type="number" name="cantidad_producto" placeholder="Cantidad del producto" class="input input-bordered input-primary w-full" required>
                                        <input type="number" name="precio_producto" placeholder="Precio del producto" class="input input-bordered input-primary w-full" required>
                                        <input type="file" name="file" class="file-input file-input-bordered file-input-primary w-full" required>
                                        <select class="select select-bordered w-full" name="categoria_id">
                                            <option value="1">Tecnología</option>
                                            <option value="2">Comida</option>
                                            <option value="3">Otros</option>
                                        </select>
                                        <input type="submit" value="Actualizar producto" class="btn btn-primary">
                                    </form>
                                    <form method="dialog">
                                        <button class="btn">Cancelar</button>
                                    </form>
                                </div>
                            </dialog>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        
    </div>
</body>
</html>
