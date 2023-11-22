<?php


class Rol {

    private $id;
    private $roles;


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of roles
     */ 
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Busca un rol en la db
     * @param int id del rol
     * @return ?Rol usuario encontrado o null
     */
    public function rolID(int $id) :?Rol {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM roles WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetch();
        

        return $datos ?? null;
    }

}