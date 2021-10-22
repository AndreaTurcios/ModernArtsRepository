<?php
    require_once('../../template/database.php');
    require_once('../../template/validation.php');
    require_once('../../models/bodega.php');

    if( isset($_GET['action'])){
        session_start();
        $data = new VerProductos();
        $result = array('status' => 0, 'message' => null, 'exception' => null);
        if(isset($_SESSION['idUser'])){
            switch($_GET['action']){
                case 'create':
                    // Prevenir Cross Site Scripting (XSS). 
                    $_POST = $data->validateForm($_POST);
                    if($data->setName($_POST['name'])){
                        if($data->setDesc($_POST['desc'])){
                                if($data->setidCategoria($_POST['categoria'])){
                                    if($data->setPrecio($_POST['precio'])){
                                        if($data->setStock($_POST['stock'])){
                                            if (is_uploaded_file($_FILES['img']['tmp_name'])) {
                                                if ($data->setImagen($_FILES['img'])) {
                                                    if ($data->create(1)) {
                                                        $result['status'] = 1;
                                                        if ($data->saveFile($_FILES['img'], $data->getRuta(), $data->getImg())) {
                                                            $result['message'] = 'Producto creado correctamente';
                                                        } else {
                                                            $result['message'] = 'Producto creado pero no se guardó la imagen';
                                                        } 
                                                    } else {
                                                        $result['exception'] = dataBase::getException();
                                                    }
                                                } else {
                                                    $result['exception'] = $data->getImageError();
                                                }
                                            } 
                                            else{
                                                $result['exception'] = 'No se subio la imagen al servidor';
                                            }     
                                        }
                                        else{
                                            $result['exception'] = 'El stock del producto incorrecto';
                                        }  
                                    }
                                    else{
                                        $result['exception'] = 'El Precio del producto incorrecto';
                                    } 
                                }
                                else{
                                    $result['exception'] = 'La categoria del producto incorrecto';
                                }  
                        }
                        else{
                            $result['exception'] = 'La descripción del producto incorrecto';
                        } 
                    }
                    else{
                        $result['exception'] = 'El nombre del producto incorrecto';
                    }
                break;
                case 'productoCategoria':
                    if ($result['dataset'] = $data->productoCategoria()) {
                         $result['status'] = 1;
                    } else {
                         if (Database::getException()) {
                               $result['exception'] = Database::getException();
                         } else {
                               $result['exception'] = 'No hay datos registrados';
                         }
                    }						                    
                break;
                case 'comentarioEstadografico':
                    if ($result['dataset'] = $data->comentarioEstado()) {
                         $result['status'] = 1;
                    } else {
                         if (Database::getException()) {
                               $result['exception'] = Database::getException();
                         } else {
                               $result['exception'] = 'No hay datos registrados';
                         }
                    }						                    
                break;
                case 'ventaGrafico':
                    if ($result['dataset'] = $data->ventaGraph()) {
                         $result['status'] = 1;
                    } else {
                         if (Database::getException()) {
                               $result['exception'] = Database::getException();
                         } else {
                               $result['exception'] = 'No hay datos registrados';
                         }
                    }						                    
                break;
                case 'graphStock':
                    if ($result['dataset'] = $data->productosStock()) {
                         $result['status'] = 1;
                    } else {
                         if (Database::getException()) {
                               $result['exception'] = Database::getException();
                         } else {
                               $result['exception'] = 'No hay datos registrados';
                         }
                    }						                    
                break;
                case 'update':
                    // Prevenir Cross Site Scripting (XSS). 
                    $_POST = $data->validateForm($_POST);
                    if($data->setId($_POST['id'])){
                        if($data->setName($_POST['name'])){
                            if($data->setDesc($_POST['desc'])){
                                    if($data->setidCategoria($_POST['categoria'])){
                                        if($data->setPrecio($_POST['precio'])){
                                            if($data->setStock($_POST['stock'])){
                                                if (is_uploaded_file($_FILES['img']['tmp_name'])) {
                                                    if ($data->setImagen($_FILES['img'])) {
                                                        if ($data->updateImg(1)) {
                                                            $result['status'] = 1;
                                                            if ($data->saveFile($_FILES['img'], $data->getRuta(), $data->getImg())) {
                                                                $result['message'] = 'Producto actualizado correctamente';
                                                            } 
                                                            else {
                                                                $result['message'] = 'Producto actualizado pero no se guardó la imagen';
                                                            } 
                                                        } 
                                                        else {
                                                            $result['exception'] = dataBase::getException();
                                                        }
                                                    } 
                                                    else {
                                                        if ($data->update(1)) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Producto actualizado correctamente';
                                                        } else {
                                                            $result['exception'] = dataBase::getException();
                                                        }
                                                    }
                                                } 
                                                else{
                                                    if ($data->update(1)) {
                                                        $result['status'] = 1;
                                                        $result['message'] = 'Producto actualizado correctamente';
                                                    } 
                                                    else {
                                                        $result['exception'] = dataBase::getException();
                                                    }
                                                }     
                                            }
                                            else{
                                                $result['exception'] = 'El stock del producto incorrecto';
                                            }  
                                        }
                                        else{
                                            $result['exception'] = 'El Precio del producto incorrecto';
                                        } 
                                    }
                                    else{
                                        $result['exception'] = 'La categoria del producto incorrecto';
                                    }  
                            }
                            else{
                                $result['exception'] = 'La descripción del producto incorrecto';
                            } 
                        }
                        else{
                            $result['exception'] = 'El nombre del producto incorrecto';
                        }
                    }
                    else{
                        $result['exception'] = 'El id del producto incorrecto';
                    }
                break;
                case 'delete':
                    if($data->delete($_POST['id'])){
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
                case 'create':
                    // Prevenir Cross Site Scripting (XSS). 
                    $_POST = $data->validateForm($_POST);
                    if($data->setName($_POST['name'])){
                        if($data->setDesc($_POST['desc'])){
                                if($data->setidCategoria($_POST['categoria'])){
                                    if($data->setPrecio($_POST['precio'])){
                                        if($data->setStock($_POST['stock'])){
                                            if (is_uploaded_file($_FILES['img']['tmp_name'])) {
                                                if ($data->setImagen($_FILES['img'])) {
                                                    if ($data->create(1)) {
                                                        $result['status'] = 1;
                                                        if ($data->saveFile($_FILES['img'], $data->getRuta(), $data->getImg())) {
                                                            $result['message'] = 'Producto creado correctamente';
                                                        } else {
                                                            $result['message'] = 'Producto creado pero no se guardó la imagen';
                                                        } 
                                                    } else {
                                                        $result['exception'] = dataBase::getException();
                                                    }
                                                } else {
                                                    $result['exception'] = $data->getImageError();
                                                }
                                            } 
                                            else{
                                                $result['exception'] = 'No se subio la imagen al servidor';
                                            }     
                                        }
                                        else{
                                            $result['exception'] = 'El stock del producto incorrecto';
                                        }  
                                    }
                                    else{
                                        $result['exception'] = 'El Precio del producto incorrecto';
                                    } 
                                }
                                else{
                                    $result['exception'] = 'La categoria del producto incorrecto';
                                }  
                        }
                        else{
                            $result['exception'] = 'La descripción del producto incorrecto';
                        } 
                    }
                    else{
                        $result['exception'] = 'El nombre del producto incorrecto';
                    }
                break;
                case 'update':
                    // Prevenir Cross Site Scripting (XSS). 
                    $_POST = $data->validateForm($_POST);
                    if($data->setId($_POST['id'])){
                        if($data->setName($_POST['name'])){
                            if($data->setDesc($_POST['desc'])){
                                    if($data->setidCategoria($_POST['categoria'])){
                                        if($data->setPrecio($_POST['precio'])){
                                            if($data->setStock($_POST['stock'])){
                                                if (is_uploaded_file($_FILES['img']['tmp_name'])) {
                                                    if ($data->setImagen($_FILES['img'])) {
                                                        if ($data->updateImg(1)) {
                                                            $result['status'] = 1;
                                                            if ($data->saveFile($_FILES['img'], $data->getRuta(), $data->getImg())) {
                                                                $result['message'] = 'Producto actualizado correctamente';
                                                            } 
                                                            else {
                                                                $result['message'] = 'Producto actualizado pero no se guardó la imagen';
                                                            } 
                                                        } 
                                                        else {
                                                            $result['exception'] = dataBase::getException();
                                                        }
                                                    } 
                                                    else {
                                                        if ($data->update(1)) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Producto actualizado correctamente';
                                                        } else {
                                                            $result['exception'] = dataBase::getException();
                                                        }
                                                    }
                                                } 
                                                else{
                                                    if ($data->update(1)) {
                                                        $result['status'] = 1;
                                                        $result['message'] = 'Producto actualizado correctamente';
                                                    } 
                                                    else {
                                                        $result['exception'] = dataBase::getException();
                                                    }
                                                }     
                                            }
                                            else{
                                                $result['exception'] = 'El stock del producto incorrecto';
                                            }  
                                        }
                                        else{
                                            $result['exception'] = 'El Precio del producto incorrecto';
                                        } 
                                    }
                                    else{
                                        $result['exception'] = 'La categoria del producto incorrecto';
                                    }  
                            }
                            else{
                                $result['exception'] = 'La descripción del producto incorrecto';
                            } 
                        }
                        else{
                            $result['exception'] = 'El nombre del producto incorrecto';
                        }
                    }
                    else{
                        $result['exception'] = 'El id del producto incorrecto';
                    }
                break;
                case 'delete':
                    // Prevenir Cross Site Scripting (XSS). 
                    $_POST = $data->validateForm($_POST);
                    if($data->delete($_POST['id'])){
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
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Recurso no disponible'));
    }
?>