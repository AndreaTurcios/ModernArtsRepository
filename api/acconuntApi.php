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
            case 'logIn':
                if($_POST['tipo'] == 'app'){
                    if ($dataUser->checkUser($_POST['user'])) {
                        if ($dataUser->checkPassword($_POST['password'],$_POST['user'])) {
                            $result['status'] = 1;
                            $result['message'] = 'Autenticación correcta';
                            $_SESSION['idUser'] = $dataUser->getId();
                            $_SESSION['user'] = $dataUser->getName();
                            $_SESSION['admin'] = true;
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