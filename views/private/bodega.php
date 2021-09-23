<?php
    //Incluye las clases de plantillas
    include_once('../../template/private/resourcesPage.php');
    include_once('../../api/private/tableApi.php');
    include_once('../../api/private/comboApi.php');
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
                        <h2 class="header mrg">Bodega</h2>
                        <a onClick="openModal();" class="modal-trigger waves-effect waves-light btn"><i class="material-icons left">add</i>Nuevo</a>
                        <table class="responsive-table highlight">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nombre Producto</th>
                                    <th>Descripción</th>
                                    <th>Categoria</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Img</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    table::tableBodega();
                                ?>
                            </tbody>
                        </table>
                        
                        <!-- Modal Structure -->
                        <div id="modal" class="modal">
                            <div class="modal-content">
                                <div class="row">
                                    <h4 id="model-titel"></h4>
                                    <p>formulario de productos.</p>
                                    <form id="modal-form" class="col s12" enctype="multipart/form-data">
                                        <div class="row">
                                            <input class="hide" type="number" name="id" id="id"/>
                                            <div class="input-field row">
                                                <i class="material-icons prefix">account_circle</i>
                                                <input id="name"  name= "name" type="text" class="validate" value="" placeholder="Nombre" required>
                                            </div>
                                            <div class="input-field row">
                                                <select class="browser-default" id="categoria" name="categoria">
                                                    <option value="00" disabled selected>Categorias</option>
                                                    <?php
                                                        combo::comboCategoria();
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="input-field row">
                                                <i class="material-icons prefix">chat_bubble</i>
                                                <input id="desc" name= "desc" type="text" class="validate" value="" placeholder="Descripcción" required>
                                            </div>
                                            <div class="input-field row">
                                                <i class="material-icons prefix">monetization_on</i>
                                                <input id="precio" name= "precio" type="text" class="validate" value="" placeholder="Precio" required>
                                            </div>
                                            <div class="input-field row">
                                                <i class="material-icons prefix">local_grocery_store</i>
                                                <input id="stock" name= "stock" type="text" class="validate" value="" placeholder="stock" required>
                                            </div>
                                            <div class="row">
                                                <label>Materialize File Input</label>
                                                <div class = "file-field input-field">
                                                    <div class="btn">
                                                        <span>Browse</span>
                                                        <input type="file" name="img">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text"  placeholder="Upload file">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                                    <i class="material-icons right">send</i>
                                                </button>
                                            </div>
                                        </div>
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

    </div>
</main>    
<?php
    //Imprimir el pie, se envia el nombre de la pagina actual=controlador
    page::scriptTemplate('bodega');
?>