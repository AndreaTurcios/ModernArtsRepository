function passwordE() {
    
    var password1 = document.getElementById('pass1').value;
    var password2 = document.getElementById('pass2').value;

    if(password1 == password2){
        document.getElementById('regis').style.display = 'block';
    }
    else{
        document.getElementById('regis').style.display = 'none';
    }
}

document.getElementById('send-form').addEventListener('submit', function (event) {
   
    event.preventDefault(); // Se evita recargar la página web después de enviar el formulario.
    fetch( '../../api/public/registro.php?action=add', {
        method: 'POST',
        body: new FormData(document.getElementById('send-form'))
    }).then(function (request) {
        //Valida si la peticion es correcta de lo contrario muestra un error.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status == 1) {
                    sweetAlert(1, response.message, '../../?action=');
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