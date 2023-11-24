<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $images = $id ? (new Images)->imagenID($id) : (new Images);
    $datosPOST = $_POST;
    $datosImagen = $_FILES['imagen'] ?? '';
    if ($id) $datosPOST['id'] = $id;


    try {

        if ($del) {
            $images->deleteImagen();
            $images->deleteImagenFile(__DIR__ . "/../../img/productos/" . $datosPOST['imagen_og'] . ".webp");
            (new Alert())->insertAlerta('danger', "Se borro la Imagen");    
            header('Location: ../index.php?view=imagenes');
        } else {
            if ($images->validaImagen($id, $datosPOST, $datosImagen) ){
                $validData = $images->validaImagen($id, $datosPOST, $datosImagen);
                (new Validate)->inserForm($validData);
                (new Alert())->insertFormAlert($validData, 'danger', 'Debe llenar este camopo');
                header('Location: ../index.php?view=abm-imagenes');
            } elseif ($id) {
                if (!empty($datosImagen['tmp_name'])) {
                    $imgName = $images->uploadImagen(__DIR__ . "/../../img/productos", $datosImagen);
                    if (!empty($datosPOST['imagen_og'])) {
                        $images->deleteImagenFile(__DIR__ . "/../../img/productos/" . $datosPOST['imagen_og'] . ".webp");
                    }

                } else {
                    $imgName = $datosPOST['imagen_og'];
                }
                $images->editImagen( $imgName, $datosPOST['descript']);
                (new Alert())->insertAlerta('success', "Se edito la Imagen correctamente");
                header('Location: ../index.php?view=imagenes');
            } else {
                $imgName = $images->uploadImagen(__DIR__ . "/../../img/productos", $datosImagen);
                $images->insertImagen($datosPOST['descript'], $imgName);
                (new Alert())->insertAlerta('success', "Se agrego una nueva Imagen correctamente");
                header('Location: ../index.php?view=imagenes');
            }
        }

    

    } catch (Exception $e) {
        // echo '<pre>';
        // print_r($e);
        // echo '<pre>';
        // die('No se pudo cargar la Categoria');

        if ($e->getCode() == 23000) {
            (new Alert())->insertAlerta('danger', "La Imagen no se pudo eliminaro porque esta relacionada con un Producto.");
        } else {
            (new Alert())->insertAlerta('danger', "Hubo un error inesperado. Comunicarse con el Administrador de sistema.");
        }

        
        header('Location: ../index.php?view=imagenes');
    }
