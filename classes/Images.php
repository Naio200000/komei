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

    /**
     * Trae todas las imagenes de un producto
     * @param int ID del producto a buscar sus imagenes
     * @return array Array de imagenes y alt
     */
    public function imagenesProducto (int $id) :array{

        $conexion = (new Conexion())->getConexion();
        $query = "SELECT GROUP_CONCAT(CONCAT(i.name, ':', i.descript) SEPARATOR ',') FROM imagenes_x_productos AS ixp JOIN images AS i ON ixp.id_imagen = i.id WHERE ixp.id_producto = $id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();
        $datos = $PDOStatement->fetchAll();
        return $datos;
    }
}