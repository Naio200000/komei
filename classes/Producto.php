<?php


class Producto {

    private $id;
    private $nombre;
    private $descripCorta;
    private $descripLarga;
    private $personas;
    private $material;
    private $color;
    private $precio;
    private $imagen;
    private $altImagen;
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
    * Obtiene el valor de material
    */ 
    public function getPersonas(){
        return $this->personas;
    }
   
    /**
    * Obtiene el valor de material
    */ 
    public function getMaterial(){
        return $this->material;
    }

    /**
    * Obtiene el valor de material
    */ 
    public function getColor(){
        return $this->color;
    }
    
    /**
    * Obtiene el valor de precio
    */ 
    public function getPrecio(){
        return $this->precio;
    }

    /**
    * Obtiene la primer imagen
    */ 
    public function get1Imagen(){
        return $this->imagen[0];
    }

    /**
    * Obtiene el valor del alt de la primera imagen
    */ 
    public function get1AltImagen(){
        return $this->altImagen[0];
    }

    /**
    * Obtiene  el array de imagenes
    */ 
    public function getImagen(){
        return $this->imagen;
    }

    /**
    * Obtiene el array de altImgen
    */ 
    public function getAltImagen(){
        return $this->altImagen;
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
            $newObject->personas = $object->personas;
            $newObject->material = $object->material;
            $newObject->color = $object->color;
            $newObject->precio = $object->precio;
            $newObject->imagen = $object->imagen;
            $newObject->altImagen = $object->altImagen;
            $newObject->categoria = $object->categoria;

            $productosOBJ[] = $newObject;

        }
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
}