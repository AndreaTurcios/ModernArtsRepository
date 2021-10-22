<?php
    // Incluye las clases de plantillas
    include_once('../../template/private/resourcesPage.php');
    // Imprimir el header se envia el nombre de la pagina actual=titulo
    page::headerTemplate('inicio');
?>
<main>
    <div class="container-fluid">
        <?php
            page::menuTemplate();//funcion estatica llamada desde resourcesPage, se utiliza para imprimir el menu en la pagina
        ?>
        <div class="contenido">
            
            <div class="row">
                <div class="col s6">
                    <h3>Reportes</h3>
                    <div class="col s12 m7">
                        <div class="card horizontal">
                        <div class="card-stacked">
                            <div class="card-action">
                            <a href="../reports/pedidos.php" target="_blank" class="btn waves-effect amber tooltipped" data-tooltip="Reporte de pedidos"><i class="material-icons">assignment</i> </a>
                            Reporte de pedidos.
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col s12 m7">
                        <div class="card horizontal">
                        <div class="card-stacked">
                            <div class="card-action">
                            <a href="../reports/categoria.php" target="_blank" class="btn waves-effect amber tooltipped" data-tooltip="Reporte de categorias"><i class="material-icons">assignment</i></a>
                            Reporte de categoria.
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="col s12 m7">
                        <div class="card horizontal">
                        <div class="card-stacked">
                            <div class="card-action">
                            <a href="../reports/clientes.php" target="_blank" class="btn waves-effect amber tooltipped" data-tooltip="Reporte de clientes"><i class="material-icons">assignment</i></a>
                            Reporte Clientes.
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="col s12 m7">
                        <div class="card horizontal">
                        <div class="card-stacked">
                            <div class="card-action">
                            <a href="../reports/productos.php" target="_blank" class="btn waves-effect amber tooltipped" data-tooltip="Reporte de productos"><i class="material-icons">assignment</i></a>
                            Reporte productos.
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="col s12 m7">
                        <div class="card horizontal">
                        <div class="card-stacked">
                            <div class="card-action">
                            <a href="../reports/valoraciones.php" target="_blank" class="btn waves-effect amber tooltipped" data-tooltip="Reporte de valoraciones"><i class="material-icons">assignment</i></a>
                            Reporte de valoraciones.
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">   
                        <div class="text-center col-12 col-xs-12 col-sm-12 col-lg-6 col-xl-6 p-4 col-xxl-6">
                            <!-- Se muestra una gráfica de pastel con el porcentaje de productos por categoría -->
                            <canvas id="ProductoCategoria"></canvas>
                        </div>
            </div>
            <!-- Importación del archivo para generar gráficas en tiempo real. Para más información https://www.chartjs.org/ -->
            <script type="text/javascript" src="../../resources/js/chart.js"></script>
            <script type="text/javascript" src="../../controllers/graficos.js"></script>
            
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
    // Imprimir el pie, se envia el nombre de la pagina actual=controlador
    page::scriptTemplate('inicio');
?>