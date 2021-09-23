<?php
    require_once('../../template/database.php');
    require_once('../../template/validation.php');
    require_once('../../models/acconunt.php');

    if( isset($_GET['action'])){
        session_start();
        $userData = new dataUser();
        $result = array('status' => 0, 'message' => null, 'exception' => null);
        if(isset($_SESSION['idUser'])){
            switch($_GET['action']){
                case 'create':
                    if($userData->setName($_POST['name'])){
                        if($userData->setLastName($_POST['lastname'])){
                            if($userData->setEmail($_POST['email'])){
                                if($userData->create()){
                                    $result['status'] = 1;
                                    $result['message'] = 'Usuario agregado correctamente.';
                                } 
                                else{
                                    $result['exception'] = dataBase::getException();
                                }
                            }
                            else{
                                $result['exception'] = 'Email del usuario incorrecto';
                            }
                        }
                        else{
                            $result['exception'] = 'Apellido del usuario incorrecto';
                        }
                    }
                    else{
                        $result['exception'] = 'Nombre del usuario incorrecto';
                    }
                    break;
                case 'update':
                    if($userData->setName($_POST['name'])){
                        if($userData->setLastName($_POST['lastname'])){
                            if($userData->setEmail($_POST['email'])){
                                if($userData->update($_POST['id'])){
                                    $result['status'] = 1;
                                    $result['message'] = 'Actualizado agregado correctamente.';
                                } 
                                else{
                                    $result['exception'] = dataBase::getException();
                                }
                            }
                            else{
                                $result['exception'] = 'Email del usuario incorrecto';
                            }
                        }
                        else{
                            $result['exception'] = 'Apellido del usuario incorrecto';
                        }
                    }
                    else{
                        $result['exception'] = 'Nombre del usuario incorrecto';
                    }
                    break;
                case 'reset':

                    if($userData->setId($_POST['id'])){
                        if($userData->reset()){
                            $result['status'] = 1;
                            $result['message'] = 'Usuario reiniciado correctamente.';
                        } 
                        else{
                            $result['exception'] = dataBase::getException();
                        }
                    }
                    else{
                        $result['exception'] = 'id del usuario incorrecto';
                    }
                    break;
                case 'delete':
                    if($userData->delete($_POST['id'])){
                        $result['status'] = 1;
                        $result['message'] = 'Usuario eliminado correctamente.';
                    }
                    else{
                        $result['exception'] = dataBase::getException();
                    }
                    break;
                default:
                    $result['exception'] = 'Acción no disponible fuera de la sesión';
            }
        }
        else{
            switch($_GET['action']){
                case 'delete':
                    if($userData->delete($_POST['id'])){
                        $result['status'] = 1;
                        $result['message'] = 'Usuario eliminado correctamente.';
                    }
                    else{
                        $result['exception'] = dataBase::getException();
                    }
                    break;

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