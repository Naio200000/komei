<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $producto = $id ? (new Producto)->productoID($id) : (new Producto);
    $datosPOST = $_POST;
    $caraval = $_POST['caraval'];
    $imagenes = $_POST['imagenes'];
    echo '<pre>';
    print_r($datosPOST);
    echo '</pre>';
    try {
        if (!$id) {
            $id_producto = $producto->insertProducto($datosPOST);
            foreach ($caraval as $cv) {
                (new Caraval)->insertRelacionProducto($id_producto, $cv);
            }
            foreach ($imagenes as $i) {
                (new Images)->insertRelacionProducto($id_producto, $i);
            }
        } else {
            if (!$del) {
                $producto->editProducto($datosPOST);
                (new Caraval)->deleteRelacionProducto($producto->getId());
                foreach ($caraval as $cv) {
                    (new Caraval)->insertRelacionProducto($producto->getId(), $cv);
                }

                (new Images)->deleteRelacionProducto($producto->getId());
                foreach ($imagenes as $i) {
                    (new Images)->insertRelacionProducto($producto->getId(), $i);
                }

            } else {
                (new Caraval)->deleteRelacionProducto($producto->getId());
                (new Images)->deleteRelacionProducto($producto->getId());
                $producto->deleteProducto();
            }
        }

        header('Location: ../index.php?view=producto');

    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '<pre>';
        die('No se pudo cargar la caraval');
    }
