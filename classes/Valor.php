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
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Inserta una nueva caracteristicas
     * @param string nombre de la nueva caracteristica a insertar
     */
    public function insertValor(string $data) {

        $conexion = Conexion::getConexion();
        $query = "INSERT INTO `valores` (`valor`) VALUES (?);";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$data]);
    }
    /**
     * Edita los datos de una Caracteristica en la DB
     * @param string #name nombre de la Caracteristica
     */
    public function editValor (string $valor) {

        $conexion = Conexion::getConexion();
        $query = "UPDATE`valores` SET valor = :valor WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [   
                'id' => $this->id,
                'valor' => $valor
            ]
        );
    }
    /**
     * Borra esta caracteristica
     */
    public function deleteValor () {

        $conexion = Conexion::getConexion();
        $query = "DELETE FROM valores WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id,]);
    }
    /**
     * Trae los datos de la tabla valor segun ID
     * @param int @id id de la valor a buscar
     * @return Valor Devuelve objeto valor
     */
    public function ValorID(int $id) :Valor {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM valores WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetch();
        return $datos;
    }

    /**
     * Devuelve un array con los objetos valores en la db
     * @return array Array de objetos valores
     */
    public function getAllvalores() :array {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM  valores";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        $datos = $PDOStatement->fetchAll();
        return $datos;
    }

}