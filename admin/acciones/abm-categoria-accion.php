<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $categoria = $id ? (new Categoria)->categoriaID($id) : (new Categoria);
    $datosPOST = $_POST; 
    try {
        if (!$id) {
            $categoria->insertCategoria($datosPOST['name'], $datosPOST['descript']);
            (new Alert())->insertAlerta('success', "Se agrego la categoria {$categoria->getName()} correctamente");
        } else {
            if (!$del) {
                $categoria->editCategoria($datosPOST['name'], $datosPOST['descript']);  
                (new Alert())->insertAlerta('success', "Se edito la categoria {$categoria->getName()} correctamente");
            } else {
                $categoria->deleteCategoria();
                (new Alert())->insertAlerta('danger', "Se borro la categoria {$categoria->getName()}");
            }
        }

        header('Location: ../index.php?view=categoria');

    } catch (Exception $e) {
        // echo '<pre>';
        // print_r($e);
        // echo '<pre>';
        // die('No se pudo cargar la Categoria');
        (new Alert())->insertAlerta('danger', "Hubo un error inesperado. Comunicarse con el Administrador de sistema.");
        header('Location: ../index.php?view=categoria');
    }
