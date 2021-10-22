<?php
/*
*	Clase para manejar la tabla categorias de la base de datos. Es clase hija de Validator.
*/
class Categorias extends Validation
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $nombre = null;
    private $imagen = null;
    private $descripcion = null;
    private $ruta = '../../../resources/img/categorias/';

    /*
    *   Métodos para validar y asignar valores de los atributos.
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
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

    public function setImagen($file)
    {
        if ($this->validateImageFile($file, 500, 500)) {
            $this->imagen = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }

    public function setDescripcion($value)
    {
        if ($value) {
            if ($this->validateString($value, 1, 250)) {
                $this->descripcion = $value;
                return true;
            } else {
                return false;
            }
        } else {
            $this->descripcion = null;
            return true;
        }
    }

    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_categoria, nombre_categoria, imagen_categoria, descripcion_categoria
                FROM categorias
                WHERE nombre_categoria ILIKE ? OR descripcion_categoria ILIKE ?
                ORDER BY nombre_categoria';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO categorias(nombre_categoria, imagen_categoria, descripcion_categoria)
                VALUES(?, ?, ?)';
        $params = array($this->nombre, $this->imagen, $this->descripcion);
        return Database::executeRow($sql, $params);
    }

    public function readClientes()
    {
        $sql = 'SELECT "idCliente","nombresCliente","apellidosCliente" 
        FROM "Clientes" c
        INNER JOIN "Pedido" p USING("idCliente")';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readPedidosCliente()
    {
        $sql = 'SELECT id_venta,c.nombre_cliente,c.apellidos_cliente,estado_venta,fecha_venta 
        from venta
        INNER JOIN clientes c USING(id_cliente)
        ORDER BY c.nombre_cliente';
        $params = array($this->id);
        return Database::getRows($sql, null);
    }

    public function readReportClientes()
    {
        $sql = 'SELECT id_cliente, nombre_cliente,apellidos_cliente,dui_cliente,correo_cliente,telefono_cliente 
        from clientes
        order by id_cliente';
        $params = array($this->id);
        return Database::getRows($sql, null);
    }

    public function readReportValoraciones()
    {
        $sql = 'SELECT p.nombre_producto,comentario,c.nombre_cliente,estado
        FROM valoraciones v
        INNER JOIN producto p ON v.id_producto = p.id_producto
        INNER JOIN clientes c ON v.id_cliente = c.id_cliente
        order by c.nombre_cliente';
        $params = array($this->id);
        return Database::getRows($sql, null);
    }

    public function readReportProductos()
    {
        $sql = 'SELECT id_producto,c.categoria,nombre_producto,precio_producto
        from producto
        INNER JOIN categoria c USING(id_categoria)';
        $params = array($this->id);
        return Database::getRows($sql, null);
    }

    public function readCategorias()
    {
        $sql = 'SELECT id_categoria,categoria,descripcion_categoria from categoria order by categoria';
        $params = array($this->id);
        return Database::getRows($sql, null);
    }

    public function readOne()
    {
        $sql = 'SELECT id_categoria, nombre_categoria, imagen_categoria, descripcion_categoria
                FROM categorias
                WHERE id_categoria = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        ($this->imagen) ? $this->deleteFile($this->getRuta(), $current_image) : $this->imagen = $current_image;

        $sql = 'UPDATE categorias
                SET imagen_categoria = ?, nombre_categoria = ?, descripcion_categoria = ?
                WHERE id_categoria = ?';
        $params = array($this->imagen, $this->nombre, $this->descripcion, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM categorias
                WHERE id_categoria = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

}