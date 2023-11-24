<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $tipo = $id ? (new Tipo)->tipoID($id) : new Tipo();
    $datosPOST = $_POST;
    if ($id) $datosPOST['id'] = $id;
        
    try {
        if ($del) {
            $tipo->deleteTipo();
            (new Alert())->insertAlerta('danger', "Se borro la el tipo {$tipo->getName()}");        
            header('Location: ../index.php?view=tipo');
        } else {
            //ESTO ES UNA MIERDA, PERO NO SE ME OCURRE COMO HACERLO MEJOR
            if ($tipo->validaForm($datosPOST)) {

                if (!array_key_exists('radio', $datosPOST)) {
                    $r['radio'] = '';
                    (new Alert())->insertFormAlert($r, 'danger', 'Debe seleccionar uno!');
                }
                if (empty($datosPOST['select']) && empty($datosPOST['fecha']) && empty($datosPOST['dias'])) {
                    $datosPOST['tiempo'] = '';

                }
                if (!array_key_exists('id_categoria', $datosPOST)) {
                    $datosPOST['id_categoria'] = '';
                } 

                (new Validate)->inserForm($datosPOST);
                (new Alert())->insertFormAlert($datosPOST, 'danger', 'Debe llenar este camopo');
                header("Location: ../index.php?view=abm-tipo");
            } elseif ($id) {
                $tipo->editTipo($datosPOST);
                $tipo->editTipoXCategoria($datosPOST['id_categoria']);
                (new Validate)->inserForm($datosPOST);
                (new Alert())->insertAlerta('success', "Se edito el tipo {$tipo->getName()} correctamente");     
                header('Location: ../index.php?view=tipo');
            } else {
                $id_tipo = $tipo->insertTipo($datosPOST);
                $tipo->insertTipoXCategoria($id_tipo, $datosPOST['id_categoria']);
                (new Validate)->inserForm($datosPOST);
                (new Alert())->insertAlerta('success', "Se agrego un tipo correctamente");
                header('Location: ../index.php?view=tipo');
            }
        }

    } catch (Exception $e) {
        // echo '<pre>';
        // print_r($e);
        // echo '</pre>';
        // die('No se pudo cargar el Tipo');

        if ($e->getCode() == 23000) {
            (new Alert())->insertAlerta('danger', "El tipo {$tipo->getName()} no se pudo eliminaro porque esta asociada con un o mas Productos o a una Categoria.");
        } else {
            (new Alert())->insertAlerta('danger', "Hubo un error inesperado. Comunicarse con el Administrador de sistema.");
        }
        header('Location: ../index.php?view=tipo');
    }