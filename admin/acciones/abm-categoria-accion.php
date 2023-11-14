<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $categoria = $id ? (new Categoria)->categoriaID($id) : false;
    $datosPOST = $_POST;
    echo '<pre>';
    print_r($del);
    echo '<pre>';
    
    try {
        if (!$id) {
            (new Categoria)->insertCategoria($datosPOST['name'], $datosPOST['descript']);
        } else {
            if (!$del) {
                $categoria->editCategoria($datosPOST['name'], $datosPOST['descript']);
            } else {
                $categoria->deleteCategoria($id);
            }
        }

        header('Location: ../index.php?view=categoria');

    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '<pre>';
        die('No se pudo cargar la Categoria');
    }
