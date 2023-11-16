<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    // $del = $_GET['del'] ?? FALSE;
    // $categoria = $id ? (new Categoria)->categoriaID($id) : false;
    $datosPOST = $_POST;
    // echo '<pre>';
    // print_r($dataPOST);
    // echo '</pre>';
    
    try {
        if (!$id) {
            $tipo = new Tipo();
            $id_tipo = $tipo->insertTipo($datosPOST);
            $tipo->insertTipoXCategoria($id_tipo, $datosPOST['id_categoria']);
        } else {
    // //         if (!$del) {
                $categoria->editTipo($datosPOST['name'], $datosPOST['descript']);
    // //         } else {
    // //             $categoria->deleteCategoria($id);
    // //         }
        }

        header('Location: ../index.php?view=tipo');

    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '</pre>';
        die('No se pudo cargar la Categoria');
    }
