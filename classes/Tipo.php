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
     * Inserta una nueva tipo en la BD
     * @param array Todos los datos para ingresar
     * @return int ID del nuevo ingreso
     */
    Public function insertTipo(array $dataPOST) :int {

        $conexion = Conexion::getConexion();
        if (isset($dataPOST['select'])) {
            $id_disponible = $dataPOST['select'];
        } else {
           $id_disponible = $this->insertDisponibilidad($dataPOST['fecha'], $dataPOST['dias']);
        }

        $query = "INSERT INTO `tipos` (`name`, `descript`, `id_disponible` ) VALUES (:nombre , :descript, :id_disponible);";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'nombre' => $dataPOST['name'],
                'descript' => $dataPOST['descript'],
                'id_disponible' => $id_disponible
            ]
        );

        
        return $conexion->lastInsertId();
    }
    /**
     * Inserta una nueva Disponibilidad en la BD
     * @param string Fecha de la siponibilidad puede ser null
     * @return int Cantidad de dias puede ser null
     * @return int ID del nuevo ingreso
     */
    public function insertDisponibilidad (string $fecha = null, int $cantidad = null) :int{

        $conexion = Conexion::getConexion();
        if ($fecha) {
            $query = "INSERT INTO `disponibilidad` (`seminario`) VALUES( ?)";
            $dato = $fecha;
        } else {
            $query = "INSERT INTO `disponibilidad` (`resto`) VALUES( ?)";
            $dato = $cantidad;
        }
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$dato]);

        
        return $conexion->lastInsertId();
    }
    /**
     * Inserta una nueva relación entre un tipo y una categoria
     * @param int #id_tipo Id del tipo
     * @param int $id_categoria ID de la categoria
     */
    Public function insertTipoXCategoria(int $id_tipo, int $id_categoria) {

        $conexion = Conexion::getConexion();
        $query = "INSERT INTO `tipo_x_categorias`VALUES (NULL, :id_tipo, :id_categoria)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id_tipo' => $id_tipo,
                'id_categoria' => $id_categoria
            ]
        );
    }


    /**
     * Edita los datos de un tipo en la DB
     * @param string #name nombre del tipo
     * @param string $descript Parrafo de descripción del tipo
     * @param string $descript Parrafo de descripción del tipo
     */
    public function editTipo (array $dataPOST) {

        $conexion = Conexion::getConexion();
        if (isset($dataPOST['select'])) {
            $id_disponible = $dataPOST['select'];
        } else {
            $id_disponible = $this->editDisponibilidad($dataPOST['fecha'], $dataPOST['dias']);
        }
        $query = "UPDATE`tipos` SET name = :nombre, descript = :descript, id_disponible = :disponible WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [   
                'id' => $this->id,
                'nombre' => $dataPOST['name'],
                'descript' => $dataPOST['descript'],
                'disponible' => $id_disponible
            ]
        );

    }

    /**
     * Inserta una nueva relación entre un tipo y una categoria
     * @param int #id_tipo Id del tipo
     * @param int $id_categoria ID de la categoria
     */
    Public function editTipoXCategoria( int $id_categoria) {

        $conexion = Conexion::getConexion();
        $query = "UPDATE `tipo_x_categorias` SET id_categoria = :id_categoria WHERE id_tipo = :id_tipo";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id_tipo' => $this->id,
                'id_categoria' => $id_categoria
            ]
        );
    }

    //Falta verificar si este dato ingresado ya esta en la BD
    /**
     * Inserta una nueva Disponibilidad en la BD
     * @param string Fecha de la siponibilidad puede ser null
     * @return int Cantidad de dias puede ser null
     * @return int ID del nuevo ingreso
     * @return int ID de la Disponibilidad editada
     */
    public function editDisponibilidad (string $fecha = null, int $cantidad = null) :int {

        $conexion = Conexion::getConexion();
        if ($fecha) {
            $query = "UPDATE `disponibilidad` SET seminario = :dato , resto = NULL WHERE id = :id";
            $dato = $fecha;
        } else {
            $query = "UPDATE `disponibilidad` SET seminario = NULl, resto = :dato WHERE id = :id";
            $dato = $cantidad;
        }
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id' => $this->id_disponible,
                'dato' =>$dato
            ]
        );
        return $this->id_disponible;
    }

    /**
     * Borra este Tipo
     */
    public function deletetipo () {

        $this->deleteTipoxCategoria();
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM tipos WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id,]);
    }

    public function deleteTipoxCategoria () {

        $conexion = Conexion::getConexion();
        $query = "DELETE FROM tipo_x_categorias WHERE id_tipo = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id,]);
    }
    /**
     * Devuelve un objeto Tipo
     * @param int ID del tipo a buscar
     * @return Tipo Devuelve un objeto Tipo
     */
    public function tipoID(int $id) :Tipo{

        $conexion = Conexion::getConexion();
        $query = "SELECT t.*, txc.id_categoria AS categoria FROM tipos AS t LEFT JOIN tipo_x_categorias AS txc ON t.id = txc.id_tipo WHERE t.id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetch();
        $datos->categoria = (new Categoria)->categoriaID($datos->categoria);
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

    public function getDisponibilidadId() :mixed {
        $conexion = Conexion::getConexion();
        $query = "SELECT d.id, CONCAT_WS(' ', d.seminario, d.resto) as tiempo  FROM `disponibilidad` AS d WHERE d.id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$this->getId_disponible()]);
        $datos = $PDOStatement->fetch();

        return $datos;
    }
    public function getAllDisponibilidad() :array {
        $conexion = Conexion::getConexion();
        $query = "SELECT d.id, CONCAT_WS(' ', d.seminario, d.resto) as tiempo  FROM `disponibilidad` AS d";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();
        $datos = $PDOStatement->fetchAll();

        return $datos;
    }
    public function formateaDisponibilidad() :mixed {
        
        $conexion = Conexion::getConexion();
        $query = "SELECT c.name, CONCAT_WS(' ', d.seminario, d.resto) as tiempo  FROM tipos AS t JOIN disponibilidad AS d ON t.id_disponible = d.id LEFT JOIN tipo_x_categorias AS txc ON t.id = txc.id_tipo JOIN categorias AS c on txc.id_categoria = c.id WHERE t.id_disponible = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$this->id_disponible]);
        $datos = $PDOStatement->fetch();
        
        if ($datos['name'] != 'seminario'){
            if ($datos['tiempo'] == '0') {
                return 'Todos los días';
            } else {
                return $datos['tiempo'] . " Dias";
            }
        } else {
            return date('m/y', strtotime($datos['tiempo']));
        }

    }
}