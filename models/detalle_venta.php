<?php
    class VerDetalle extends validation{
        private $id = null;
        private $idVenta = null;
        private $idProducto = null;
        private $precio  = null;
        //SET
        public function setId($value){
            if($this->validateNaturalNumber($value)){ 
                $this->id = $value;
                return true;
            }
            else{
                return false;
            }
        }
        public function setidVenta($value){
            if($this->validateAlphabetic($value, 1, 50)) {
                $this->idVenta = $value;
                return true;
            }
            else{
                return false;
            }
        }
        public function setidProducto($value){
            if ($this->validateNaturalNumber($value)) {
                $this->idProducto = $value;
                return true;
            } else {
                return false;
            }
        }
        public function setPrecio($value){
            if($value != null){
                $this->cantidad = $value;
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

        public function getidVenta(){
            return $this->idVenta;
        }
        public function getidProducto(){ 
            return $this->idProducto;
        }
        public function getCantidad(){
            return $this->cantidad;
        }

        public function Total(){
            return $this->total;
        }

        //FUNCIONES

        public function readAll($id){
            try{
                $sql = 'SELECT id_detalle_venta,estado_venta,nombre_producto,cantidad,total FROM detalle_venta
                INNER JOIN venta USING (id_venta)
                INNER JOIN producto USING (id_producto) 
                WHERE id_venta = ?';
                $params = array($id);
                return dataBase::getRows($sql, $params);
            } catch (Exception $error){
                die("Error al obtener datos, bodega/Models: ".$error ->getMessage()); 
            }

        }

        public function readCarro($id){
            try{
                $sql = 'SELECT v.id_detalle_venta,p.nombre_producto,v.total
                FROM detalle_venta v ,producto p
                WHERE v.id_producto = p.id_producto AND v.id_venta = ?';
                $params = array($id);
                return dataBase::getRows($sql, $params);
            } catch (Exception $error){
                die("Error al obtener datos, bodega/Models: ".$error ->getMessage()); 
            }

        }


        public function update($idUser){
            try{
                $sql = 'UPDATE producto
                    SET id_categoria = ? , nombre_producto = ? , descripcion = ? , precio_producto = ?,id_usuario_administracion = ?,stock =?
                    WHERE id_producto = ?';
                $params = array($this->idCategoria, $this->nombre, $this->desc,$this->precios,$idUser,$this->stock,$this->id);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al update datos, acconunt/Models: ".$error ->getMessage()); 
            }
        }

        public function create($idUser){
            try{
                $sql = 'INSERT INTO  producto(id_categoria, nombre_producto, descripcion, precio_producto, imagen_producto ,id_usuario_administracion,stock)
                VALUES(?,?,?,?,?,?,?)';
                $params = array($this->idCategoria, $this->nombre, $this->desc,$this->precios,$this->img,$idUser,$this->stock);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al update datos, acconunt/Models: ".$error ->getMessage()); 
            }
        }

        public function delete($idUser){
            try{
                $sql = 'DELETE FROM detalle_venta
                WHERE id_detalle_venta = ?';
                $params = array($idUser);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al delete datos, acconunt/Models: ".$error ->getMessage()); 
            }
        }

        public function createDet($venta,$precio,$producto){
            try{
                $sql = 'INSERT INTO detalle_venta(id_venta,id_producto,cantidad,total)
                VALUES (?,?,?,?)';
                $params = array($venta,$producto,1,$precio);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al update datos, acconunt/Models: ".$error ->getMessage()); 
            }
        }
    }
?>