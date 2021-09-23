<?php 
    class VerVenta extends validation{
        private $id = null;
        static $idZZ = null;
        private $idCliente = null;
        private $idEstado_venta = null;
        private $fechaVenta = null;

        //SET
        public function getRuta(){
            return $this->ruta;
        }

        public function setId($value){
            if($this->validateNaturalNumber($value)){ 
                $this->id = $value;
                return true;
            }
            else{
                return false; 
            }
        }
        public function setCliente($value){
            if($this->validateAlphabetic($value, 1,50)){ 
                $this->idCliente = $value;
                return true;
            }
            else{
                return false;
            }
        }
        public function setIdEstado_venta($value){
            if ($this->validateAlphabetic($value, 1, 50)) {
                $this->idEstado_venta = $value;
                return true;
            } else {
                return false;
            }
        }
        public function setFechaVenta($value){
            if($value != null){
                $this->fechaVenta = $value;
                return true;
            }
            else{
                return false;
            }
        }
        //GET
        public function getId(){
            return $this->id;
        }

        public function getCliente(){
            return $this->idCliente;
        }
        public function getIdEstado_venta(){
            return $this->idEstado_venta;
        }
        public function getFechaVenta(){
            return $this->fechaVenta;
        }

        //FUNCIONES

        public function readAll(){
            try{
                $sql = 'SELECT id_venta,nombre_cliente,estado_venta,fecha_venta from venta
                INNER JOIN clientes USING (id_cliente)
                WHERE estado_venta = ?';
                $params = array('pendiente');
                return dataBase::getRows($sql, $params);
            } catch (Exception $error){
                die("Error al obtener datos, bodega/Models: ".$error ->getMessage()); 
            }

        }

        public function update($idUser){
            try{
                $sql = 'UPDATE producto
                    SET id_venta = ?,id_cliente = ? ,estado_venta = ? ,fecha_venta = ?
                    WHERE id_producto = ?';
                $params = array($this->idCategoria, $this->nombre, $this->desc,$this->precios,$idUser,$this->stock,$this->id);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al update datos, acconunt/Models: ".$error ->getMessage()); 
            }
        }

        public function create($idUser){
            try{
                $sql = 'INSERT INTO  producto(id_venta,id_cliente,estado_venta,fecha_venta)
                VALUES(?,?,?,?)';
                $params = array($this->idCategoria, $this->nombre, $this->desc,$this->precios,$this->img,$idUser,$this->stock);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al update datos, acconunt/Models: ".$error ->getMessage()); 
            }
        }

        public function delete($idUser){
            try{
                $sql = 'DELETE FROM venta WHERE id_venta = ?';
                $params = array($idUser);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al delete datos, acconunt/Models: ".$error ->getMessage()); 
            }
        } 

        public function ordenExist($usario){
            try{
                $sql = 'SELECT id_venta FROM venta WHERE id_cliente = ? AND estado_venta = ?';
                $params = array($usario,'carrito');
                
                if($data = dataBase::getRow($sql, $params)){
                    $this->id = $data['id_venta'];
                    return true;
                }
                else {
                    return false;
                }
 
            } catch (Exception $error){

                die("Error al obtener datos, carrito/Model: ".$error ->getMessage()); 
            }
        }

        public function updateEstado(){
            try{
                $sql = 'UPDATE venta SET  estado_venta = ?
                WHERE id_venta = ?';
                $params = array('pendiente',$this->id);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al delete datos, acconunt/Models: ".$error ->getMessage()); 
            }
        }
        public function updateEstado2($S){
            try{
                $sql = 'UPDATE venta SET  estado_venta = ?
                WHERE id_venta = ?';
                $params = array('finalizada',$S);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al delete datos, acconunt/Models: ".$error ->getMessage()); 
            }
        }

        public function createOrden($usuario){
                try{
                    $fecha = date("Y").'-'.date("m").'-'.date("d") ;
                    $sql = 'INSERT INTO venta(id_cliente,estado_venta,fecha_venta)
                    VALUES (?,?,?)';
                    $params = array($usuario,'carrito',$fecha);
                    return dataBase::executeRow($sql, $params);
    
                } catch (Exception $error){
    
                    die("Error al obtener datos, carrito/Model: ".$error ->getMessage()); 
                }
        }

    }
?>