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
}