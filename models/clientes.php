<?php
    class registro extends validation{
        
        public function create($name,$lastName,$correo,$user,$clave){
            try{
                $sql = 'INSERT INTO clientes(nombre_cliente,apellidos_cliente,correo_cliente,usuario_cliente,clave,id_estado_cliente)
                VALUES (?,?,?,?,?,?)';
                $hash = password_hash($clave, PASSWORD_DEFAULT);
                $params = array($name,$lastName,$correo,$user,$hash,1);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al update datos, acconunt/Models: ".$error ->getMessage()); 
            }
        }
        
    }
?>