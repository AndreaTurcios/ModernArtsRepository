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
                        <h2 class="header mrg">Detalle Pedido</h2>
                        
                        <table class="responsive-table highlight">
                            <thead>
                                <tr>
                                    <th>id detalle venta</th>
                                    <th>estado pedido</th>
                                    <th>Nombre producto</th>
                                    <th>Cantidad</th>
                                    <th>total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    table::tableDetallePedido($_GET['action']);
                                ?>
                            </tbody>
                        </table>

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

</main>    
<?php
    //Imprimir el pie, se envia el nombre de la pagina actual=controlador
    page::scriptTemplate('bodega');
?>