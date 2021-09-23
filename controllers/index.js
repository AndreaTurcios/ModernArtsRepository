// establese la ruta de comunicacion con la API
const ACCOUNTAPI = 'api/acconuntApi.php?action=';

//Metodos de envio de formulario.
document.getElementById('loginForm').addEventListener('submit', function (event) {
   
    event.preventDefault(); // Se evita recargar la página web después de enviar el formulario.
    fetch( ACCOUNTAPI  + 'logIn', {
        method: 'POST',
        body: new FormData(document.getElementById('loginForm'))
    }).then(function (request) {
        //Valida si la peticion es correcta de lo contrario muestra un error.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    sweetAlert(1, response.message, 'views/public/inicio.php');
                    
                } else {
                    sweetAlert(2, response.exception, null);
                    
                }
            });
        } else {    
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) { 
        console.log(error);
    });
});