<?php

    require_once "../../libraries/autoloader.php";

    $id = $_GET['id'] ?? false;
    $del = $_GET['del'] ?? false;
    $cantidad = $_GET['cantidad'];

    if ($del) {
        if ($id) {
            (new Carrito)->eliminarProductoId($id, $cantidad);
            header('location: ../../index.php?view=carrito');
        }
    } else {
        if ($id) {
            (new Carrito)->agregarProductoId($id, $cantidad);
            header('location: ../../index.php?view=carrito');
        }
        
    }