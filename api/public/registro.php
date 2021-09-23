<?php
    //-- DATOS DE REQUERIDOS 
    //=================================
    require_once('../../template/database.php');
    require_once('../../template/validation.php');
    require_once('../../models/clientes.php');
    
    //-- CONSULTA DE DATOS DE API
    //=================================
    if( isset($_GET['action'])){
        session_start();
        $res = new registro();
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
                        $_POST = $res->validateForm($_POST);
                        if ($res->setNombre($_POST['name'])) {
                            if ($res->setApellido($_POST['apellido'],)) {
                                        if ($res->setCorreo($_POST['gmail'])) {
                                            if ($res->setUsuario($_POST['usuario'])) {
                                                //Este es el punto 6 de la rúbrica, aquí se confirma que ambas contraseñas coincidan
                                                if ($_POST['clave'] == $_POST['confclave']) {
                                                    if ($res->setClave($_POST['clave'])) {
                                                        if ($res->createRow()) {
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
                                        $result['exception'] = 'Usuario incorrecto';
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
                $result['exception'] = 'No ha iniciado sesion, inicia session para poder comprar un producto';
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
