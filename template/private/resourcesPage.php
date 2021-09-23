<?php
    //clase para imprimir metodos o recursos que se repiten en la App
    class page{
        //metodo imprime el header
        public static function headerTemplate($title){
            session_start();
            print(' 
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <title>modernarts</title>
                    <meta charset="utf-8">
                    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                    <link type="text/css" rel="stylesheet" href="../../resources/css/materialize.min.css" media="screen,projection">
    
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                    <body class="blue-grey lighten-5">
                ');
        }
        //metodo para imprimir menu en las vistas, este metodo se ella por medio de un funcion estatica, no se solicita un valor para esta funcion
        public static function menuTemplate(){
            print('
            <div class="nav-wrapper navbar-fixed">
                <nav class="blue-grey darken-4">
                    <a href="#" class="brand-logo">ModernArts</a>
                    <a href="#" data-target="responsive-nav" class="sidenav-trigger">
                        <i class="material-icons">menu</i>
                    </a>

                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                      
                        <li><a href="inicio.php">Inicio</a></li>
                        <li><a href="usuarios.php">Usuarios</a></li>
                        <li><a href="bodega.php">bodega</a></li>
                        <li><a href="pedidos.php">Pedidos</a></li>
                        <li><a href="comentarios.php">Comentarios</a></li>
                        <li><a onclick="logOut()" >cerrar session</a></li>
                    </ul>
                </nav>
            </div>
            <ul class="sidenav" id="responsive-nav">
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="usuarios.php">Usuarios</a></li>
                <li><a href="bodega.php">bodega</a></li>
                <li><a href="pedidos.php">Pedidos</a></li>
                <li><a href="comentarios.php">Comentarios</a></li>
                <li><a onclick="logOut()" >cerrar session</a></li>
            </ul>
            ');
        }

        //metodo para imprimir el footer en las vistas, este metodo se ella por medio de un funcion estatica, no se solicita un valor para esta funcion
        public static function footerTemplate(){
            print('
                <footer class="page-footer blue-grey darken-4">
                    <div class="container">
                        <div class="row">
                            <div class="col l6 s12">
                                <h5 class="white-text">Creadores</h5>
                                <p class="grey-text text-lighten-4">Este sitio fue creado por Juan Carlos Ardon Melara,
                                    Juan
                                    Guillermo Almendares Tores estudiantes del Instituto Tecnico Ricaldone
                                    de 3 año desarollo de software.
                                </p>
                            </div>
                            <div class="col l4 offset-l2 s12">
                                <h5 class="white-text">Contactenos:</h5>
                                <ul>
                                    <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
                                    <li><a class="grey-text text-lighten-3" href="#!">Instagram</a></li>
                                    <li><a class="grey-text text-lighten-3" href="#!">Twiter</a></li>
                                    <li><a class="grey-text text-lighten-3" href="#!">Youtube</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="footer-copyright">
                        <div class="container">
                            © 2021 Derechos restringidos
                            <a class="grey-text text-lighten-4 right" href="#!">Contacte con el creador</a>
                        </div>
                    </div>
                </footer>
            ');
        }
        //metodo para imprimir footer
        public static function scriptTemplate($controller){

            print('
                    <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
                    <script type="text/javascript" src="../../resources/js/materialize.min.js"></script>
                    <script type="text/javascript" src="../../controllers/private/'.$controller.'.js"></script>
                    <script type="text/javascript" src="../../controllers/private/app.js"></script>
                    <script type="text/javascript" src="../../template/components.js"></script>
                </body>
                </html>
            ');
        }


    }
?>