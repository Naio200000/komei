<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $producto = $id ? (new Producto)->productoID($id) : (new Producto);
    $datosPOST = $_POST;
    echo '<pre>';
    print_r($datosPOST);
    echo '</pre>';
    // try {
    //     if (!$id) {
            // $producto->insertProducto($datosPOST);
    //     } else {
    //         if (!$del) {
    //             $valor->editValor($datosPOST['valor']);
    //         } else {
    //             $valor->deleteValor();
    //         }
    //     }

        // header('Location: ../index.php?view=producto');

    // } catch (Exception $e) {
    //     echo '<pre>';
    //     print_r($e);
    //     echo '<pre>';
    //     die('No se pudo cargar la caraval');
    // }
