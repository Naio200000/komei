<?php

/**
 * Clase para traer los vavores de la tabla Categoria
 */
class Links {

    private $id;
    private $link;
    private $title;

    /**
     * Trae todos los Links validos
     * @return array Array de objetos Links
     */
    private function getAllLinks() :array{

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM links_validos";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        $datos = $PDOStatement->fetchAll();

        return $datos;
    }

    public function formateaLinks () {

        $arrayOBJLinks = $this->getAllLinks();

        foreach ($arrayOBJLinks as $value) {

            $title['title'] = $value->title;

            $linksValidos[$value->link] = $title;
        }
        return $linksValidos;
    }
}
