<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $tipo = $id ? (new Tipo)->tipoID($id) : new Tipo();
    $datosPOST = $_POST;
    echo '<pre>';
    print_r($tipo);
    echo '</pre>';
    echo '<pre>';
    print_r($datosPOST);
    echo '</pre>';
    
    try {
        if (!$id) {
            $id_tipo = $tipo->insertTipo($datosPOST);
            $tipo->insertTipoXCategoria($id_tipo, $datosPOST['id_categoria']);
        } else {
            if (!$del) {
                $tipo->editTipo($datosPOST);
                $tipo->editTipoXCategoria($datosPOST['id_categoria']);

            } else {
                $tipo->deleteTipo();
            }
        }

        header('Location: ../index.php?view=tipo');

    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '</pre>';
        die('No se pudo cargar la Categoria');
    }
