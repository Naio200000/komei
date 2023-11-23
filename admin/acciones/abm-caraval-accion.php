<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $caraval = $id ? (new Caraval)->caravalID($id) : new Caraval();
    $datosPOST = $_POST;
    try {
        if (!$id) {
            $caraval->insertRelacion($datosPOST);
            (new Alert())->insertAlerta('success', "Se agrego una Relacion correctamente");
        } else {
            if (!$del) {
                $caraval->editRelacion($datosPOST);
                (new Alert())->insertAlerta('success', "Se edito la Relacion entre {$caraval->getName()->getName()} <=> {$caraval->getName()->getName()}");
            } else {
                $caraval->deleteRelacion();
                (new Alert())->insertAlerta('danger', "Se borro la Relacion entre {$caraval->getName()->getName()} <=> {$caraval->getValor()->getValor()}");
            }
        }

        header('Location: ../index.php?view=caraval');

    } catch (Exception $e) {
        // echo '<pre>';
        // print_r($e);
        // echo '</pre>';
        // die('No se pudo cargar la Categoria');
        if ($e->getCode() == 23000) {
            (new Alert())->insertAlerta('danger', "La Relacion entre {$caraval->getName()->getName()} <=> {$caraval->getValor()->getValor()}no se pudo eliminaro porque esta asociada con un o mas Productos.");
        } else {
            (new Alert())->insertAlerta('danger', "Hubo un error inesperado. Comunicarse con el Administrador de sistema.");
        }

        header('Location: ../index.php?view=caraval');
    }
