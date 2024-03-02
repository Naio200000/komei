<?php

class Carrito {


    /**
     * Agrega items al carrito
     * @param int $idProducto Id del producto a agregar
     * @param int $cantidad Cantidad de productos
     */
    public function agregar_producto (int $idProducto, int $cantidad) {
        
        $datosProducto = (new Producto)->productoID($idProducto);

            echo "<pre>";
            print_r($datosProducto);
            echo "</pre>";

    }



}