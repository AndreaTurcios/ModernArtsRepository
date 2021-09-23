<?php
    //clase para imprimir metodos o recursos que se repiten en la App
    class page{
        //metodo imprime el header
        public static function headerTemplate($title){
            session_start();
            print('
                <!DOCTYPE html>
                        <head>
                            <title>ModernArts - '.$title.'</title>
                            <meta charset="utf-8">
                            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                            <link type="text/css" rel="stylesheet" href="../../resources/css/materialize.min.css" media="screen,projection" />
                            <link type="text/css" rel="stylesheet" href="../../resources/css/public/'.$title.'.css" />
                            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                        </head>
                        <body class="blue-grey lighten-5">
            ');

                 //Se obtiene el nombre del archivo de la página web actual.
                $filename = basename($_SERVER['PHP_SELF']);
                // Aquí se comprobaría si existe una sesión de administrador para mostrar el menú de opciones, pero como el menú es el mismo que el de clientes 
                //No se puede realizar.
                    // Se verifica si la página web actual es diferente a inicio.php (Iniciar sesión) y a register.php (Crear usuario) para no iniciar sesión otra vez, de lo contrario se direcciona a main.php
                        if ($filename != 'registrar.php') {
                            //Encabezado del documento
                            print('
                           
                            ');   
        }
    }

    public static function menuTemplate(){

        if(isset($_SESSION['user'])){
            $button = '<li><a onClick="logOut()" ">Cerrar Sesión</a></li>';
            $btnmodal = '<li><a href="#" onclick="changePassword()"><i class="material-icons left">key</i>Cambiar contraseña</a></li>';
        }
        else{
            $button = '<li><a href="../../?action=">Iniciar Sesión</a></li>';
        }
        if(isset($_SESSION['admin'])){
            $app = '<li><a href="../private/inicio.php" ">App</a></li>';
        }
        else{
            $app = '';
        }
        print('
        <div class="nav-wrapper navbar-fixed">
        <nav class="blue-grey darken-4">
            <a href="#" class="brand-logo">ModernArts</a>
            <a href="#" data-target="responsive-nav" class="sidenav-trigger">
                <i class="material-icons">menu</i>
            </a>

            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="inicio.php">Inicio</a></li>
                <li><a href="muestraProducto.php">Productos</a></li>
                '.$btnmodal.'
                '.$button.'
                '.$app.'
            </ul>
        </nav>
    </div>
    <ul class="sidenav" id="responsive-nav">
        <li><a href="../html/index.html">Inicio</a></li>
        <li><a href="muestraProducto.php">Productos</a></li>
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
                <script type="text/javascript" src="../../controllers/public/'.$controller.'.js"></script>
                <script type="text/javascript" src="../../controllers/public/global.js"></script>
                <script type="text/javascript" src="../../template/components.js"></script>
                </body>
                </html>
            ');
        }
        
        private static function modals()
        {
            // Se imprime el código HTML de las cajas de dialogo (modals).
            print('
               
                <div id="password-modal" class="modal">
                    <div class="modal-content">
                        <h4 class="center-align">Cambiar contraseña</h4>
                        <form method="post" id="password-form">
                            <div class="row center-align">
                                <label>CLAVE NUEVA</label>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">security</i>
                                    <input id="clave_nueva_1" type="password" name="clave_nueva_1" class="validate" required/>
                                    <label for="clave_nueva_1">Clave</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <i class="material-icons prefix">security</i>
                                    <input id="clave_nueva_2" type="password" name="clave_nueva_2" class="validate" required/>
                                    <label for="clave_nueva_2">Confirmar clave</label>
                                </div>
                            </div>
                            <div class="row center-align">
                                <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                            </div>
                        </form>
                    </div>
                </div>
            ');
    } 

    }

    
?>