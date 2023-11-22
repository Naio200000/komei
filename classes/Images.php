<?php


class Images {

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
     * Inserta una nueva Imagen en la BD
     * @param string $nombre nombre de la Imagen
     * @param string $descript descripcion de la Imagen
     */
    Public function insertImagen(string $descript, string $nombre ) {

        $conexion = Conexion::getConexion();
        $query = "INSERT INTO `images` (`name`, `descript`) VALUES (:nombre , :descript);";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'nombre' => $nombre,
                'descript' => $descript
            ]
        );
    }

    /**
     * Edita los datos de una Imagen en la DB
     * @param string #name nombre de la Imagen
     * @param string $descript Parrafo de descripción de la Imagen
     */
    public function editImagen (string $nombre, string $descript) {

        $conexion = Conexion::getConexion();
        $query = "UPDATE`images` SET name = :nombre, descript = :descript WHERE id = :id";
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
     * Borra esta Imagen
     */
    public function deleteImagen () {

        $conexion = Conexion::getConexion();
        $query = "DELETE FROM images WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id,]);
    }

    /**
     * Sube una imagen al repositorio de images de productos
     * @param string $direccion direccio del repositorio don de guardar imagenes
     * @param string $$dato datos de la imagen nueva
     * @return string nombre de la nueva imagen
     */
    public function uploadImagen(string $direccion, array $datos) :string {

            $imgName= (explode(".", $datos['name']));
            $extension = end($imgName);
            $filename = time();
    
            $fileUpload = move_uploaded_file($datos['tmp_name'], "$direccion/$filename" . ".$extension");
    
            if (!$fileUpload) {
                throw new Exception("No se pudo subir la imagen");
            } else {
                return $filename;
            }
    }

    /**
     * Borra el Archivo del repositorio de imagenes
     * @param string $archivo nombre y direccion del archovo a borrar
     */
    public function deleteImagenFile($archivo) :bool {

        if (file_exists(($archivo))) { 
            $fileDelete =  unlink($archivo);
            if (!$fileDelete) {
                throw new Exception("No se pudo eliminar la imagen");
            } else {
                return TRUE;
            }
        }else{
            return FALSE;
        }
    }
    /**
     * Inserta una nueva relacion en la tabla Imagenes por Producto
     * @param int Id del producto
     * @param int id de la imagen
     */
    public function insertRelacionProducto(int $id_producto, int $id_imagen) {

        $conexion = Conexion::getConexion();
        $query = "INSERT INTO `imagenes_x_productos` (`id_producto`, `id_imagen`) VALUES (:id_producto , :id_imagen);";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id_producto' => $id_producto,
                'id_imagen' => $id_imagen
            ]
        );
    }

    /**
     * Borra las relaciones que tenga el producto con las imagenes
     * @param int Id del producto

     */
    public function deleteRelacionProducto(int $id_producto) {

        $conexion = Conexion::getConexion();
        $query = "DELETE FROM imagenes_x_productos  WHERE id_producto = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$id_producto]);
    }

    /**
     * Trae una imagen segun su id
     * @param int ID de la imagen
     * @return Images Objeto Images
     */
    public function imagenID(int $id) :Images {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM images WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetch();
        return $datos;
    }
    /**
     * Trae una imagen segun su id
     * @param int ID de la imagen
     * @return Images Objeto Images
     */
    public function getAllImages () : array {

        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM images";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        $datos = $PDOStatement->fetchAll();
        return $datos;
    }
    /**
     * Trae todas las imagenes de un producto
     * @param int ID del producto a buscar sus imagenes
     * @return array Array de imagenes y alt
     */
    public function imagenesProducto (int $id) :array{

        $conexion = Conexion::getConexion();
        $query = "SELECT i.id, i.name, i.descript FROM imagenes_x_productos AS ixp JOIN images AS i ON ixp.id_imagen = i.id WHERE ixp.id_producto = ? ORDER BY ixp.id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute([$id]);
        $datos = $PDOStatement->fetchAll();
        return $datos;
    }
}