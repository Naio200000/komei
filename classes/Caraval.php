<?php

/**
 * Clase para traer las caracteristicas y sus valores
 */
class Caraval {

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
     * Inserta una nueva caracteristicas
     * @param string nombre de la nueva caracteristica a insertar
     */
    public function insertCaracteristica(string $data) {

        $conexion = Conexion::getConexion();
        $query = "INSERT INTO `caracteristicas` (`name`) VALUES (?);";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$data]);
    }

    /**
     * Devuelve las caracteristicas con sus valores de un producto especifico
     * @param int ID del combo Caracteristica/Valor a buscar
     * @return Categoria devuelve objetos categoria
     */
    public function caravalID(int $id) :?Caraval {
        
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM valor_x_caracteristica WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$id]);

        $datos = $this->formateaCaraval($PDOStatement->fetch());


        return $datos ?? null;

    }
    /**
     * Devuelve las caracteristicas con sus valores
     * @return array devuelve array de caracteristica y valores
     */
    public function getAllCaraval() :array {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM valor_x_caracteristica";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();
        while ($datos = $PDOStatement->fetch()) {
            $caraval[] = $this->formateaCaraval($datos);
        };

        return $caraval;
    }

    /**
     * Formatea los datos de caraval para que contenga los objetos de las otras clase
     * @param array $datos array con los ddatos que llegan de la bd
     * @return Caraval objeto caraval formateado
     */
    public function formateaCaraval (array $datos) :caraval {

        $caraval = new self();
        $caraval->id = $datos['id'];
        $caraval->name = (new Caracteristica)->CaracteristicaID($datos['id_caracteristica']);
        $caraval->valor = (new Valor)->ValorID($datos['id_valor']);

        return $caraval;
    }


    /**
     * Trae los datos de las caracteristicas por el id
     * @param int 
     */
}