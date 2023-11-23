<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $tipo = $id ? (new Tipo)->tipoID($id) : new Tipo();
    $datosPOST = $_POST;

    // echo "<pre>";
    // print_r($datosPOST);
    // echo "</pre>";


    try {
        if (!$id) {
            echo "meg";
            $id_tipo = $tipo->insertTipo($datosPOST);
            $tipo->insertTipoXCategoria($id_tipo, $datosPOST['id_categoria']);
            (new Alert())->insertAlerta('success', "Se agrego un tipo correctamente");
        } else {
            if (!$del) {
                $tipo->editTipo($datosPOST);
                $tipo->editTipoXCategoria($datosPOST['id_categoria']);
                (new Alert())->insertAlerta('success', "Se edito el tipo {$tipo->getName()} correctamente");                
            } else {
                $tipo->deleteTipo();
                (new Alert())->insertAlerta('danger', "Se borro la el tipo {$tipo->getName()}");
            }
        }

        header('Location: ../index.php?view=tipo');

    } catch (Exception $e) {
        // echo '<pre>';
        // print_r($e);
        // echo '</pre>';
        // die('No se pudo cargar el Tipo');

        if ($e->getCode() == 23000) {
            (new Alert())->insertAlerta('danger', "El tipo {$tipo->getName()} no se pudo eliminaro porque esta asociada con un o mas Productos o a una Categoria.");
        } else {
            (new Alert())->insertAlerta('danger', "Hubo un error inesperado. Comunicarse con el Administrador de sistema.");
        }
        header('Location: ../index.php?view=tipo');
    }
