<?php

/**
 * Clase para traer los vavores de la tabla Categoria
 */
class Tipo {

    private $id;
    private $name;
    private $descript;
    private $id_disponible;
    private $categoria;
    

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
     * Get the value of categoria
     */ 
    public function getcategoria()
    {
        return $this->categoria;
    }

    /**
     * Devuelve un objeto Tipo
     * @param int ID del tipo a buscar
     * @return Tipo Devuelve un objeto Tipo
     */
    public function tipoID(int $id) :Tipo{

        $conexion = Conexion::getConexion();
        $query = "SELECT t.*, txc.id_categoria AS categoria FROM tipos AS t LEFT JOIN tipo_x_categorias AS txc ON t.id = txc.id_tipo WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetch();
        return $datos;
    }

    public function getAllTipos () :array {
        $conexion = Conexion::getConexion();
        $query = "SELECT t.*, txc.id_categoria AS categoria FROM tipos AS t LEFT JOIN tipo_x_categorias AS txc ON t.id = txc.id_tipo";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        $datos = $PDOStatement->fetchAll();
        foreach($datos as $d) {
            $d->categoria = (new Categoria)->categoriaID($d->categoria);
        }

        return $datos;
    }

    public function formateaDisponibilidad() :?string {
        
        $conexion = Conexion::getConexion();
        $query = "SELECT c.name, CONCAT_WS(' ', d.seminario, d.resto) as tiempo  FROM tipos AS t JOIN disponibilidad AS d ON t.id_disponible = d.id LEFT JOIN tipo_x_categorias AS txc ON t.id = txc.id_tipo JOIN categorias AS c on txc.id_categoria = c.id WHERE t.id_disponible = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$this->id_disponible]);
        $datos = $PDOStatement->fetch();
        
        if ($datos['name'] == 'clases'){
            if ($datos['tiempo'] == 0) {
                return 'Todos los días';
            } else {
                return date('m/y', strtotime($datos['tiempo']));
            }
        } else {
            return $datos['tiempo'] . " Dias";
        }

    }
}