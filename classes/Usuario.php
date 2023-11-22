<?php


class Usuario {

    private $id;
    private $full_name;
    private $username;
    private $email;
    private $password;
    private $rol;


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of full_name
     */ 
    public function getFull_name()
    {
        return $this->full_name;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of rol
     */ 
    public function getRol()
    {
        return $this->rol;
    }


    /**
     * Busca un usuario segun su nombre de usuario en la BD
     * @param string nombre de usuario
     * @return ?Usuario usuario encontrado o null
     */
    public function usuarioUsername(string $username) :?Usuario {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM usuario WHERE username = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$username]);
        $datos = $PDOStatement->fetch();

        $datos->rol = (new Rol)->rolID($datos->rol);

        return $datos ?? null;
    }

    
}