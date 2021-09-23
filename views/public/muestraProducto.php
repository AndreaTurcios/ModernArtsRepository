<?php
    require_once('../../api/public/productos.php');
    require_once('../../template/public/resourcesPage.php'); 
    page::headerTemplate('muestraProducto');
?>

    <div class="container-fluid">
        <?php
            page::menuTemplate();
        ?> 
        <div class="contenedor">
            <?php
                table::showAllPorducto();
            ?>  
        </div>

        <div class="footer">
            <?php
                page::footerTemplate();
            ?> 
        </div>
    </div>

    <div class="fixed-action-btn direction-left">
        <a class="btn-floating btn-large" href="carrito.php">
            <i class="material-icons">add_shopping_cart</i>
        </a>
    </div>


    <!-- Modal Structure --> 
    <div id="modal" class="modal">
        <div class="modal-content">
            <form id="modal-form" class="col s12" enctype="multipart/form-data">
                <input type="hidden" name="id" id="idCa">
                <input type="hidden" name="precio" id="precioCa">
                <div class="row contenidoCompra">
                    <div  id="img" class="cn imagenProducto grey lighten-2">
                    </div>
                    <div class="cn textoProducto">
                        <div class="row">
                            
                            <div class="col s10 offset-s1">
                                <h1 id="nombre"></h1>
                                <p id="precio"></p>
                                <hr><br>
                                <p id="descripcion"></p>
                                <br>
                                <button class="btn waves-effect waves-light" type="submit" name="action">Agregar al carito
                                    <i class="material-icons right">add_circle</i>
                                </button>
                                <a href="#!" class="modal-close waves-effect waves-light btn red"><i class="material-icons right">clear</i>Cancelar</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
        page::scriptTemplate('productos');
    ?> 

</body>
</html>