
<?php
    //clase para imprimir metodos o recursos que se repiten en la App
    class page{
        //metodo imprime el header
        public static function headerTemplate(){
            session_start();
            if(isset($_SESSION['user'])){
                header('Location: views/public/inicio.php');
            }
            else{
                print('
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <title>modernarts</title>
                    <meta charset="utf-8">
                    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                    <link type="text/css" rel="stylesheet" href="resources/css/materialize.min.css" media="screen,projection">
                    <linK href="resources/css/login.css" rel="stylesheet">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                    <body class="blue-grey lighten-5">
                ');
            }
        }
 
        //metodo para imprimir footer
        public static function scriptTemplate(){
            print('
                    <script type="text/javascript" src="resources/js/sweetalert.min.js"></script>
                    <script type="text/javascript" src="template/components.js"></script>
                    <script type="text/javascript" src="controllers/index.js"></script>
                    <script type="text/javascript" src="resources/js/materialize.min.js"></script>
                </body>
                </html>
            ');
        }
    }
?>