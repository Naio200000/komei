<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $categoria = $id ? (new Categoria)->categoriaID($id) : (new Categoria);
    $datosPOST = $_POST; 
    try {
        if (!$id) {
            $categoria->insertCategoria($datosPOST['name'], $datosPOST['descript']);
        } else {
            if (!$del) {
                $categoria->editCategoria($datosPOST['name'], $datosPOST['descript']);
            } else {
                $categoria->deleteCategoria();
            }
        }

        header('Location: ../index.php?view=categoria');

    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '<pre>';
        die('No se pudo cargar la Categoria');
    }
