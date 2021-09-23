<?php
    require_once('../../template/database.php');
    require_once('../../template/validation.php');
    require_once('../../models/bodega.php');

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
?>