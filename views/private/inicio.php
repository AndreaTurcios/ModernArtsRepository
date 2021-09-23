<?php
    //Incluye las clases de plantillas
    include_once('../../template/private/resourcesPage.php');
    //Imprimir el header se envia el nombre de la pagina actual=titulo
    page::headerTemplate('inicio');
?>
<main>
    <div class="container-fluid">
        <?php
            page::menuTemplate();//funcion estatica llamada desde resourcesPage, se utiliza para imprimir el menu en la pagina
        ?>
        <div class="contenido">
                
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
    page::scriptTemplate('inicio');
?>