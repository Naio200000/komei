<?php

class Compra {

    /**
     * Ingresa los datos de la compra en la DB
     * @param array $datosCompra datos de la compra
     * @param array $datosDetalle datos del detalle de la compra
     */
    public function insertCompra(array $datosCompra, array $datosDetalle) {

        $conexion = Conexion::getConexion();
        $query = "INSERT INTO compras VALUES (NULL, :id_usuario, :fecha, :importe)";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'id_usuario' => $datosCompra['id_usuario'],
                'fecha' => $datosCompra['fecha'],
                'importe' => $datosCompra['importe'],
            ]
        );

        $idCompra = $conexion->lastInsertId();

        foreach ($datosDetalle as $k => $v) {
            $query = "INSERT INTO producto_x_compra VALUES (NULL, :id_producto, :id_compra, :cantidad)";
            
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute(
                [
                    'id_producto' => $k,
                    'id_compra' => $idCompra,
                    'cantidad' => $v,
                ]
            );
        }
    }
}