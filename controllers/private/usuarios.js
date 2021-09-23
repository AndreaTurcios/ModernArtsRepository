const API_USUARIOS = '../../api/usuarios.php?action=';

function openModal(){
    var Modalelem = document.getElementById('modal');
    var instance = M.Modal.init(Modalelem);
    instance.open();
    document.getElementById("modal-form").reset();
    document.getElementById('model-titel').innerHTML = "Agregar usuario";
};

function updateModal(id,name,last,email){
    var Modalelem = document.getElementById('modal');
    var instance = M.Modal.init(Modalelem);
    document.getElementById("modal-form").reset();
    document.getElementById('model-titel').innerHTML = "Actualizar usuario";
    document.getElementById('id').value = id;
    document.getElementById('name').value = name;
    document.getElementById('lastname').value = last;
    document.getElementById('email').value = email;
    instance.open();
    
    
};



document.getElementById('modal-form').addEventListener('submit', function (event) {
    event.preventDefault();
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    if (document.getElementById('id').value) {
        action = 'update';
    } else {
        action = 'create';
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
                    sweetAlert(1, response.message, 'usuarios.php');
                    
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

function buscar(){
    let action = null;
    console.log(document.getElementById('comboSearch').value);
    let combo = document.getElementById('comboSearch').value;
    switch(combo){
        case '1':
            action = 'nombre=';
            break;
        case '2':
            action = 'apellido=';
            break;
        case '3':
            action = 'email=';
            break;
        default:
            sweetAlert(2, 'Seleccione un metodo de busqueda.', null);    
    } 
    if(action != null){
        location.href = 'usuarios.php?'+action+ document.getElementById('buscar').value;
    }
}

function reset(idUser){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id', idUser);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    restUser(API_USUARIOS, data);
}

function deleteUser(idUser){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id', idUser);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    delateData(API_USUARIOS, data, 'usuarios.php');
}
