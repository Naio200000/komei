<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $images = $id ? (new Images)->imagenID($id) : (new Images);
    $datosPOST = $_POST;
    $datosImagen = $_FILES['imagen'] ?? '';
    // echo '<pre>';
    // echo $id;
    // print_r($datosPOST);
    // print_r($datosImagen);
    // echo '</pre>';
    try {
        if (!$id) {
            $imgName = $images->uploadImagen(__DIR__ . "/../../img/productos", $datosImagen);
            $images->insertImagen($datosPOST['descript'], $imgName);
        } else {
            if (!$del) {
                if (!empty($datosImagen['tmp_name'])) {
                    $imgName = $images->uploadImagen(__DIR__ . "/../../img/productos", $datosImagen);
                    if (!empty($datosPOST['imagen_og'])) {
                        $images->deleteImagenFile(__DIR__ . "/../../img/productos/" . $datosPOST['imagen_og'] . ".webp");
                    }
                } else {
                    $imgName = $datosPOST['imagen_og'];
                }
                $images->editImagen( $imgName, $datosPOST['descript']);
            } else {
                $images->deleteImagenFile(__DIR__ . "/../../img/productos/" . $datosPOST['imagen_og'] . ".webp");
                $images->deleteImagen();
            }
        }

        header('Location: ../index.php?view=imagenes');

    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '<pre>';
        die('No se pudo cargar la caraval');
    }
