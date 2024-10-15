<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomar Pedido - Mi Primera Borrachera</title>
    <!-- Enlazando Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Archivo CSS externo -->
</head>
<body>
    <header class="bg-dark text-white text-center py-4">
        <h1>Tomar Pedido</h1>
    </header>
    
    <main class="container my-4">
        <h2>Mesa <span id="mesa-number"></span></h2>
        <h3 class="mt-4">Menú</h3>

        <div class="menu-category">
            <h4>Bebidas</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Agregar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cerveza</td>
                        <td>$10</td>
                        <td>
                            <input type="number" class="form-control" min="0" value="0" id="cantidad-cerveza">
                        </td>
                        <td>
                            <button class="btn btn-primary" onclick="agregarProducto('Cerveza', 10, document.getElementById('cantidad-cerveza').value)">Agregar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Cóctel de Frutas</td>
                        <td>$15</td>
                        <td>
                            <input type="number" class="form-control" min="0" value="0" id="cantidad-coctel">
                        </td>
                        <td>
                            <button class="btn btn-primary" onclick="agregarProducto('Cóctel de Frutas', 15, document.getElementById('cantidad-coctel').value)">Agregar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Refresco</td>
                        <td>$5</td>
                        <td>
                            <input type="number" class="form-control" min="0" value="0" id="cantidad-refresco">
                        </td>
                        <td>
                            <button class="btn btn-primary" onclick="agregarProducto('Refresco', 5, document.getElementById('cantidad-refresco').value)">Agregar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="menu-category">
            <h4>Comidas</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Agregar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Hamburguesa</td>
                        <td>$20</td>
                        <td>
                            <input type="number" class="form-control" min="0" value="0" id="cantidad-hamburguesa">
                        </td>
                        <td>
                            <button class="btn btn-primary" onclick="agregarProducto('Hamburguesa', 20, document.getElementById('cantidad-hamburguesa').value)">Agregar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Pasta al Pesto</td>
                        <td>$25</td>
                        <td>
                            <input type="number" class="form-control" min="0" value="0" id="cantidad-pasta">
                        </td>
                        <td>
                            <button class="btn btn-primary" onclick="agregarProducto('Pasta al Pesto', 25, document.getElementById('cantidad-pasta').value)">Agregar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Ensalada César</td>
                        <td>$15</td>
                        <td>
                            <input type="number" class="form-control" min="0" value="0" id="cantidad-ensalada">
                        </td>
                        <td>
                            <button class="btn btn-primary" onclick="agregarProducto('Ensalada César', 15, document.getElementById('cantidad-ensalada').value)">Agregar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="menu-category">
            <h4>Postres</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Agregar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Brownie</td>
                        <td>$7</td>
                        <td>
                            <input type="number" class="form-control" min="0" value="0" id="cantidad-brownie">
                        </td>
                        <td>
                            <button class="btn btn-primary" onclick="agregarProducto('Brownie', 7, document.getElementById('cantidad-brownie').value)">Agregar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Helado</td>
                        <td>$5</td>
                        <td>
                            <input type="number" class="form-control" min="0" value="0" id="cantidad-helado">
                        </td>
                        <td>
                            <button class="btn btn-primary" onclick="agregarProducto('Helado', 5, document.getElementById('cantidad-helado').value)">Agregar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3 class="mt-4">Resumen del Pedido</h3>
        <ul id="resumen-pedido" class="list-group mb-4"></ul>
        <h4>Total: $<span id="total-pedido">0</span></h4>
        <button type="button" class="btn btn-success" onclick="enviarPedido()">Enviar Pedido</button>
    </main>

    <footer class="bg-light text-center py-3">
        <p>&copy; 2024 Mi Primera Borrachera. Todos los derechos reservados.</p>
    </footer>

    <!-- Enlazando Bootstrap y jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script> <!-- Enlazando el archivo JS externo -->
</body>
</html>
