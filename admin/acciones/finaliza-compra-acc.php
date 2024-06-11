<?php

    require_once "../../libraries/autoloader.php";

    $carrito = (new Carrito)->get_carrito();
    $user = $_SESSION['user'] ?? false;




    try {
        if($user) {

            $datosCompra = [
                'id_usuario' => $user->getId(),
                'fecha' => date("Y-m-d"),
                'importe' => (new Carrito)->calculaTotal(),
            ];
            
            $datosDetalle = [];
            foreach ($carrito as $k => $v) {
                $datosDetalle[$k] = $v['cantidad'];
            }

            (new Compra)->insertCompra($datosCompra, $datosDetalle);
            (new Carrito)->vaciarCarrito();
            (new Alert())->insertAlerta('success', "Se ha realizado su compra con exito.");
            header('location: ../../index.php?view=perfilUsuario');

        } else {
            (new Alert())->insertAlerta('warning', "Tu Sesion has expirado. por favor vuelve a ingresar.");
            header('location: ../../index.php?view=login');
        }

    } catch (Exception $e) {
        // echo '<pre>';
        // print_r($e);
        // echo '</pre>';
        
        (new Alert())->insertAlerta('danger', "Hubo un error inesperado. No se pudo finalizar la compra. Pruebe mas tarde");
        header('Location: ../../index.php?view=finalizarCompra');
    }