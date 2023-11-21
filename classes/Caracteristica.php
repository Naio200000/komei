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


    public function CaracteristicaID(int $id) :Caracteristica {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM caracteristicas WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetch();
        return $datos;
    }

}