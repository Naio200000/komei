<?php

class Carrito {


    /**
     * Agrega items al carrito
     * @param int $idProducto Id del producto a agregar
     * @param int $cantidad Cantidad de productos
     */
    public function agregarProductoId (int $idProducto, int $cantidad) {
        
        $datosProducto = (new Producto)->productoID($idProducto);

            if($datosProducto) {
                $_SESSION['carrito'][$idProducto] = [
                    'nombre' => $datosProducto->getNombre(),
                    'imagen' => $datosProducto->getImagen()[0],
                    'precio' => $datosProducto->getPrecio(),
                    'cantidad' => $cantidad
                ];
            }
    }

    /**
     * Actualiza las cantidades de los productos del carrito, si la cantidad es 0 ejecuta el metodo eliminarProductoId
     * @param array array de productos y sus cantidades.
     */
    public function actualizaCantidad(array $cantidades){

        foreach($cantidades as $k => $c) {
            if(isset($_SESSION['carrito'][$k])) {
                if ($c == 0) {
                    $this->eliminarProductoId($k);
                } else {
                    $_SESSION['carrito'][$k]['cantidad'] = $c;
                }
            }
        }
    }

    /**
     * Elimina un item de la lista de compras
     * @param int $idProducto el ID del producto a eliminar
     */
    public function eliminarProductoId (int $idProducto) { 

        if (isset($_SESSION['carrito'][$idProducto])) {
            unset($_SESSION['carrito'][$idProducto]);
        }

    }

    public function vaciarCarrito() {

        $_SESSION['carrito'] = [];
    }

    /**
     * Devuelve el contenido del carrito que se encuentre guardado en la SESSION
     * #@return array El contenido del carrito en la SESSIOn o un array vacio.
     */
    public function get_carrito() :array {

        if (!empty($_SESSION['carrito'])) {
            return $_SESSION['carrito'];
        }
        return [];
    }


    /**
     * Calcula el total del precio del carrito actual
     */
    public function calculaTotal() :float {

        $total = 0;
        if(!empty($_SESSION['carrito'])) {

            foreach($_SESSION['carrito'] as $c) {
                $total += $c['precio'] * $c['cantidad'];
            }
        }        

        return $total;

    }


}