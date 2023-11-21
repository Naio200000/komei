<?php


class Valor {

    private $id;
    private $valor;

    

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
        return $this->valor;
    }


    public function ValorID(int $id) :Valor {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM valores WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetch();
        return $datos;
    }

}