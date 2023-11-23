<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $caraval = $id ? (new Caraval)->caravalID($id) : new Caraval();
    $datosPOST = $_POST;
    try {
        if (!$id) {
            $caraval->insertRelacion($datosPOST);
            (new Alert())->insertAlerta('success', "Se agrego una relacion correctamente");
        } else {
            if (!$del) {
                $caraval->editRelacion($datosPOST);
                (new Alert())->insertAlerta('success', "Se edito la relacion entre {$caraval->getName()->getName()} <=> {$caraval->getName()->getName()}");
            } else {
                $caraval->deleteRelacion();
                (new Alert())->insertAlerta('danger', "Se borro la relacion entre {$caraval->getName()->getName()} <=> {$caraval->getValor()->getValor()}");
            }
        }

        header('Location: ../index.php?view=caraval');

    } catch (Exception $e) {
        // echo '<pre>';
        // print_r($e);
        // echo '</pre>';
        // die('No se pudo cargar la Categoria');
        (new Alert())->insertAlerta('danger', "Hubo un error inesperado. Comunicarse con el Administrador de sistema.");
        header('Location: ../index.php?view=categoria');
    }
