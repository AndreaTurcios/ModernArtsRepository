<?php
    //Incluye las clases de plantillas
    include_once('../../template/private/resourcesPage.php');
    include_once('../../api/private/tableApi.php');
    //Imprimir el header se envia el nombre de la pagina actual=titulo
    page::headerTemplate('inicio');
?>
<main>
    <div class="container-fluid">
        <?php
            page::menuTemplate();//funcion estatica llamada desde resourcesPage, se utiliza para imprimir el menu en la pagina
        ?>
        <div class="contenido">
            <div>
                <div class="section white"> 
                    <div class="row container">
                        <h2 class="header mrg">Usuarios</h2>
                        <a onClick="openModal();" class="modal-trigger waves-effect waves-light btn"><i class="material-icons left">add</i>Nuevo</a>
                        <form id="buscar-form" >
                            <div class="row">
                                <div class="col s12">
                                    <div class="input-field col s4">
                                        <select class="browser-default" name="action" id="comboSearch">
                                            <option value="" disabled selected>Selecciona el metodo de busqueda.</option>
                                            <option value="1">Nombre</option>
                                            <option value="3">Email</option>
                                            <option value="2">Apellido</option>
                                        </select>
                                    </div>
                                    <div class="input-field col s4">
                                        <input value="" id="buscar" type="text" class="validate" placeholder="Buscar">
                                    </div>
                                    <a onClick="buscar();" class="modal-trigger waves-effect waves-light btn"><i class="material-icons left">search</i>Buscar</a>
                                </div>
                            </div>
                        </form>
                        <table class="responsive-table highlight">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_GET)){
                                        if(isset($_GET['nombre'])){;
                                            table::tableUsuariosName("'".$_GET['nombre']."'");
                                        }
                                        else if(isset($_GET['apellido'])){
                                            table::tableUsuariosApe($_GET['apellido']);
                                        }
                                        else if(isset($_GET['email'])){
                                            table::tableUsuariosEmail($_GET['email']);
                                        }
                                        else{
                                            table::tableUsuarios();
                                        }
                                    }
                                    else{
                                        table::tableUsuarios();
                                    }
                                ?>
                            </tbody>
                        </table>
                        
                        <!-- Modal Structure -->
                        <div id="modal" class="modal">
                            <div class="modal-content">
                                <div class="row">
                                    <h4 id="model-titel"></h4>
                                    <p>formulario para agregar usuarios.</p>
                                    <form id="modal-form" class="col s12" enctype="multipart/form-data">
                                        <div class="row">
                                            <input class="hide" type="number" name="id" id="id"/>
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">account_circle</i>
                                                <input id="name"  name= "name" type="text" class="validate" value="" placeholder="Nombre" required>
                                            </div>
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">account_circle</i>
                                                <input id="lastname"  name= "lastname" type="text" class="validate" value="" placeholder="Apellido" required>
                                            </div>
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">email</i>
                                                <input id="email" name= "email" type="email" class="validate" value="" placeholder="Email" required>
                                            </div>
                                        </div>
                                        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <?php
                    page::footerTemplate();//funcion estatica llamada desde resourcesPage, se utiliza para imprimir el footer en la pagina
                ?>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn direction-left">
        <a class="btn-floating btn-large" href="../html/carrito.html">
            <i class="material-icons">add_shopping_cart</i>
        </a>
    </div>
</main>    
<?php
    //Imprimir el pie, se envia el nombre de la pagina actual=controlador
    page::scriptTemplate('usuarios');
?>