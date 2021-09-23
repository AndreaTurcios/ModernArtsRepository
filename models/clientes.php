<?php
    class registro extends validation{
        //Este es el punto 2 de la rúbrica (cifrar contraseña), crea un nuevo hash de contraseña usando 
        //un algoritmo de hash fuerte de único sentido, el tiempo empleado en codificar una contraseña 
        //se denomina coste y se puede configurar mediante el tercer argumento opcional de la función 
        //password_hash(). El coste por defecto es 10 (por eso el prefijo de las contraseñas anteriores es $2y$10$)

        //PASSWORD_BCRYPT, a pesar de su nombre, codifica la contraseña utilizando el algoritmo CRYPT_BLOWFISH. 
        //Al igual que en el caso anterior, la contraseña codificada ocupa 60 caracteres en total, siendo los primeros caracteres $2y$.
        
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