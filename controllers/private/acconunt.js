/*El metodo sirve para manejar las funciones realcionadas con la session del usuario*/

//Establese la ruta conla Api
const ACCONUNTAPI = '../../api/acconuntApi.php?action=';

//funcion para cerrar sesion en los formularios.

function logOut(){
    swal({
        text: '¿Está seguro de cerrar la sesión?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        if (value) {
            fetch(ACCONUNTAPI + 'logOut', {
                method: 'get'
            }).then(function (request) {
                if (request.ok) {
                    request.json().then(function (response) {
                        if (response.status) {
                            sweetAlert(1, response.message, '../../index.php');
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
        } else {
            sweetAlert(4, 'Puede continuar con la sesión', null);
        }
    });
}