<?php

/**
 * Clase para traer los vavores de la tabla Categoria
 */
class Categoria {

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
     * Inserta una nueva categoria en la BD
     * @param string #name nombre de la categoria
     * @param string $descript Parrafo de descripción de la categoría
     */
    Public function insertCategoria(string $nombre, string $descript) {

        $conexion = Conexion::getConexion();
        $query = "INSERT INTO `categorias` (`name`, `descript`) VALUES (:nombre , :descript);";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'nombre' => $nombre,
                'descript' => $descript
            ]
        );
    }
    /**
     * Edita los datos de una categoria en la DB
     * @param string #name nombre de la categoria
     * @param string $descript Parrafo de descripción de la categoría
     */
    public function editCategoria (string $nombre, string $descript) {

        $conexion = Conexion::getConexion();
        $query = "UPDATE`categorias` SET name = :nombre, descript = :descript WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [   
                'id' => $this->id,
                'nombre' => $nombre,
                'descript' => $descript
            ]
        );
    }
    /**
     * Borra esta categoria
     */
    public function deleteCategoria () {

        $conexion = Conexion::getConexion();
        $query = "DELETE FROM categorias WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id,]);
    }

    
    /**
     * Devuelve los datos de una categoria segun su ID
     * @param int Id de la Categoria a buscar
     * @return Categoria devuelve un objeto Categoria
     */
    public function categoriaID(int $id) :Categoria {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM categorias WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetch();

        return $datos;
    }


    /**
     * Devuelve los datos de una categoria segun su nombre
     * @param string $name de la Categoria a buscar
     * @return Categoria devuelve un objeto Categoria
     */
    public function categoriaName(string $name) :Categoria {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM categorias WHERE name = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$name]);
        $datos = $PDOStatement->fetch();

        return $datos;
    }

    /**
     * Trae un array con todos las Categorias
     * @return array Array con todas las categorias
      */
    public function getAllCategorias() :array{

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM categorias";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        $datos = $PDOStatement->fetchAll();

        return $datos;
    }
    /**
     * Trae un array con todos los nombres de las Categorias
     * @return array Array con los nombres de las categorias
      */
    private function getAllCategoriasName() :array{

        $conexion = Conexion::getConexion();
        $query = "SELECT categorias.name FROM categorias";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();
        $datos = $PDOStatement->fetchAll();

        return $datos;
    }

    /**
     * Devuelve un array indexado con los nombres de las categorias
     * @return array array de nombre de las categorias
     */
    public function formateaCategoriasa() {

        $categorias = $this->getAllCategoriasName();
        foreach ($categorias as $value) {
            $datos[] = $value['name'];
        }
        return $datos;
    }

    /**
     * Trae todos los tipos segun la categoria
     * @param string $categoria categoria del cual se buscan los tipos
     * @return array lista de tipos segun categoria
     */
    private function getTiposCategoria (string $categoria) {

        $conexion = Conexion::getConexion();
        $query = "SELECT t.id, t.name FROM categorias AS c JOIN tipo_x_categorias AS txc ON c.id = txc.id_categoria JOIN tipos AS t ON txc.id_tipo = t.id WHERE c.name = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$categoria]);
        $datos = $PDOStatement->fetchAll();

        return $datos;
    }

    
    /**
     * Devuelve un array indexado con los nombres de las categorias
     * @return array array de nombre de las categorias
     */
    public function formateaTipos($categoria) {
        $tipos = $this->getTiposCategoria($categoria);
        foreach ($tipos as  $value) {
            $datos[$value['id']] = strtolower($value['name']);
        }
        return $datos;
    }
}