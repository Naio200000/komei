<?php

    require_once "../../libraries/autoloader.php";

    $id = $_GET['id'] ?? false;
    $cantidad = $_GET['cantidad'];

    if ($id) {
        (new Carrito)->agregar_producto($id, $cantidad);
        header('location: ../../index.php?view=carrito');
    }