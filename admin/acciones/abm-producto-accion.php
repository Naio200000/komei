<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $producto = $id ? (new Producto)->productoID($id) : (new Producto);
    $datosPOST = $_POST;
    $caraval = $_POST['caraval'];
    echo '<pre>';
    print_r($datosPOST);
    echo '</pre>';
    // try {
    //     if (!$id) {
            $id_producto = $producto->insertProducto($datosPOST);
            foreach ($caraval as $cv) {
                (new Caraval)->insertRelacionProducto($id_producto, $cv);
            }
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
