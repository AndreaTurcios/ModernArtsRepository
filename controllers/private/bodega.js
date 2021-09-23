const API_USUARIOS = '../../api/private/bodega.php?action=';
function openModal(){
    var Modalelem = document.getElementById('modal');
    var instance = M.Modal.init(Modalelem);
    instance.open();
    document.getElementById("modal-form").reset();
    document.getElementById('model-titel').innerHTML = "Agregar producto";
};

function updateModal(id,name,desc,precio,stock,categoria){
    var Modalelem = document.getElementById('modal');
    var instance = M.Modal.init(Modalelem);
    document.getElementById("modal-form").reset();
    document.getElementById('model-titel').innerHTML = "Actualizar producto";
    document.getElementById('id').value = id; 
    document.getElementById('name').value = name;
    document.getElementById('desc').value = desc;
    document.getElementById('precio').value = precio;
    document.getElementById('stock').value = stock;
    document.getElementById('categoria').value = categoria;
    instance.open();    
}; 

document.getElementById('modal-form').addEventListener('submit', function (event) {
    event.preventDefault();
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    if ('Agregar producto'== document.getElementById('model-titel').innerHTML) {
        action = 'create';
    } else {
        action = 'update';
    }

    fetch( API_USUARIOS  + action, {
        method: 'POST',
        body: new FormData(document.getElementById('modal-form'))
    }).then(function (request) {
        //Valida si la peticion es correcta de lo contrario muestra un error.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    sweetAlert(1, response.message, 'bodega.php');
                    
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

function reset(idUser){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id', idUser);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    restUser(API_USUARIOS, data);
}

function deletaProduct(idUser){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id', idUser);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    delateData(API_USUARIOS, data, 'bodega.php');
}
