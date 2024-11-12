const error = document.querySelector('#errorCantidad')
const form = document.querySelector('#addProductoForm')

form.addEventListener('submit', (e)=>{
    const cantidadInput = document.querySelector('#cantidadProducto')
    let cantidad = parseInt(cantidadInput.value)
    
    if(cantidad < 0){
        e.preventDefault();
        error.style.display = 'block';
    }else{
        error.style.display = 'none'
    }
})