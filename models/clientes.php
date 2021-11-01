<?php
class registro extends validation{
    private $id = null;
    private $nombre = null;
    private $apellido = null;
    private $telefono = null;
    private $direccion = null;
    private $correoempleado = null;
    private $correo = null;
    private $estado = null;
    private $usuario = null;
    private $clave = null;
    private $idtipo = null;
    private $fecha = null;
    private $browser = null;
    private $os = null;
    private $codigoos = null;
    private $codigo = null;
    private $fechare = null;
    private $intentos = null;

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIntentos($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->intentos = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombre($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellido($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->apellido = $value;
            return true;
        } else {
            return false;
        }
    }


    public function setCorreo($value)
    {
        if ($this->validateString($value,1,55)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTelefono($value)
    {
        if ($this->validatePhone($value)) {
            $this->telefono = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDireccion($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->direccion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreoEmpleado($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEstadoEmpleado($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setUsuario($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->usuario = $value;
            return true;
        } else {
            return false;
        }
    }
    
    public function setClave($value)
    {
        if ($this->validatePassword($value, 1, 50)) {
            $this->clave = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIDTipoEmpleado($value)
    {
        if ($this->validateBoolean($value)) {
            $this->idtipo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setFecha($value)
    {
        if ($this->validateString($value,1,55)) {
            $this->fecha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setBrowser($value)
    {
        if ($this->validateString($value,1,55)) {
            $this->browser = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setOs($value)
    {
        if ($this->validateString($value,1,55)) {
            $this->os = $value;
            return true;
        } else {
            return false;
        }
    }



    public function setCodigoo($value)
    {
        if ($this->validateString($value,1,55)) {
            $this->codigoos = $value;
            return true;
        } else {
            return false;
        }
    }


    public function setCodigo($value)
    {
        if ($this->validateString($value,1,55)) {
            $this->codigo = $value;
            return true;
        } else {
            return false;
        }
    }
    
    public function setFechaRe($value)
    {
        if ($this->validateDate($value)) {
            $this->fechare = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreEmpleado()
    {
        return $this->nombre;
    }

    public function getApellidoEmpleado()
    {
        return $this->apellido;
    }

    public function getIntentos()
    {
        return $this->intentos;
    }

    public function getTelefonoEmpleado()
    {
        return $this->telefono;
    }

    public function getDireccionEmpleado()
    {
        return $this->direccion;
    }

    public function getCorreoEmpleado()
    {
        return $this->correo;
    }

    public function getEstadoEmpleado()
    {
        return $this->estado;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getIDTipoEmpleado()
    {
        return $this->idtipo;
    }                 

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getBrowser()
    {
        return $this->browser;
    }

    public function getOs()
    {
        return $this->os;
    }

    public function getCodigoo()
    {
        return $this->codigoos;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }


    public function getCorreo()
    {
        return $this->correo;
    }

        public function getFechaRe()
    {
        return $this->fechare;
    }


    public function createRow()
    {
        $fechahoy = date('Y-m-d');
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO clientes (nombre_cliente,apellidos_cliente,correo_cliente,usuario_cliente,clave,id_estado_cliente)
        VALUES (?,?,?,?,?,?)';
        $params = array($this->nombre, $this->apellido,$this->correo,$this->usuario, $hash,1);
        return Database::executeRow($sql, $params);
    }

    //Punto 12, las consultas están parametrizadas, evitando inyecciones SQL

    public function createCliente($name,$lastName,$correo,$user,$clave){
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