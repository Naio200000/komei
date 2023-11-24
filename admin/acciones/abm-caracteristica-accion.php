<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $Caracteristica = $id ? (new Caracteristica)->CaracteristicaID($id) : (new Caracteristica);
    $datosPOST = $_POST;

    try {
        if (!$id) {
            $Caracteristica->insertCaracteristica($datosPOST['name']);
            (new Alert())->insertAlerta('success', "Se agrego una nueva Caracteristica correctamente");
        } else {
            if (!$del) {
                $Caracteristica->editCaracteristica($datosPOST['name']);
                (new Alert())->insertAlerta('success', "Se edito la Caracteristica {$Caracteristica->getName()} correctamente");
            } else {
                $Caracteristica->deleteCaracteristica();
                (new Alert())->insertAlerta('danger', "Se borro la Categoria {$Caracteristica->getName()}");
            }
        }

        header('Location: ../index.php?view=caraval');

    } catch (Exception $e) {
        // echo '<pre>';
        // print_r($e);
        // echo '<pre>';
        // die('No se pudo cargar la caraval');

        if ($e->getCode() == 23000) {
            (new Alert())->insertAlerta('danger', "La Caracteristica {$Caracteristica->getName()} no se pudo eliminaro porque esta relacionada con algun Valor.");
        } else {
            (new Alert())->insertAlerta('danger', "Hubo un error inesperado. Comunicarse con el Administrador de sistema.");
        }

        
        header('Location: ../index.php?view=caraval');
    }
