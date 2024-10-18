let totalPedido = 0;

function agregarProducto(nombre, precio, cantidad) {
    cantidad = parseInt(cantidad);
    if (cantidad > 0) {
        const item = `${nombre} - Cantidad: ${cantidad} - Precio: $${precio * cantidad}`;
        $('#resumen-pedido').append(`<li class="list-group-item">${item}</li>`);
        totalPedido += precio * cantidad;
        $('#total-pedido').text(totalPedido);
    }
}

function enviarPedido() {
    // Lógica para enviar el pedido
    alert('Pedido enviado');
}
