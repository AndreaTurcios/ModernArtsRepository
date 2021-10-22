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
            class combo{ 
             public static function comboCategoria(){
                $bodega = new VerProductos;
                    if ($data = $bodega->comboCategorias()){
                    $result['status'] = 1;
                    foreach($data as $data){
                        print( '<option value="'.$data["id_categoria"].'">'.$data["categoria"].'</option>');
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
    } else {
        print(json_encode('Recurso no disponible'));
    }
}
?>