<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $producto = $id ? (new Producto)->productoID($id) : (new Producto);
    $datosPOST = $_POST;
    $datosPOST['descript'] = $datosPOST['descriptcorta'] . ' ; ' . $datosPOST['descript'];
    $caraval = $_POST['caraval'];
    $imagenes = $_POST['imagenes'];

    echo "</br>";
    echo $datosPOST['descript'];

    try {
        if (!$id) {
            $id_producto = $producto->insertProducto($datosPOST);
            foreach ($caraval as $cv) {
                (new Caraval)->insertRelacionProducto($id_producto, $cv);
            }
            foreach ($imagenes as $i) {
                (new Images)->insertRelacionProducto($id_producto, $i);
            }
            (new Alert())->insertAlerta('success', "Se agrego un nuevo Producto correctamente");
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
                (new Alert())->insertAlerta('success', "Se edito el Producto {$producto->getNombre()} correctamente");
            } else {
                (new Caraval)->deleteRelacionProducto($producto->getId());
                (new Images)->deleteRelacionProducto($producto->getId());
                $producto->deleteProducto();
                (new Alert())->insertAlerta('danger', "Se borro la categoria {$producto->getNombre()}");
            }
        }

        header('Location: ../index.php?view=producto');

    } catch (Exception $e) {
        // echo '<pre>';
        // print_r($e);
        // echo '<pre>';
        // die('No se pudo cargar la caraval');
        (new Alert())->insertAlerta('danger', "Hubo un error inesperado. Comunicarse con el Administrador de sistema.");
        header('Location: ../index.php?view=producto');

    }
