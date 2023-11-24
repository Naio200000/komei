<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $valor = $id ? (new Valor)->valorID($id) : (new Valor);
    $datosPOST = $_POST;
    if ($id) $datosPOST['id'] = $id;


    /**
     * Verifica los datos del formulario y actua acorde si tiene que agregar borrar o modificar
     * y si hay algun problema devuelve los mensajes
     */
    try {
        if ($del) {
            $valor->deleteValor();
            (new Alert())->insertAlerta('danger', "Se borro le Valor {$valor->getValor()}");     
            header('Location: ../index.php?view=caraval');
        } else {
            if (empty($datosPOST['valor'])) {
                (new Validate)->inserForm($datosPOST);
                (new Alert())->insertFormAlert($datosPOST, 'danger', 'Debe llenar este camopo');
                header('Location: ../index.php?view=abm-valor');
            } elseif ($id) {
                $valor->editValor($datosPOST['valor']);
                (new Alert())->insertAlerta('success', "Se edito el Valor {$valor->getValor()} correctamente");
                header('Location: ../index.php?view=caraval');
            } else {
                $valor->insertValor($datosPOST['valor']);
                (new Alert())->insertAlerta('success', "Se agrego un nuev Valor correctamente");
                header('Location: ../index.php?view=caraval');
            }
        }

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
