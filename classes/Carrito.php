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
     * Elimina un item de la lista de compras
     * @param int $idProducto el ID del producto a eliminar
     */
    public function eliminarProductoId (int $idProducto) { 

        if (isset($_SESSION['carrito'][$idProducto])) {
            unset($_SESSION['carrito'][$idProducto]);
        }

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


}