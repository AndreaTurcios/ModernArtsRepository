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
                    if($res->create($_POST['name'],$_POST['apellido'],$_POST['gmail'],$_POST['usuario'],$_POST['clave'])){
                        $result['status'] = 1;
                        $result['message'] = 'usuario creado exitosamentes';
                    }
                    else{
                        $result['exception'] = dataBase::getException();
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
