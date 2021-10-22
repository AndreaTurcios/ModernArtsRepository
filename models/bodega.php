<?php
    class VerProductos extends validation{
        private $id = null;
        private $idCategoria = null;
        private $nombre = null;
        private $desc = null;
        private $precios = null;
        private $img = null;
        private $stock = null;
        private $ruta = '../../resources/img/productos/';
        //SET
        public function getRuta(){
            return $this->ruta;
        }
        public function setImagen($file){
            if ($file != null) {
                $name = $file['name'];
                $this->img = $name;
                return true;
            } else {
                return false;
            }
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
        public function setidCategoria($value){
            if($this->validateNaturalNumber($value)){ 
                $this->idCategoria = $value;
                return true;
            }
            else{
                return false;
            }
        }
        public function setName($value){
            if ($this->validateAlphabetic($value, 1, 50)) {
                $this->nombre = $value;
                return true;
            } else {
                return false;
            }
        }
        public function setDesc($value){
            if($value != null){
                $this->desc = $value;
                return true;
            }
            else{
                return false;
            }
        }
        public function setPrecio($value){
            if($value != null){
                $this->precios = $value;
                return true;
            }
            else{
                return false;
            }
        }
        public function setStock($value){
            if($value != null){
                $this->stock = $value;
                return true;
            }
            else{
                return false;
            }
        }
        //GET
        public function getImg(){
            return  $this->img;
        }
        public function getId(){
            return $this->Id_categoria;
        }

        public function getName(){
            return $this->Nombre_producto;
        }
        public function getDesc(){
            return $this->Descripcion;
        }
        public function getPrice(){
            return $this->Precio_producto;
        }

        public function getStock(){
            return $this->Stock;
        }

        //FUNCIONES
        public function comboCategorias(){
            try{
                $sql = 'SELECT id_categoria, categoria FROM categoria';
                $params = null;
                return dataBase::getRows($sql, $params);
            } catch (Exception $error){
                die("Error al obtener datos, bodega/Models: ".$error ->getMessage()); 
            }

        }

        public function readAll(){
            try{
                $sql = 'select  p.id_producto,p.id_categoria,c.categoria,p.nombre_producto,p.descripcion,p.precio_producto,p.imagen_producto,p.stock
                from 	producto p ,categoria c
                where p.id_categoria = c.id_categoria';
                $params = null;
                return dataBase::getRows($sql, $params);
            } catch (Exception $error){
                die("Error al obtener datos, bodega/Models: ".$error ->getMessage()); 
            }

        }

        public function readAllCometarios(){
            try{
                $sql = 'SELECT v.id_valoraciones,p.nombre_producto,v.comentario,c.usuario_cliente,v.estado
                FROM clientes c, producto p, valoraciones v
                WHERE v.id_producto = p.id_producto AND
                v.id_cliente = c.id_cliente';
                $params = null;
                return dataBase::getRows($sql, $params);
            } catch (Exception $error){
                die("Error al obtener datos, bodega/Models: ".$error ->getMessage()); 
            }

        }
        public function readAllCometarios2($p){
            try{
                $sql = 'SELECT v.id_valoraciones,p.nombre_producto,v.comentario,c.usuario_cliente,v.estado
                FROM clientes c, producto p, valoraciones v
                WHERE v.id_producto = p.id_producto AND
                v.id_cliente = c.id_cliente AND
                v.estado = ? AND
                V.id_producto = ?';
                $params = array('line',$p);
                return dataBase::getRows($sql, $params);
            } catch (Exception $error){
                die("Error al obtener datos, bodega/Models: ".$error ->getMessage()); 
            }

        }

        public function updateImg($idUser){
            try{
                $sql = 'UPDATE producto
                    SET id_categoria = ? , nombre_producto = ? , descripcion = ? , precio_producto = ?, imagen_producto = ?,id_usuario_administracion = ?,stock =?
                    WHERE id_producto = ?';
                $params = array($this->idCategoria, $this->nombre, $this->desc,$this->precios,$this->img,$idUser,$this->stock,$this->id);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al update datos, acconunt/Models: ".$error ->getMessage()); 
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

        public function bloqueo($idUser){
            try{
                $sql = 'UPDATE valoraciones SET estado = ? WHERE id_valoraciones = ?';
                $params = array('block',$idUser);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al delete datos, acconunt/Models: ".$error ->getMessage()); 
            }
        }

        public function delete($idUser){
            try{
                $sql = 'DELETE FROM producto WHERE id_producto = ?';
                $params = array($idUser);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al delete datos, acconunt/Models: ".$error ->getMessage()); 
            }
        }

        public function showProductoPublic(){
            try{
                $sql = 'select id_producto, nombre_producto,descripcion,imagen_producto,precio_producto from producto';
                $params = null;
                return dataBase::getRows($sql, $params);
            } catch (Exception $error){
                die("Error al obtener datos, bodega/Models: ".$error ->getMessage()); 
            }
        }


        public function ordenExist($usario){
            try{
                $sql = 'SELECT id_venta FROM venta WHERE id_cliente = ? AND estado_venta = ?';
                $params = array($usario,'carrito');
                
                if($data = dataBase::getRow($sql, $params)){
                    $this->idOrden = $data['id_orden'];
                    return true;
                }
                else {
                    return false;
                }

            } catch (Exception $error){

                die("Error al obtener datos, carrito/Model: ".$error ->getMessage()); 
            }
        }


        public function productoCategoria()
    {
        $sql ='SELECT ca.categoria, COUNT(pr.nombre_producto) as cantidad
        From producto pr 
		INNER JOIN categoria ca USING(id_categoria)
        Group by ca.categoria';
        $params = null;
        return Database::getRows($sql, $params);
    }
    }
?>