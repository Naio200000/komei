<?php
    require_once "../../libraries/autoloader.php";
    $datosPOST = $_POST;

    if (!empty($datosPOST)) {

        (new Carrito)->actualizaCantidad($datosPOST);
        header('Location: ../../index.php?view=carrito');
    }
