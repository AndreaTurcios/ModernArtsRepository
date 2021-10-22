// API de usuario
const API_LOGOUT = '../../api/acconuntApi.php?action=';

// Manejador de evento para detectar cuando la pagina cargue.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    //inactivityTime();
});

// Funcion para controlar la inactividad del usuario dentro del sistema
function inactivityTime () {
    // Atributo para almacenar el tiempo transcurrido
    var time;
    // Colocamos los eventos en los cuales se reseteara el contador 
    window.onload = resetTimer;
    document.onmousemove = resetTimer;
    document.onkeydown = resetTimer;
    document.onclick = resetTimer;     
    document.onkeydown = resetTimer;  
    // Colocamos que se reinicie el contador al utilizar el scroll del mouse
    document.addEventListener('scroll', resetTimer, true);

    // Creamos funcion para cerrar sesion en el sistema
    function logout() {
        // Hacemos peticion a la API con el metodo LogOut2 para cerrar sesion 
        fetch(API_LOGOUT + 'logOut2', {
            method: 'get'
        }).then(function (request) {
            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
            if (request.ok) {
                request.json().then(function (response) {
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                    if (response.status) {
                        // Mostramos mensaje de exito al usuario
                        sweetAlert(4, response.message, '../../index.php');
                    } else {
                        // Mostramos mensaje de error al usuario
                        sweetAlert(2, response.exception, null);
                    }
                });
            } else {
                console.log(request.status + ' ' + request.statusText);
            }
        }).catch(function (error) {
            // Mostramos error por medio de la consola
            console.log(error);
        });
    }

    // Creamos funcion para resetar el contador del timer 300000 (5 minutos)
    function resetTimer() {
        clearTimeout(time);
        time = setTimeout(logout, 300000);
    }
};