const API_BODEGA= '../../api/private/bodega.php?action=';
const API_CLIENTEE= '../../api/private/usuarios.php?action=';

document.addEventListener('DOMContentLoaded', function () {
    graficaProductoCategoria()
    graficaCliente()
});

function graficaProductoCategoria() {
    fetch(API_BODEGA + 'productoCategoria', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let categoria = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        categoria.push(row.categoria);
                        cantidad.push(row.cantidad);
                    });
                    // Se llama a la función que genera y muestra una gráfica de pastel en porcentajes. Se encuentra en el archivo components.js
                   // pieGraph('chart5',['inactivos','activos'], cantidad, 'Porcentaje de empleados por estado' );
                   donutGraph('ProductoCategoria',categoria, cantidad, 'Porcentaje de productos por categoría' );
                } else {
                    document.getElementById('ProductoCategoria').remove();
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
    }

    function graficaCliente() {
        fetch(API_CLIENTEE + 'GraficoCliente', {
            method: 'get'
        }).then(function (request) {
            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
            if (request.ok) {
                request.json().then(function (response) {
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                    if (response.status) {
                        // Se declaran los arreglos para guardar los datos por gráficar.
                        let estado_cliente = [];
                        let cantidad = [];
                        // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                        response.dataset.map(function (row) {
                            // Se asignan los datos a los arreglos.
                            estado_cliente.push(row.estado_cliente);
                            cantidad.push(row.cantidad);
                        });
                        // Se llama a la función que genera y muestra una gráfica de pastel en porcentajes. Se encuentra en el archivo components.js
                       // pieGraph('chart5',['inactivos','activos'], cantidad, 'Porcentaje de empleados por estado' );
                       donutGraph('ClienteEstado',estado_cliente, cantidad, 'Clientes por estado', 'Clientes por estado' );
                    } else {
                        document.getElementById('ClienteEstado').remove();
                        console.log(response.exception);
                    }
                });
            } else {
                console.log(request.status + ' ' + request.statusText);
            }
        }).catch(function (error) {
            console.log(error);
        });
}