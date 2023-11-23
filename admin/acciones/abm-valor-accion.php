<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $valor = $id ? (new Valor)->valorID($id) : (new Valor);
    $datosPOST = $_POST;
    try {
        if (!$id) {
            $valor->insertValor($datosPOST['valor']);
            (new Alert())->insertAlerta('success', "Se agrego un nuev Valor correctamente");
        } else {
            if (!$del) {
                $valor->editValor($datosPOST['valor']);
                (new Alert())->insertAlerta('success', "Se edito el Valor {$valor->getValor()} correctamente");
            } else {
                $valor->deleteValor();
                (new Alert())->insertAlerta('danger', "Se borro le Valor {$valor->getValor()}");
            }
        }

        header('Location: ../index.php?view=caraval');

    } catch (Exception $e) {
        // echo '<pre>';
        // print_r($e);
        // echo '<pre>';
        // die('No se pudo cargar la caraval');

        if ($e->getCode() == 23000) {
            (new Alert())->insertAlerta('danger', "El Valor {$valor->getValor()} no se pudo eliminaro porque esta relacionada con alguna Caracteristica.");
        } else {
            (new Alert())->insertAlerta('danger', "Hubo un error inesperado. Comunicarse con el Administrador de sistema.");
        }

        
        header('Location: ../index.php?view=caraval');
    }
