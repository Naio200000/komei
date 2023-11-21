<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $Caracteristica = $id ? (new Caracteristica)->CaracteristicaID($id) : (new Caracteristica);
    $datosPOST = $_POST;
    echo '<pre>';
    print_r($caraval);
    echo '<pre>';
    echo '<pre>';
    print_r($datosPOST);
    echo '<pre>';
    
    try {
        if (!$id) {
            $Caracteristica->insertCaracteristica($datosPOST['name']);
        } else {
            if (!$del) {
                $Caracteristica->editCaracteristica($datosPOST['name']);
            } else {
                $Caracteristica->deleteCaracteristica();
            }
        }

        header('Location: ../index.php?view=caraval');

    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '<pre>';
        die('No se pudo cargar la caraval');
    }
