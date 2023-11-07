<?php


class Images {

    private $id;
    private $name;
    private $descript;
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of descript
     */ 
    public function getDescript()
    {
        return $this->descript;
    }

    public function imagenID(int $id) :Images {
        $conexion = Conexion::getConexion();
        $query = "SELECT i.* FROM images AS i JOIN imagenes_x_productos AS ixp ON images.id = ixp.id_imagen WHERE id = ? ORDER BY ixp.id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetch();
        return $datos;
    }
    /**
     * Trae todas las imagenes de un producto
     * @param int ID del producto a buscar sus imagenes
     * @return array Array de imagenes y alt
     */
    public function imagenesProducto (int $id) :array{

        $conexion = Conexion::getConexion();
        $query = "SELECT i.id, i.name, i.descript FROM imagenes_x_productos AS ixp JOIN images AS i ON ixp.id_imagen = i.id WHERE ixp.id_producto = ? ORDER BY ixp.id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetchAll();
        return $datos;
    }
}