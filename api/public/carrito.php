<?php
    //-- DATOS DE REQUERIDOS 
    //=================================
    require_once('../../template/database.php');
    require_once('../../template/validation.php');
    require_once('../../models/venta.php');
    require_once('../../models/detalle_venta.php');
    
    //-- CONSULTA DE DATOS DE API
    //=================================
    if( isset($_GET['action'])){
        session_start();
        $dataVenta = new VerVenta();
        $dataDetVenta = new VerDetalle();
        $result = array('status' => 0, 'message' => null, 'exception' => null, 'login' => null);
        if(isset($_SESSION['user'])){
            switch($_GET['action']){ 
                case 'add':
                    $_POST = $dataVenta->validateForm($_POST);
                    if($dataDetVenta->setidProducto($_POST['id'])){
                        if(isset($_SESSION['idUser'])){
                            if($dataVenta->ordenExist($_SESSION['idUser'])){
                                if($idOrden = $dataVenta->getId()){
                                    if($dataDetVenta->createDet($idOrden,$_POST['precio'],$_POST['id'])){
                                        $result['status'] = 1;
                                        $result['message'] = 'El articulo a sido agregado a tu carrito.';
                                    }
                                    else{
                                        $result['exception'] = dataBase::getException();
                                    }
                                }
                                else{
                                    $result['exception'] = 'Error al obtener el codigo de orden.';
                                }
                            }
                            else{
                                if($dataVenta->createOrden($_SESSION['idUser'])){
                                    if($idOrdenData1 = $dataVenta->ordenExist()){
                                        if($idOrden2 = $dataVenta->getId()){
                                            if($dataDetVenta->createDet($idOrden2,$_POST['precio'],$_POST['id'])){
                                                $result['status'] = 1;
                                                $result['message'] = 'El articulo a sido agregado a tu carrito.';
                                            }
                                            else{
                                                $result['exception'] = dataBase::getException();
                                            }
                                        }
                                        else{
                                            $result['exception'] = 'Error al obtener el codigo de orden.';
                                        }
                                    }
                                    else{
                                         $result['exception'] = 'Error al obtener el codigo de orden.';
                                    }
                                }
                                else{
                                    $result['exception'] = dataBase::getException();
                                }
                            }
                        }
                        else{
                            $result['exception'] = 'No ha iniciado sesion, inicia session para poder comprar un producto';
                        }
                    }
                    else{
                        $result['exception'] = 'Error al obtener el numero de articulo.';
                    }
                break;
                case 'delete':
                    $_POST = $dataDetVenta->validateForm($_POST);
                    if($dataDetVenta->delete($_POST['id'])){
                        $result['status'] = 1;
                        $result['message'] = 'El articulo a sido eliminado del carrito.';
                    }
                    else{
                        $result['exception'] = dataBase::getException();
                    }
                break;
                case 'send':
                    if(isset($_SESSION['idUser'])){
                        if($dataVenta->ordenExist($_SESSION['idUser'])){
                            if($dataVenta->updateEstado()){
                                $result['status'] = 1;
                                $result['message'] = 'La orden a sido finalizada.';
                            }
                            else{
                                $result['exception'] = dataBase::getException();
                            }
                        }
                    }
                    else{
                        $result['exception'] = 'No ha iniciado sesion, inicia session para poder comprar un producto';
                    }
                break;
                case 'addComentario':
                    if(isset($_SESSION['idUser'])){
                        if($dataVenta->crearComentario($_SESSION['idUser'],$_POST['id'],$_POST['comente'])){
                            if($dataVenta->updateEstado()){
                                $result['status'] = 1;
                                $result['message'] = 'La orden a sido finalizada.';
                            }
                            else{
                                $result['exception'] = dataBase::getException();
                            }
                        }
                    }
                    else{
                        $result['exception'] = 'No ha iniciado sesion, inicia session para poder comprar un producto';
                    }
                break;
                default:
                $result['exception'] = 'Acción especificada.';
            }
        }
        else{
            switch($_GET['action']){
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