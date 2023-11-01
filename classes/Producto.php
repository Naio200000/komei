<?php


class Producto {

    private $id;
    private $name;
    private $descript;
    private $id_categoria;
    private $precio;
    private $tipo;
    private $caracteristicas;
    private $tiempo;
    private $imagen;

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

        $arrayID = explode('|', $this->caracteristicas);
        foreach($arrayID as $id) {
            $OBJcaracteristicas = (new Caracteristicas())->caravalID($id);
            $caracteristicas[$OBJcaracteristicas->getName()] = $OBJcaracteristicas->getValor();
        }

        return $caracteristicas;
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
        $imagenes = (new Images())->imagenesProducto($this->id);
        foreach ($imagenes as $imagen){
            $arrayImg[$imagen->getName()] = $imagen->getDescript();
        }
        return $arrayImg;
    }

    /**
    * Obtiene el valor de tipo
    */ 
    public function getTipo(){
        return $this->tipo;
    }
    /**
    * Obtiene el valor de categoria
    */ 
    public function getId_Categoria(){
        $categoria = (new Categoria())->categoriaID($this->id_categoria);
        return $categoria->getName();
    }

    /**
    * Devuelve nuestro catalogo dependiendo de la categoria seleccionada.
    * @param string $categoria : Es un string de la categoría que estamos buescando.
    * @return array Un array de todos nuestros productos de la categoria seleccionada.
    */
    public function catalogoCompleto() :array {
        
        $conexion = (new Conexion())->getConexion();
        $query = "SELECT p.id, p.name, p.descript, p.id_categoria, p.precio, t.name AS tipo, GROUP_CONCAT(DISTINCT cxp.id_cate_valor SEPARATOR '|') AS caracteristicas, CONCAT_WS(' ', d.seminario, d.resto) as tiempo, GROUP_CONCAT(DISTINCT ixp.id_imagen SEPARATOR '|') AS imagen FROM productos AS p JOIN tipos AS t ON p.id_tipo = t.id LEFT JOIN caraval_x_producto AS cxp ON p.id = cxp.id_producto JOIN disponibilidad AS d ON t.id_disponible = d.id LEFT JOIN imagenes_x_productos AS ixp ON p.id = ixp.id_producto Group by p.id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        $datos = $PDOStatement->fetchAll();

        $ordenado = $this->ordenarOBJ($datos);


        return $ordenado;
    }

    /**
    * Devuelve nuestro catalogo dependiendo de la categoria seleccionada.
    * @param string $categoria : Es un string de la categoría que estamos buescando.
    * @return array Un array de todos nuestros productos de la categoria seleccionada.
    */
    private function catalogoCategoria(string $categoria): array {

        $catalogoCategoria = [];
        $completo = $this->catalogoCompleto();
        foreach ($completo as $cate) {
            if ($cate->getId_Categoria() == $categoria) {
                $catalogoCategoria[] = $cate;
            }
        }
        return $catalogoCategoria;

    }

    /**
     * Devuelve array de objetos Producto dependiendo del tipo de material
     * @param ?mixed $cate categoria por la cual filtrar todo los productos
     * @param ?mixed $etc el key dentro de los datos de  etc
     * @param ?mixed $filtrar el tipo de material que queremos filtrar
     * @return array $catalogoMaterial catalogo filtrado por material
     */
    public function filtrarCatalogo(mixed $cate = null, mixed $etc = null, mixed $filtrar = null): array {
            $catalogofiltrar = [];
            if ($cate) {
                $completo = $this->catalogoCategoria($cate);
                foreach($completo as $m) {
                    if (isset($m->getCaracteristicas()[$etc])) {
                        if ($m->getCaracteristicas()[$etc] == $filtrar) {
                            $catalogofiltrar[] = $m;
                        }
                    }
                }
            } else {
                return $this->catalogoCompleto();
            }
            if (!$etc) {
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

        $completo = $this->catalogoCompleto();

        foreach ($completo as $producto) {
            if ($producto->id == $id) {
                return $producto;
            }
        }

        return null; 
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
     * Formatea los datos de etc en un array asociativo para ser mostrados
     * @return array array con los datos de etc con key y valor
     */
    public function formatearSTNOBJ(string $dato) :array {

        $formatear = $this->getCaracteristicas();
        $datosAFormatear = [];
        foreach ($formatear as $k => $v) {
            if($k == 'semanal') {
                $datosAFormatear['Clases'] = $v . "  por semana.";
            } else {
                $datosAFormatear[$k] = $v;
            }
        }
        return $datosAFormatear;
    }

    /**
     * da formato al dato de tiempo que se encuenta en el objeto
     * @return string calcula la fecha dependiendo de un valor que se encuentra en el objeto y la devuelve.
     */
    public function formatearFecha():string {
        if ($this->getId_Categoria() == 'clases'){
            if ($this->tiempo == 0) {
                return 'Todos los días';
            } else {
                return $this->tiempo;
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
        return $a->id_categoria <=> $b->id_categoria;
     }

    /**
     * Funcion que compara valores. Se usa en conjunto con usort() para ordenar los valores
     */
    private function compararTipo($a, $b) {
        return $a->tipo <=> $b->tipo;
     }

}