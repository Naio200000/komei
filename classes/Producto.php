<?php


class Producto {

    private $id;
    private $name;
    private $descript;
    private $categoria;
    private $precio;
    private $tipo;
    private $caracteristicas;
    private $tiempo;
    private $imagen;

    private static $staticValues = ['id', 'name', 'descript', 'precio', 'tiempo'];

    /**
    * Obtiene el valor de id
    */ 
    public function getId(){
        return $this->id;
    }

    /**
    * Obtiene el valor de nombre
    */ 
    public function getNombre(){
        return $this->name;
    }

    /**
    * Obtiene el valor de descrip
    */ 
    public function getDescrip(){
        return $this->descript;
    }

    /**
    * Obtiene el array de caracteristicas
    *@return array array de caracteristicas con sus valores
    */ 
    public function getCaracteristicas(){
        return $this->caracteristicas;
    }
   
    /**
    * Obtiene el valor de tiempo
    */ 
    public function getTiempo(){
        return $this->tiempo;
    }
    
    /**
    * Obtiene el valor de precio
    */ 
    public function getPrecio(){
        return $this->precio;
    }

    /**
    * Obtiene  el array de imagenes
    */ 
    public function getImagen(){
        return $this->imagen;
    }

    /**
    * Obtiene el valor de tipo
    */ 
    public function getTipo(){
        return $this->tipo;
    }

    /**
     * Get the value of categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Inserta una instacia de producto en la bd
     * @param array $datosPro datos para agregar al producto
     * @return int numero de ID del ultimo producto agregado
     */
    public function insertProducto($datosPro) :int {

        $conexion = Conexion::getConexion();
        $query = "INSERT INTO `productos` (`name`, `descript`, `id_tipo`, `precio` ) VALUES (:nombre , :descript, :id_tipo, :precio);";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'nombre' => $datosPro['name'],
                'descript' => $datosPro['descript'],
                'id_tipo' => $datosPro['id_tipo'],
                'precio' => $datosPro['precio']
            ]
        );
        return $conexion->lastInsertId();
    }

    /**
     * Inserta una instacia de producto en la bd
     * @param array $datosPro datos para editar al producto

     */
    public function editProducto($datosPro)  {

        $conexion = Conexion::getConexion();
        $query = "UPDATE `productos` SET name = :nombre, descript = :descript, id_tipo = :id_tipo, precio = :precio WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id' => $this->id,
                'nombre' => $datosPro['name'],
                'descript' => $datosPro['descript'],
                'id_tipo' => $datosPro['id_tipo'],
                'precio' => $datosPro['precio']
            ]
        );
    }

    /**
     * Borra esta Imagen
     */
    public function deleteProducto () {

        $conexion = Conexion::getConexion();
        $query = "DELETE FROM productos WHERE id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id,]);
    }


    public function validaProducto(array $dataPost) :?array {
        if (
            !array_key_exists('caraval', $dataPost)
            || !array_key_exists('caraval', $dataPost)
            || !array_key_exists('imagenes', $dataPost)
            || !array_key_exists('id_tipo', $dataPost)
            || empty($dataPost['precio'])
            || ($dataPost['descript'] == ' ; ')
            || empty($dataPost['name'])
            || empty($dataPost['id_tipo'])
            || empty($dataPost['precio'])
            || empty($dataPost['descriptcorta']) ) {
                if (!array_key_exists('caraval', $dataPost)) {
                    $dataPost['caraval'] = '';   
                }
                if (!array_key_exists('imagenes', $dataPost)) {
                    $dataPost['imagenes'] = '';
                }
                if (!array_key_exists('id_tipo', $dataPost)) {
                    $dataPost['id_tipo'] = '';
                }
                if (empty($dataPost['precio']) !== '0') {
                    if (intval(($dataPost['precio']) == 0)) {
                        (new Alert())->insertFormAlert($dataPost, 'danger', 'El precio debe ser un Numero');
                    }
                }
                if ($dataPost['descript'] == ' ; ') {
                    $dataPost['descript'] = '';
                }
            
                return $dataPost;
            }
        return null;
    }

    /**
    * Devuelve nuestro catalogo dependiendo de la categoria seleccionada.
    * @param bool $bool parametro para ordenar o no la lista
    * @return array Un array de todos nuestros productos de la categoria seleccionada.
    */
    public function catalogoCompleto(bool $orden = true) :array {
        
        $conexion = Conexion::getConexion();
        // Hay que re hacer este query porque trae porqueria y solo funciona por el formateador
        $query = "SELECT p.id, p.name, p.descript, txc.id_categoria as categoria, p.precio, p.id_tipo AS tipo, GROUP_CONCAT(DISTINCT cxp.id_cate_valor SEPARATOR '|') AS caracteristicas, CONCAT_WS(' ', d.seminario, d.resto) as tiempo, GROUP_CONCAT(DISTINCT ixp.id_imagen SEPARATOR '|') AS imagen FROM productos AS p JOIN tipos AS t ON p.id_tipo = t.id JOIN disponibilidad AS d ON t.id_disponible = d.id LEFT JOIN tipo_x_categorias AS txc ON t.id = txc.id_tipo LEFT JOIN caraval_x_producto AS cxp ON p.id = cxp.id_producto LEFT JOIN imagenes_x_productos AS ixp ON p.id = ixp.id_producto Group by p.id ORDER BY p.id DESC;";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();
        while ($datos = $PDOStatement->fetch()) {
            $catalogo[] = $this->formateaProducto($datos);
        };


        if ($orden) {
            $ordenado = $this->ordenarOBJ($catalogo);
            return $ordenado;
        }

        return $catalogo;
    }

    /**
    * Devuelve nuestro catalogo dependiendo de la categoria seleccionada.
    * @param string $categoria : Es un string de la categoría que estamos buescando.
    * @param bool $bool parametro para ordenar o no la lista
    * @return array Un array de todos nuestros productos de la categoria seleccionada.
    */
    private function catalogoCategoria(string $categoria, bool $orden = true): array {

        


        $conexion = Conexion::getConexion();
        // Hay que re hacer este query porque trae porqueria y solo funciona por el formateador
        $query = "SELECT p.id, p.name, p.descript, txc.id_categoria as categoria, p.precio, p.id_tipo AS tipo, GROUP_CONCAT(DISTINCT cxp.id_cate_valor SEPARATOR '|') AS caracteristicas, CONCAT_WS(' ', d.seminario, d.resto) as tiempo, GROUP_CONCAT(DISTINCT ixp.id_imagen SEPARATOR '|') AS imagen FROM productos AS p JOIN tipos AS t ON p.id_tipo = t.id JOIN disponibilidad AS d ON t.id_disponible = d.id LEFT JOIN tipo_x_categorias AS txc ON t.id = txc.id_tipo JOIN categorias AS c ON txc.id_categoria = c.id LEFT JOIN caraval_x_producto AS cxp ON p.id = cxp.id_producto LEFT JOIN imagenes_x_productos AS ixp ON p.id = ixp.id_producto WHERE c.name = ? Group by p.id ORDER BY p.id DESC;";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$categoria]);
        while ($datos = $PDOStatement->fetch()) {
            $catalogo[] = $this->formateaProducto($datos);
        };

        if ($orden) {
            $ordenado = [];
            if (!empty($catalogo)){
                $ordenado = $this->ordenarOBJ($catalogo);
            }
    
            return $ordenado;
        }

        return $catalogo;

    }
    /**
     * Formatea los datos del producto para que contenga los objetos de las otras clases
     * @param array $datos Array de los datos que llegan de la BD
     * @return Producto Objto producto formateado donde los datos son objetos
     */
    private function formateaProducto (array $datos) :Producto {

        $producto = new self();

        foreach (self::$staticValues as $v) {
            $producto->{$v} = $datos[$v];
        }
        $producto->categoria = (new Categoria)->categoriaID($datos['categoria']);
        $producto->tipo = (new Tipo)->tipoID($datos['tipo']);
        $arrayIDcara = explode('|', $datos['caracteristicas']);
        foreach($arrayIDcara as $id) {
            $OBJcaracteristicas[] = (new Caraval())->caravalID(intval($id));
        }
        $producto->caracteristicas = $OBJcaracteristicas;
        $producto->imagen  = (new Images())->imagenesProducto($producto->id);

        return $producto;
    }

    /**
     * Devuelve array de objetos Producto dependiendo del tipo de material
     * @param bool $orden booleano para saber si se ordena o no la lista
     * @param ?string $cate categoria por la cual filtrar todo los productos
     * @param ?string tipo a filtrar
     * @return array $catalogoMaterial catalogo filtrado por material
     */
    public function filtrarCatalogo(bool $orden = true, mixed $cate = null, mixed $type = null): array {

            $catalogofiltrar = [];
            if ($cate) {
                $completo = $this->catalogoCategoria($cate, $orden);

                foreach($completo as $m) {
                    if ($m->getTipo()->getId() == $type) {
                        $catalogofiltrar[] = $m;
                    }
                }
            } else {

                return $this->catalogoCompleto($orden);
            }
            if (!$type) {
                return $completo;
            }
            
            return $catalogofiltrar;
    }

    /**
    * Decuelve un producto dependiendo de su ID;
    * @param int $id : ID unico de cada producto.
    * @return Producto Un array con el producto encontrado o null si no encuentra nada. 
    */
    public function productoID (int $id):?Producto {

        $conexion = Conexion::getConexion();
        // Hay que re hacer este query porque trae porqueria y solo funciona por el formateador
        $query = "SELECT p.id, p.name, p.descript, txc.id_categoria as categoria, p.precio, p.id_tipo AS tipo, GROUP_CONCAT(DISTINCT cxp.id_cate_valor SEPARATOR '|') AS caracteristicas, CONCAT_WS(' ', d.seminario, d.resto) as tiempo, GROUP_CONCAT(DISTINCT ixp.id_imagen SEPARATOR '|') AS imagen FROM productos AS p JOIN tipos AS t ON p.id_tipo = t.id JOIN disponibilidad AS d ON t.id_disponible = d.id LEFT JOIN tipo_x_categorias AS txc ON t.id = txc.id_tipo LEFT JOIN caraval_x_producto AS cxp ON p.id = cxp.id_producto LEFT JOIN imagenes_x_productos AS ixp ON p.id = ixp.id_producto WHERE p.id = ? Group by p.id;";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$id]);
        $datos = $this->formateaProducto($PDOStatement->fetch());
        return $datos ?? null; 
    }

    /**
     * Devuelve un string recortado la descripcion
     * @param boolean $a : Se es FALSE devuelve la primera parte de la descipcion (corta) si es TRUE devuelve la descripcion larga
     * @return string descripcion formateada
     */
    public function formatearDescript($a = FALSE) :string{

        $text = $this->descript;
        $descript = explode(';', $text);
        if (!$a) {
            return $descript[0];
        } else {
            return $descript[1];
        }
    }

    /**
    * Devuelve el precio de la unidad, formateado correctamente
    */
    public function formatearPrecio() :string {
        return number_format($this->precio, 2,",",".");
    }

     /**
      * Hay que reformatear esta funcion para que si un producto tiene mas de 
      * una de la misma caracteristica traiga todos los valores
      */

    /**
     * Formatea los datos de etc en un array asociativo para ser mostrados
     * @return array array con los datos de etc con key y valor
     */
    public function formatearCaravalOBJ() :array {
        $formatear = $this->getCaracteristicas();
        $datosAFormatear = [];
        foreach ($formatear as $v) {
            if($v->getName()->getName() == 'semanal') {
                if ($this->getTipo()->getName() == 'Seminario') {
                    $datosAFormatear['Clases'] = $v->getValor()->getValor() . "  Clases";
                } else {
                    $datosAFormatear['Clases'] = $v->getValor()->getValor() . "  por semana";
                }
            } else {
                $datosAFormatear[$v->getName()->getName()] = $v->getValor()->getValor();
            }
        }
        return $datosAFormatear;
    }

    /**
     * da formato al dato de tiempo que se encuenta en el objeto
     * @return string calcula la fecha dependiendo de un valor que se encuentra en el objeto y la devuelve.
     */
    public function formatearFecha():string {
        if ($this->getCategoria() == 'clases'){
            if ($this->tiempo == 0) {
                return 'Todos los días';
            } else {
                return date('m/y', strtotime($this->tiempo));
            }
        } else {
            $date = Date('d-m-Y');
            $dias = $this->tiempo;
            return date('d/m/Y', strtotime($date . " + $dias days"));
        }

    }
    /**
     * Ordena los objetos por Tipo y luego por Categoria
     * @param array array de objetos Producto
     */
    private function ordenarOBJ(array $array) {
        usort($array, array($this, 'compararTipo'));
        usort($array, array($this, 'compararCate'));
        return $array;
    }
    /**
     * Funcion que compara valores. Se usa en conjunto con usort() para ordenar los valores
     */
    private function compararCate($a, $b) {
        return $a->categoria->getId() <=> $b->categoria->getId();
     }

    /**
     * Funcion que compara valores. Se usa en conjunto con usort() para ordenar los valores
     */
    private function compararTipo($a, $b) {
        return $a->tipo->getId() <=> $b->tipo->getId();
     }


}