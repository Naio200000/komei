<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $Caracteristica = $id ? (new Caracteristica)->CaracteristicaID($id) : (new Caracteristica);
    $datosPOST = $_POST;
    if ($id) $datosPOST['id'] = $id;



    /**
     * Verifica los datos del formulario y actua acorde si tiene que agregar borrar o modificar
     * y si hay algun problema devuelve los mensajes
     */
    try {
        if ($del) {
            $Caracteristica->deleteCaracteristica();
            (new Alert())->insertAlerta('danger', "Se borro la Categoria {$Caracteristica->getName()}");       
            header('Location: ../index.php?view=caraval');
        } else {
            if (empty($datosPOST['name'])) {
                (new Validate)->inserForm($datosPOST);
                (new Alert())->insertFormAlert($datosPOST, 'danger', 'Debe llenar este camopo');
                header('Location: ../index.php?view=abm-caracteristica');
            } elseif ($id) {
                $Caracteristica->editCaracteristica($datosPOST['name']);
                (new Alert())->insertAlerta('success', "Se edito la Caracteristica {$Caracteristica->getName()} correctamente");
                header('Location: ../index.php?view=caraval');
            } else {
                $Caracteristica->insertCaracteristica($datosPOST['name']);
                (new Alert())->insertAlerta('success', "Se agrego una nueva Caracteristica correctamente");
                header('Location: ../index.php?view=caraval');
            }
        }

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