<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $caraval = $id ? (new Caracteristicas)->caravalID($id) : new Caracteristicas();
    $datosPOST = $_POST;
    // echo '<pre>';
    // print_r($caraval);
    // echo '</pre>';
    echo '<pre>';
    print_r($datosPOST);
    echo '</pre>';
    
    try {
        if (!$id) {
            $caraval->insertRelacion($datosPOST);
        } else {
            if (!$del) {
                $caraval->editRelacion($datosPOST);
                $tipo->editTipoXCategoria($datosPOST['id_categoria']);

            } else {
                $caraval->deleteRelacion();
            }
        }

        header('Location: ../index.php?view=caraval');

    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '</pre>';
        die('No se pudo cargar la Categoria');
    }
