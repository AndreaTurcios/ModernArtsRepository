<?php
    require_once('../../api/public/productos.php');
    require_once('../../template/public/resourcesPage.php'); 
    page::headerTemplate('carrito');
?>

    <div class="container-fluid">
        <?php
            page::menuTemplate();
        ?> 
  
        <div class="contenido">
            <div>
                <div class="parallax-container">
                    <div class="imgbgjc">
                        <h1 class="himgjc">LISTADO DE COMPRAS.</h1>
                    </div>
                </div>
                <div class="section white">
                    <div class="row container">
                        <h2 class="header mrg">Productos en el carrito</h2>
                        <table class="responsive-table highlight">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>opciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    table::showAllCarrito();
                                ?>
                            </tbody>
                        </table>
                        <a class="waves-effect waves-light btn-large" onClick="send();">
                            <i class="material-icons left">shopping_basket</i>
                            Terminar Compra
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer">
                <?php
                    page::footerTemplate();
                ?> 
            </div>
        </div>
    </div>
    <div class="fixed-action-btn direction-left">
        <a class="btn-floating btn-large" href="carrito.php">
            <i class="material-icons">add_shopping_cart</i>
        </a>
    </div>

    <?php
        page::scriptTemplate('carrito');
    ?> 
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            M.AutoInit();
        });
    </script>

</body>

</html>