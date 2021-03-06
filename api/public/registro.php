<?php
    //-- DATOS DE REQUERIDOS 
    //=================================
    require_once('../../template/database.php');
    require_once('../../template/validation.php');
    require_once('../../models/clientes.php');
    require_once('../../models/acconunt.php');
    
    //-- CONSULTA DE DATOS DE API
    //=================================
    if( isset($_GET['action'])){
        session_start();
        $res = new registro();
        $acconunt = new dataUser();
        $result = array('status' => 0, 'message' => null, 'exception' => null, 'login' => null);
        if(isset($_SESSION['user'])){
            switch($_GET['action']){ 
                default:
                $result['exception'] = 'Acción especificada.';
            }
        }
        else{
            switch($_GET['action']){
                case 'add':
                        $_POST = $acconunt->validateForm($_POST);
                        if ($acconunt->setName($_POST['name'])) {
                            if ($acconunt->setLastName($_POST['apellido'],)) {
                                        if ($acconunt->setEmail($_POST['gmail'])) {
                                                //Este es el punto 6 de la rúbrica, aquí se confirma que ambas contraseñas coincidan
                                                if ($_POST['clave'] == $_POST['confclave']) {
                                                    if ($acconunt->setPassword($_POST['clave'])) {
                                                        if ($acconunt->register()) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Usuario registrado correctamente';
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }
                                            } else {
                                                //Aquí el mensaje para el punto 5
                                                $result['exception'] = 'Clave menor a 8 caracteres o No cumple con los requisitos de seguridad';
                                            }
                                        } else {
                                            $result['exception'] = 'Contraseñas no coinciden';
                                        }
                                } else {
                                    $result['exception'] = 'Correo incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Apellidos incorrectos';
                            }
                        } else {
                            $result['exception'] = 'Nombres incorrectos';
                        }
                    break;
                default:
                $result['exception'] = 'No ha iniciado sesión, inicia sesión para poder comprar un producto';
            }
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Recurso no disponible'));
    }
    

?>  
