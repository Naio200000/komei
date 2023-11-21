<?php

/**
 * Clase para traer las caracteristicas y sus valores
 */
class Caracteristicas {

    private $id;
    private $name;
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
        return $this->name;
    }

    /**
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }


    /**
     * Inserta una nueva relacion en la tabla valores_x_caracteristicas
     * @param array Array con los id de las caracteristicas a insertar
     */
    public function insertRelacion(array $data) {

        $conexion = Conexion::getConexion();
        $query = "INSERT INTO `valor_x_caracteristica` (`id_caracteristica`, `id_valor`) VALUES (:id_caracteristica , :id_valor);";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id_caracteristica' => $data['caracterisitca'],
                'id_valor' => $data['valor']
            ]
        );
    }

        /**
     * Edita los datos de una relacion en la tabla valor_x_caracteristica en particular
     * @param array array con los datos IDs de caracteristicas y valores para editar
     */
    public function editRelacion (array $data) {

        $conexion = Conexion::getConexion();
        $query = "UPDATE`valor_x_caracteristica` SET id_caracteristica = :id_caracteristica, id_valor = :id_valor WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [   
                'id' => $this->id,
                'id_caracteristica' => $data['caracterisitca'],
                'id_valor' => $data['valor']
            ]
        );
    }

    /**
     * Borra esta Relacion de la tabla valor_x_caracteristica
     */
    public function deleteRelacion () {

        $conexion = Conexion::getConexion();
        $query = "DELETE FROM valor_x_caracteristica WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id,]);
    }


    /**
     * Devuelve las caracteristicas con sus valores de un producto especifico
     * @param int ID del combo Caracteristica/Valor a buscar
     * @return Categoria devuelve objetos categoria
     */
    public function caravalID(int $id) :Caracteristicas {

        $conexion = Conexion::getConexion();
        $query = "SELECT vxc.id, c.name, v.valor FROM valor_x_caracteristica AS vxc JOIN caracteristicas AS c ON vxc.id_caracteristica = c.id JOIN valores AS v ON vxc.id_valor = v.id WHERE vxc.id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetch();
        return $datos;
    }
    /**
     * Devuelve las caracteristicas con sus valores
     * @return array devuelve array de caracteristica y valores
     */
    public function getAllCaraval() :array {

        $conexion = Conexion::getConexion();
        $query = "SELECT vxc.id, c.name, v.valor FROM valor_x_caracteristica AS vxc JOIN caracteristicas AS c ON vxc.id_caracteristica = c.id JOIN valores AS v ON vxc.id_valor = v.id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        $datos = $PDOStatement->fetchAll();
        return $datos;
    }
    /**
     * Devuelve un array con solo las caracteristicas en la db
     * @return array Array de caracteristicas
     */
    public function getAllCaracteristicas() :array {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM  caracteristicas";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();
        $datos = $PDOStatement->fetchAll();
        return $datos;
    }
    /**
     * Devuelve un array con solo los valores en la db
     * @return array Array de valores
     */
    public function getAllvalores() :array {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM  valores";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();
        $datos = $PDOStatement->fetchAll();
        return $datos;
    }
}