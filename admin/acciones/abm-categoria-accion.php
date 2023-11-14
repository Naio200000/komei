<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $datosPOST = $_POST;
    // echo '<pre>';
    // print_r($datosPOST);
    // echo '<pre>';
    
    try {
        (new Categoria)->insertCategoria($datosPOST['name'], $datosPOST['descript']);

        header('Location: ../index.php?view=categoria');

    } catch (Exception $e) {
        die('No se pudo cargar la Categoria');
    }
echo "<pre>";
print_r($categoria);
echo "</pre>";