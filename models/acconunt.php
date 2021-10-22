<?php
    class dataUser extends validation{
        //Datos del usuario que inicio seccion
        private $id = null;
        private $email = null;
        private $password = null;
        private $name = null;
        private $lastname = null;
        private $tipo_empleado = null;

        //metodos set

        public function setId($value){
            if($this->validateNaturalNumber($value)){
                $this->id = $value;
                return true;
            }
            else{
                return false;
            }
        }
        public function setName($value){
            if ($this->validateAlphabetic($value, 1, 50)) {
                $this->name = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setTipoEmpleado($value){
            if ($this->validateAlphabetic($value, 1, 50)) {
                $this->tipo_empleado = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setLastName($value){
            if ($this->validateAlphabetic($value, 1, 50)) {
                $this->lastname = $value;
                return true;
            } else {
                return false;
            }
        }
        public function setEmail($value){
            if ($this->validateEmail($value)) {
                $this->email = $value;
                return true;
            } else {
                return false;
            }
        }
        public function setPassword($value){
            $this->password = $value;
            return true;
        }

        //metodos get

        public function getId(){
            return $this->id;
        }

        public function getName(){
            return $this->name;
        }

        public function getTipo_empleado(){
            return $this->tipo_empleado;
        }

        public function checkUser($value){
            try{
                $sql = 'SELECT nombre_admin,id_usuario_administracion, correo_admin, tipo_usuario FROM administradores WHERE correo_admin = ?';
                $params = array($value);
                if ($data = dataBase::getRow($sql, $params)) {
                    $this->id = $data['id_usuario_administracion'];
                    $this->name = $data['nombre_admin'];
                    $this->tipo_empleado = $data['tipo_usuario'];
                    $this->email = $value;
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $error){
                die("Error al veificar usuario, Login/Models: ".$error ->getMessage()); 
            }
        }

        public function getDevices()
    {
        $sql = 'SELECT dispositivo, fecha FROM historial_sesion WHERE id_usuario_administracion = ?';
        $params = array($_SESSION['idUser']);
        return Database::getRows($sql, $params);
    }

    // punto 15, intentos fallidos de autenticación
    public function agregarIntentos()
     {   
         $sql = 'SELECT intentos FROM administradores WHERE id_usuario_administracion = ?';
         $params = array($this->id);
         if($data = Database::getRow($sql, $params)){
             if($data['intentos'] >=3 ){
                 $sql = 'UPDATE administradores SET estado = false where id_usuario_administracion = ?';
                 $params = array( $this->id);
                 return Database::executeRow($sql, $params);
             } else {
                 $this->intentosC = $data['intentos'];
                 $intentos = $this->intentosC + 1;
                 $sql = 'UPDATE administradores SET intentos = ? where id_usuario_administracion = ?';
                 $params = array($intentos, $this->id);
                 return Database::executeRow($sql, $params);
             }
         } else {
             return false;
         }
     }


        public function checkPassword($password , $email){
            try{
                $sql = 'SELECT clave_admin FROM administradores WHERE correo_admin = ?';
                $params = array($email);
                $data = dataBase::getRow($sql, $params);
                if (password_verify($password, $data['clave_admin'])) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $error){

                die("Error al veificar Clave, Login/Models: ".$error ->getMessage()); 
            }
        }


        public function checkUserAlso($value){
            try{
                $sql = 'SELECT usuario_cliente,id_cliente
                FROM clientes WHERE usuario_cliente = ?';
                $params = array($value);
                if ($data = dataBase::getRow($sql, $params)) {
                    $this->id = $data['id_cliente'];
                    $this->name = $data['usuario_cliente'];
                    $this->email = $value;
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $error){
                die("Error al veificar usuario, Login/Models: ".$error ->getMessage()); 
            }
        }

        public function checkPasswordAlso($password , $email){
            try{
                $sql = 'SELECT clave
                FROM clientes
                WHERE usuario_cliente = ?';
                $params = array($email);
                $data = dataBase::getRow($sql, $params);
                if (password_verify($password, $data['clave'])) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $error){

                die("Error al veificar Clave, Login/Models: ".$error ->getMessage()); 
            }
        }

        //funcion para hacer la consulta en la base de datos
        public function readAll(){
            try{
                $sql = "SELECT nombre_admin,id_usuario_administracion ,apellido_admin ,correo_admin
                FROM administradores";
                $params = null;
                return dataBase::getRows($sql, $params);
            } catch (Exception $error){

                die("Error al obtener datos, acconunt/Models: ".$error ->getMessage()); 
            }
            
        }

        public function searchName($value){
            try{
                $sql = "SELECT nombre_admin,id_usuario_administracion ,apellido_admin ,correo_admin
                FROM administradores
                WHERE nombre_admin LIKE '%felipe%'";
                $params = null;
                return dataBase::getRows($sql, $params);
            } catch (Exception $error){

                die("Error al obtener datos, acconunt/Models: ".$error ->getMessage()); 
            }
            
        }
        public function searchApe($value){
            try{
                $sql = "SELECT nombre_admin,id_usuario_administracion ,apellido_admin ,correo_admin
                FROM administradores
                WHERE apellido_admin like '%rosales%'";
               $params = null;
                return dataBase::getRows($sql, $params);
            } catch (Exception $error){

                die("Error al obtener datos, acconunt/Models: ".$error ->getMessage()); 
            }
            
        }

        public function searchEmail($value){
            try{
                $sql = "SELECT nombre_admin,id_usuario_administracion ,apellido_admin ,correo_admin
                FROM administradores
                WHERE correo_admin like '%felipR@gmail.com%' ";
               $params = null;
                return dataBase::getRows($sql, $params);
            } catch (Exception $error){

                die("Error al obtener datos, acconunt/Models: ".$error ->getMessage()); 
            }
            
        }

        //Este es el punto 2 de la rúbrica (cifrar contraseña), crea un nuevo hash de contraseña usando 
        //un algoritmo de hash fuerte de único sentido, el tiempo empleado en codificar una contraseña 
        //se denomina coste y se puede configurar mediante el tercer argumento opcional de la función 
        //password_hash(). El coste por defecto es 10 (por eso el prefijo de las contraseñas anteriores es $2y$10$).
        //PASSWORD_BCRYPT, a pesar de su nombre, codifica la contraseña utilizando el algoritmo CRYPT_BLOWFISH. 
        //Al igual que en el caso anterior, la contraseña codificada ocupa 60 caracteres en total, siendo los primeros caracteres $2y$.

        //Mientras que en el documento de OWASP hablaríamos de un deserialización insegura o configuración de seguridad incorrecta

        public function create(){
            $hash = password_hash('Arts', PASSWORD_DEFAULT);
            $sql = 'INSERT INTO administradores(nombre_admin,apellido_admin,correo_admin,clave_admin)
            VALUES(?,?,?,?)';
            $params = array($this->name, $this->lastname,$this->email,$hash);
            return dataBase::executeRow($sql, $params);
        }

        public function updateRowPassword()
        { 
        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = 'UPDATE clientes 
                SET clave=?
                WHERE id_cliente = ?';
        $params = array($hash, $_SESSION['idUser']);
        return Database::executeRow($sql, $params);
        }

        public function update($idAD){
            try{
                $sql = 'UPDATE administradores
                    SET nombre_admin = ? , apellido_admin = ? , correo_admin = ?
                    WHERE id_usuario_administracion = ?';
                $params = array( $this->name, $this->lastname,$this->email,$idAD);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al update datos, acconunt/Models: ".$error ->getMessage()); 
            }
        }
        public function reset(){
            try{
                $hash = password_hash('Arts', PASSWORD_DEFAULT);
                $sql = 'UPDATE administradores
                    SET clave_admin = ?
                    WHERE id_usuario_administracion = ?';
                $params = array( $hash,$this->id);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al reset datos, acconunt/Models: ".$error ->getMessage()); 
            }
        }

        public function delete($value){
            try{
            
                $sql = 'DELETE FROM administradores
                    WHERE id_usuario_administracion = ?';
                $params = array($value);
                return dataBase::executeRow($sql, $params);
            } catch (Exception $error){

                die("Error al reset datos, acconunt/Models: ".$error ->getMessage()); 
            }
        }

        public function estadoClienteG()
        {
            $sql ='SELECT ec.estado_cliente, COUNT(cl.nombre_cliente) as cantidad
            From clientes cl 
            INNER JOIN estado_cliente ec USING(id_estado_cliente)
            Group by ec.estado_cliente';
            $params = null;
            return Database::getRows($sql, $params);
    
        }
    }
?>