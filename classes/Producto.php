<?php


class Producto {

    private $id;
    private $nombre;
    private $descripCorta;
    private $descripLarga;
    private $etc;
    private $tiempo;
    private $precio;
    private $imagen;
    private $categoria;

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
        return $this->nombre;
    }

    /**
    * Obtiene el valor de descripCorta
    */ 
    public function getDescripCorta(){
        return $this->descripCorta;
    }

    /**
    * Obtiene el valor de descripLarga
    */ 
    public function getDescripLarga(){
        return $this->descripLarga;
    }

    /**
    * Obtiene el array de etc
    */ 
    public function getEtc(){
        return $this->etc;
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
    * Obtiene el valor de categoria
    */ 
    public function getCategoria(){
        return $this->categoria;
    }

    /**
    * Devuelve nuestro catalogo dependiendo de la categoria seleccionada.
    * @param string $categoria : Es un string de la categoría que estamos buescando.
    * @return array Un array de todos nuestros productos de la categoria seleccionada.
    */
    public function catalogoCompleto() :array {
        
        $productosOBJ = [];
        $productosJSON = file_get_contents('datos/productos.json');
        $productos = json_decode($productosJSON);
        foreach ($productos as $object) {
            $newObject = new self ();

            $newObject->id = $object->id;
            $newObject->nombre = $object->nombre;
            $newObject->descripCorta = $object->descrip;
            $newObject->descripLarga = $object->descrip_larga;
            $newObject->etc = $object->etc;
            $newObject->tiempo = $object->tiempo;
            $newObject->precio = $object->precio;
            $newObject->imagen = $object->imagen;
            $newObject->categoria = $object->categoria;

            $productosOBJ[] = $newObject;

        }
        usort($productosOBJ, array($this, 'comparar'));
        return $productosOBJ;
    }

    /**
    * Devuelve nuestro catalogo dependiendo de la categoria seleccionada.
    * @param string $categoria : Es un string de la categoría que estamos buescando.
    * @return array Un array de todos nuestros productos de la categoria seleccionada.
    */
    public function catalogoCategoria(string $categoria): array {

        $catalogoCategoria = [];
        $completo = $this->catalogoCompleto();

        foreach ($completo as $cate) {
            if ($cate->categoria == $categoria) {
                $catalogoCategoria[] = $cate;
            }
        }
        return $catalogoCategoria;

    }

    /**
     * Devuelve array de objetos Producto dependiendo del tipo de material
     * @param mixed $cate categoria por la cual filtrar todo los productos
     * @param mixed $etc el key dentro de los datos de  etc
     * @param ?string $filtrar el tipo de material que queremos filtrar
     * @return array $catalogoMaterial catalogo filtrado por material
     */
    public function filtrarCatalogo(mixed $cate = null, mixed $etc = null, mixed $filtrar = null): array {
            $catalogofiltrar = [];
            if ($cate) {
                $completo = $this->catalogoCategoria($cate);
                foreach($completo as $m) {
                    if (isset($m->etc->$etc)) {
                        if ($m->etc->$etc == $filtrar) {
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

        $formatear = (array)$this->$dato;
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

    function comparar($a, $b) {
        return $a->categoria <=> $b->categoria;
     }

}
