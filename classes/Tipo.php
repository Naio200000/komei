<?php

/**
 * Clase para traer los vavores de la tabla Categoria
 */
class Tipo {

    private $id;
    private $name;
    private $descript;
    private $id_disponible;

    

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
     * Get the value of id_disponible
     */ 
    public function getId_disponible()
    {
        return $this->id_disponible;
    }

    /**
     * Devuelve un objeto Tipo
     * @param int ID del tipo a buscar
     * @return Tipo Devuelve un objeto Tipo
     */
    public function tipoID(int $id) :Tipo{

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM tipos WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetch();

        return $datos;
    }
}