<?php
    require_once('../../template/database.php');
    require_once('../../template/validation.php');
    require_once('../../models/acconunt.php');
    require_once('../../models/bodega.php');
    require_once('../../models/detalle_venta.php');
    require_once('../../models/venta.php');
    class table{ 
 
        public static function tableUsuarios(){
            $userMODEL = new dataUser;
            if ($data = $userMODEL->readAll()){
                $result['status'] = 1;
                foreach($data as $data){
                    $name = "'".$data["nombre_admin"]."'";
                    $lasr = "'".$data["apellido_admin"]."'";
                    $email = "'".$data["correo_admin"]."'";
                    $id = "'".$data["id_usuario_administracion"]."'";
                    print(
                        '<tr>
                            <td>'.$data["nombre_admin"].'</td>
                            <td>'.$data["apellido_admin"].'</td>
                            <td>'.$data["correo_admin"].'</td>
                            <td>
                                <a onClick="updateModal('.$id.','.$name.','.$lasr.','.$email.');"class="btn-floating btn-Medium waves-effect waves-light yellow">
                                    <i class="material-icons">border_color</i>
                                </a>
                                <a onClick="reset('.$id.');" class="btn-floating btn-Medium waves-effect waves-light blue modal-trigger" href="#modal1">
                                    <i class="material-icons">autorenew</i>
                                </a>
                                <a onClick="deleteUser('.$id.');" class="btn-floating btn-Medium waves-effect waves-light red " href="#modal1">
                                    <i class="material-icons">close</i>
                                </a>
                            </td>
                        </tr>'
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
        public static function tableUsuariosName($name){
            $userMODEL = new dataUser;
            if ($data = $userMODEL->searchName($name)){
                $result['status'] = 1;
                foreach($data as $data){
                    $name = "'".$data["nombre_admin"]."'";
                    $lasr = "'".$data["apellido_admin"]."'";
                    $email = "'".$data["correo_admin"]."'";
                    $id = "'".$data["id_usuario_administracion"]."'";
                    print(
                        '<tr>
                            <td>'.$data["nombre_admin"].'</td>
                            <td>'.$data["apellido_admin"].'</td> 
                            <td>'.$data["correo_admin"].'</td>
                            <td>
                                <a onClick="updateModal('.$id.','.$name.','.$lasr.','.$email.');"class="btn-floating btn-Medium waves-effect waves-light yellow">
                                    <i class="material-icons">border_color</i>
                                </a>
                                <a onClick="reset('.$id.');" class="btn-floating btn-Medium waves-effect waves-light blue modal-trigger" href="#modal1">
                                    <i class="material-icons">autorenew</i>
                                </a>
                                <a onClick="deleteUser('.$id.');" class="btn-floating btn-Medium waves-effect waves-light red " href="#modal1">
                                    <i class="material-icons">close</i>
                                </a>
                            </td>
                        </tr>'
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

        public static function tableUsuariosApe($name){
            $userMODEL = new dataUser;
            if ($data = $userMODEL->searchApe($name)){
                $result['status'] = 1;
                foreach($data as $data){
                    $name = "'".$data["nombre_admin"]."'";
                    $lasr = "'".$data["apellido_admin"]."'";
                    $email = "'".$data["correo_admin"]."'";
                    $id = "'".$data["id_usuario_administracion"]."'";
                    print(
                        '<tr>
                            <td>'.$data["nombre_admin"].'</td>
                            <td>'.$data["apellido_admin"].'</td>
                            <td>'.$data["correo_admin"].'</td>
                            <td>
                                <a onClick="updateModal('.$id.','.$name.','.$lasr.','.$email.');"class="btn-floating btn-Medium waves-effect waves-light yellow">
                                    <i class="material-icons">border_color</i>
                                </a>
                                <a onClick="reset('.$id.');" class="btn-floating btn-Medium waves-effect waves-light blue modal-trigger" href="#modal1">
                                    <i class="material-icons">autorenew</i>
                                </a>
                                <a onClick="deleteUser('.$id.');" class="btn-floating btn-Medium waves-effect waves-light red " href="#modal1">
                                    <i class="material-icons">close</i>
                                </a>
                            </td>
                        </tr>'
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
        public static function tableUsuariosEmail($name){
            $userMODEL = new dataUser;
            if ($data = $userMODEL->searchEmail($name)){
                $result['status'] = 1;
                foreach($data as $data){
                    $name = "'".$data["nombre_admin"]."'";
                    $lasr = "'".$data["apellido_admin"]."'";
                    $email = "'".$data["correo_admin"]."'";
                    $id = "'".$data["id_usuario_administracion"]."'";
                    print(
                        '<tr>
                            <td>'.$data["nombre_admin"].'</td>
                            <td>'.$data["apellido_admin"].'</td>
                            <td>'.$data["correo_admin"].'</td>
                            <td>
                                <a onClick="updateModal('.$id.','.$name.','.$lasr.','.$email.');"class="btn-floating btn-Medium waves-effect waves-light yellow">
                                    <i class="material-icons">border_color</i>
                                </a>
                                <a onClick="reset('.$id.');" class="btn-floating btn-Medium waves-effect waves-light blue modal-trigger" href="#modal1">
                                    <i class="material-icons">autorenew</i>
                                </a>
                                <a onClick="deleteUser('.$id.');" class="btn-floating btn-Medium waves-effect waves-light red " href="#modal1">
                                    <i class="material-icons">close</i>
                                </a>
                            </td>
                        </tr>'
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
        public static function tableBodega(){
            $userMODEL = new VerProductos;
            if ($data = $userMODEL->readAll()){
                $result['status'] = 1;
                foreach($data as $data){
                    $name = "'".$data["nombre_producto"]."'";
                    $desc = "'".$data["descripcion"]."'";
                    $precio = "'".$data["precio_producto"]."'";
                    $img = "'".$data["imagen_producto"]."'";
                    $stock = "'".$data["stock"]."'";
                    $desc = "'".$data["descripcion"]."'";
                    $idCategoria = "'".$data["id_categoria"]."'";
                    $id = "'".$data["id_producto"]."'";
                    print(
                        '<tr>
                            <td>'.$data["id_producto"].'</td>
                            <td>'.$data["nombre_producto"].'</td>
                            <td>'.$data["descripcion"].'</td>
                            <td>'.$data["categoria"].'</td>
                            <td>$'.$data["precio_producto"].'</td>
                            <td>'.$data["stock"].'</td>
                            <td><img class="responsive-img" src="../../resources/img/productos/'.$data["imagen_producto"].'" alt=""></td>
                            <td>
                                <a onClick="updateModal('.$id.','.$name.','.$desc.','.$precio.','.$stock.','.$idCategoria.');" class="btn-floating btn-Medium waves-effect waves-light yellow">
                                    <i class="material-icons">autorenew</i>
                                </a>
                                <a onClick="deletaProduct('.$id.');" class="btn-floating btn-Medium waves-effect waves-light red " href="#modal1">
                                    <i class="material-icons">close</i>
                                </a>
                            </td>
                        </tr>'
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
        public static function tableComentario(){
            $userMODEL = new VerProductos;
            if ($data = $userMODEL->readAllCometarios()){
                $result['status'] = 1;
                foreach($data as $data){
                    print(
                        '<tr>
                            <td>'.$data["nombre_producto"].'</td>
                            <td>'.$data["comentario"].'</td>
                            <td>'.$data["usuario_cliente"].'</td>
                            <td>'.$data["estado"].'</td>
                            <td>
                                <a onClick="block('.$data["id_valoraciones"].');" class="btn-floating btn-Medium waves-effect waves-light red " href="#modal1">
                                    <i class="material-icons">close</i>
                                </a>
                            </td>
                        </tr>'
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
        public static function tableDetallePedido($id){
            $userMODEL = new VerDetalle;
            if ($data = $userMODEL->readAll($id)){
                $result['status'] = 1;
                foreach($data as $data){
                    
                    $id = "'".$data["id_detalle_venta"]."'";

                    print(
                        '<tr>
                            <td>'.$data["id_detalle_venta"].'</td>
                            <td>'.$data["estado_venta"].'</td>
                            <td>'.$data["nombre_producto"].'</td>
                            <td>'.$data["cantidad"].'</td>
                            <td>$'.$data["total"].'</td>
                            <td>
                            
                            </td>
                        </tr>'
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
        public static function tablePedido(){
            $userMODEL = new VerVenta;
            if ($data = $userMODEL->readAll()){
                $result['status'] = 1;
                foreach($data as $data){
                    print(
                        '<tr>
                            <td>'.$data["id_venta"].'</td>
                            <td>'.$data["nombre_cliente"].'</td>
                            <td>'.$data["estado_venta"].'</td>
                            <td>'.$data["fecha_venta"].'</td>
                            <td>
                                <a href="detallepedido.php?action='.$data["id_venta"].'" "class="btn-floating btn-Medium waves-effect waves-light yellow">
                                    <i class="material-icons">border_color</i>
                                </a>
                                <a onClick="send('.$data["id_venta"].');" class="btn-floating btn-Medium waves-effect waves-light blue modal-trigger" href="#modal1">
                                    <i class="material-icons">autorenew</i>
                                </a>
                            </td>
                        </tr>'
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
    }
?>