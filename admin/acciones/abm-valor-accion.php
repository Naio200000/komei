<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $valor = $id ? (new Valor)->valorID($id) : (new Valor);
    $datosPOST = $_POST;
    try {
        if (!$id) {
            $valor->insertValor($datosPOST['valor']);
        } else {
            if (!$del) {
                $valor->editValor($datosPOST['valor']);
            } else {
                $valor->deleteValor();
            }
        }

        header('Location: ../index.php?view=caraval');

    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '<pre>';
        die('No se pudo cargar la caraval');
    }
