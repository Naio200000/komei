<?php


class Caracteristica {

    private $id;
    private $name;

    

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
     * Trae los datos de la tabla caracteristica segun ID
     * @param int @id id de la caracteristica a buscar
     * @return Caracteristica Devuelve objeto caracteristica
     */
    public function CaracteristicaID(int $id) :Caracteristica {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM caracteristicas WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetch();
        return $datos;
    }

        /**
     * Devuelve un array con los objetos caracteristicas en la db
     * @return array Array de objeto caracteristicas
     */
    public function getAllCaracteristicas() :array {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM  caracteristicas";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        $datos = $PDOStatement->fetchAll();
        return $datos;
    }
}