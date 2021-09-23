<?php
    require_once('../../api/public/productos.php');
    require_once('../../template/public/resourcesPage.php');
    page::headerTemplate('- Inicio');
?>

    <div class="container-fluid">

        <?php
            page::menuTemplate();
        ?> 


        <div>
            <div class="parallax-container" id="inicio">
                <div class="parallax">
                    <img src="../../resources/img/bg.jpg">
                </div>
            </div>
            <div class="section white">
                <div class="row container">
                    <h2 class="header">ModernArts</h2>
                    <p class="grey-text text-darken-3 lighten-3">Una tienda en línea de las más completas que veras
                        sobre
                        artesanías, nos encantan las artesanías y nos
                        esforzamos en brindar los mejores productos, si tu también eres apacionad@ por el arte esta es tu
                        tienda.
                    </p>
                </div>
            </div>
            <div class="parallax-container">
                <div class="parallax"><img src="../../resources/img/bg2.jpg"></div>
            </div>
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

    <?php
        page::scriptTemplatePrivate('inicio');
    ?> 
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            M.AutoInit();
        });
    </script>

</body>

</html>