<?php
    require_once('../template/database.php');
    require_once('../template/validation.php');
    require_once('../models/acconunt.php');

    if( isset($_GET['action'])){
        session_start();
        $dataUser = new dataUser();
        $result = array('status' => 0, 'message' => null, 'exception' => null);
        if(isset($_SESSION['idUser'])){
            switch($_GET['action']){
                case 'logOut':
                    if (session_destroy()) {
                        $result['status'] = 1;
                        $result['message'] = 'Sesión eliminada correctamente';
                    } else {
                        $result['exception'] = 'Ocurrió un problema al cerrar la sesión';
                    }
                    break;
                default:
                    $result['exception'] = 'Acción no disponible fuera de la sesión';
            }
        }
        else{
            switch($_GET['action']){

                case 'logOut2':
                    if (session_destroy()) {
                        $result['status'] = 1;
                        $result['message'] = 'Sesión eliminada por inactividad';
                    } else {
                        $result['exception'] = 'Ocurrió un problema al cerrar la sesión';
                    }
                    break;

            case 'logIn':
                $_POST = $dataUser->validateForm($_POST);
                    if ($dataUser->checkUser($_POST['user'])) {
                        if ($dataUser->checkPassword($_POST['password'],$_POST['user'])) {
                            $result['status'] = 1;
                            $_SESSION['tiempo_usuario'] = time();
                            $result['message'] = 'Autenticación correcta';
                            $_SESSION['idUser'] = $dataUser->getId();
                            $_SESSION['user'] = $dataUser->getName();
                            $_SESSION['tipo_empleado'] = $dataUser->getTipo_empleado();
                            $_SESSION['admin'] = true;
                        } else {
                            if (dataBase::getException()) {
                                $result['exception'] = dataBase::getException();
                            } else {
                                $result['exception'] = 'Clave incorrecta';
                            }
                        }
                    } 

                else if ($_POST['tipo'] == ''){
                    if ($dataUser->checkUserAlso($_POST['user'])) {
                        if ($dataUser->checkPasswordAlso($_POST['password'],$_POST['user'])) {
                            $result['status'] = 1;
                            $result['message'] = 'Autenticación correcta';
                            $_SESSION['idUser'] = $dataUser->getId();
                            $_SESSION['user'] = $dataUser->getName();
                        } else {
                            if (dataBase::getException()) {
                                $result['exception'] = dataBase::getException();
                            } else {
                                $result['exception'] = 'Clave incorrecta';
                            }
                        }
                    } else {
                        if (dataBase::getException()) {
                            $result['exception'] = dataBase::getException();
                        } else {
                            $result['exception'] = ' Usuario no existe';
                        }
                    }
                }
                break;
                // Punto 19 de la rúbrica, se crea la variable session time para verificar el tiempo que lleva un usuario en línea
                case 'sessionTime':
                    if((time() - $_SESSION['tiempo_usuario']) < 300){
                        $_SESSION['tiempo_usuario'] = time();
                    } else{
                       unset($_SESSION['idUser'], $_SESSION['user'], $_SESSION['tiempo_usuario']);
                        $result['status'] = 1;
                        $result['message'] = 'Se ha cerrado la sesión por inactividad'; 
                    }
                break;
                // Punto 17 de la rúbrica, 
                case 'getDevices':
                    if ($result['dataset'] = $dataUser->getDevices()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Usted no posee sesiónes registradas.';
                        }   
                    }
                    break;
                //
                case 'changePassword':
                    if ($dataUser->setId($_SESSION['idUser'])) {
                        $_POST = $dataUser->validateForm($_POST);
                        if ($_POST['clavempleado'] == $_POST['confclave']) {
                            if ($dataUser->setPassword($_POST['clavempleado'])) {
                                if ($dataUser->updateRowPassword()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Usuario modificado correctamente';
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = $dataUser->getPasswordError();
                            }
                        } else {
                            $result['exception'] = 'Claves diferentes';
                        }
                    } else {
                        $result['exception'] = 'Claves diferentes';
                    }
                    break;
                default:
                    $result['exception'] = 'Acción no disponible fuera de la sesión';
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