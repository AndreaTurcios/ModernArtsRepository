const CARRITOAPI = '../../api/public/carrito.php?action=';

function openModal(id,nombre,desc,precio,img){
    var Modalelem = document.getElementById('modal');
    var instance = M.Modal.init(Modalelem);
    instance.open();
    document.getElementById("modal-form").reset();

    document.getElementById("idCa").value = id;
    document.getElementById("precioCa").value = precio;
    document.getElementById("nombre").innerHTML = nombre;
    document.getElementById("descripcion").innerHTML = desc;
    document.getElementById("precio").innerHTML = precio;
    document.getElementById("img").innerHTML="<img src=\"../../resources/img/productos/"+img+"\">";
};


//Metodos de envio de formulario.
document.getElementById('modal-form').addEventListener('submit', function (event) {
   
    event.preventDefault(); // Se evita recargar la página web después de enviar el formulario.
    fetch( CARRITOAPI  + 'add', {
        method: 'POST',
        body: new FormData(document.getElementById('modal-form'))
    }).then(function (request) {
        //Valida si la peticion es correcta de lo contrario muestra un error.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status == 1) {
                    sweetAlert(1, response.message, 'carrito.php');
                }
                 else {
                    sweetAlert(2,response.exception, null); 
                }
            });
        } else {    
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) { 
        console.log(error);
    });
}); 