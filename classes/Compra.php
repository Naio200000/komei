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

    /**
     * Retorna todas las compras realizadas por un usuario segun su ID
     * @param int $userId id del usuario
     * @return array array de compras o null si no encuentra nada.
     */
    public function comprasUserId(int $userId) :array {

        $conexion = Conexion::getConexion();
        $query = "SELECT c.id, c.fecha, c.importe, GROUP_CONCAT(pxc.cantidad) AS Cantidad, GROUP_CONCAT(p.name) AS Detalle FROM compras AS c  JOIN producto_x_compra AS pxc ON c.id = pxc.id_compra JOIN productos AS p ON pxc.id_producto = p.id WHERE c.id_usuario = ? GROUP BY c.id;";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$userId]);

        while($datos = $PDOStatement->fetch()) {
            $compras[] = $this->formateCompra($datos);
        }
        

        return $compras ?? null;
    }

    private function formateCompra(array $datos)  {

        $cantidad = explode(',', $datos['Cantidad']); 
        $detalle = explode(',', $datos['Detalle']);
        $c = count($cantidad);
        for ($i=0; $i < $c ; $i++) { 
            $datos['detcan'][$detalle[$i]] = $cantidad[$i];
        }
        return $datos;
    }
}
    
    
