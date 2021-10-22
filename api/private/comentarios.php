<?php
    require_once('../../template/database.php');
    require_once('../../template/validation.php');
    require_once('../../models/bodega.php');

    if( isset($_GET['action'])){
        session_start();
        $data = new VerProductos();
        $result = array('status' => 0, 'message' => null, 'exception' => null);
        // Punto 18 de la rúbrica, se autentica que el usuario haya iniciado sesión para poder ingresar a la api
        if(isset($_SESSION['idUser'])){
            switch($_GET['action']){
                case 'block':
                    if(isset($_POST['id'])){
                        if($data->bloqueo($_POST['id'])){
                            $result['status'] = 1;
                            $result['message'] = 'El comentario ha  sido bloqueado.';
                        }
                        else{
                            $result['exception'] = dataBase::getException();
                        }
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