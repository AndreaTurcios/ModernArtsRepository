<?php
    require_once('../../template/database.php');
    require_once('../../template/validation.php');
    require_once('../../models/bodega.php');
    require_once('../../models/venta.php');
    
    require_once('../../models/detalle_venta.php');

    class table{  

        public static function tableComentario($p){
            $userMODEL = new VerProductos;
            if ($data = $userMODEL->readAllCometarios2($p)){
                foreach($data as $data){
                    print(
                        '
                        <div class="input-field col s12">
                            <input disabled value="'.$data["comentario"].'" id="disabled" type="text" class="validate">
                            <label for="nombre del usuario">'.$data["nombre_producto"].'</label>
                        </div>'
                    );
                }
            } else {
                if (dataBase::getException()) {
                    $result['exception'] = dataBase::getException();
                } else {
                    $result['exception'] = 'No hay usuarios registrados';
                }
            }
        }
        public static function showAllPorducto(){
            $userMODEL = new VerProductos;
            if ($data = $userMODEL->showProductoPublic()){ 
                $result['status'] = 1;
                foreach($data as $data){
                    $id = "'".$data["id_producto"]."'";
                    $nombre = "'".$data["nombre_producto"]."'";
                    $desc = "'".$data["descripcion"]."'";
                    $precio = "'".$data["precio_producto"]."'";
                    $img = "'".$data["imagen_producto"]."'";
                    print(
                        '<div class="row contenidoCompra">
                            <div class="cn imagenProducto grey lighten-2">
                                <img src="../../resources/img/productos/'.$data['imagen_producto'].'">
                            </div>
                            <div class="cn textoProducto">
                                <div class="row">
                                    <div class="col s10 offset-s1">
                                        <h1>'.$data['nombre_producto'].'</h1>
                                        <p>precio: $'.$data['precio_producto'].'</p>
                                        <hr><br>
                                        <p>'.$data['descripcion'].'</p>
                                        <br>
                                        <a class="waves-effect waves-light  btn" onClick="openModal('.$id.','.$nombre.','.$desc.','.$precio.','.$img.',);">Agregar al carito</a>
                                    </div>
                                </div> 
                                <div class="row">
                                    <form class="col s12">
                                        <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">mode_edit</i>
                                            <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
                                            <label for="icon_prefix2">comentario</label>
                                            <button class="btn waves-effect waves-light" type="submit" name="action">Agregar
                                            <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                        </div>');
                                        table::tableComentario($data["id_producto"]);
                    print(' </form>
                    </div>
                </div>
            </div>');
                    }
            } else {
                if (dataBase::getException()) {
                    $result['exception'] = dataBase::getException();
                } else {
                    $result['exception'] = 'No hay usuarios registrados';
                }
            }
            
        }
 
        public static function showAllCarrito(){
            $dataVenta = new VerVenta();
            $dataDetVenta = new VerDetalle();

            if(isset($_SESSION['idUser'])){
                if($dataVenta->ordenExist($_SESSION['idUser'])){
                    if($data = $dataDetVenta->readCarro($dataVenta->getId())){
                        foreach($data as $data){
                            print('
                                <tr>
                                    <td>'.$data['nombre_producto'].'</td>
                                    <td>$'.$data['total'].'</td>
                                    <td>
                                        <a class="btn-floating btn-Medium waves-effect waves-light red" onClick="eliminar('.$data['id_detalle_venta'].');">
                                            <i class="material-icons">close</i>
                                        </a>
                                    </td>
                                </tr>
                            ');
                        }
                    }
                    else{
                        $result['exception'] = dataBase::getException();
                    }
                }
                else{
                    print('
                        <tr>
                            <td>No hay productos registrados</td>
                        </tr> 
                    ');
                }
            }
            else{
                print('
                    <tr>
                        <td>Tienes que iniciar Session.</td>
                    </tr> 
                ');
            }
        }
    }
?>