<?php

/**
 * Clase para traer los vavores de la tabla Categoria
 */
class Categoria {

    private $id;
    private $name;
    private $descript;


    /**
     * Devuelve los datos de una categoria segun su ID
     * @param int Id de la Categoria a buscar
     * @return Categoria devuelve un objeto Categoria
     */
    public function categoriaID(int $id) :Categoria {

        $conexion = (new Conexion())->getConexion();
        $query = "SELECT * FROM categorias WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetch();

        return $datos;
    }

    private function getAllCategorias() :array{

        $conexion = (new Conexion())->getConexion();
        $query = "SELECT categorias.name FROM categorias";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();
        $datos = $PDOStatement->fetchAll();

        return $datos;
    }
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

    public function formateaCategoriasa() {

        $categorias = $this->getAllCategorias();
        foreach ($categorias as $value) {
            $datos[] = $value['name'];
        }
        return $datos;
    }
}