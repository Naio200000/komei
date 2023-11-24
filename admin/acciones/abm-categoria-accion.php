<?php
    require_once "../../libraries/autoloader.php";
    $id = $_GET['id'] ?? FALSE;
    $del = $_GET['del'] ?? FALSE;
    $categoria = $id ? (new Categoria)->categoriaID($id) : (new Categoria);
    $datosPOST = $_POST;
    if ($id) $datosPOST['id'] = $id;



    /**
     * Verifica los datos del formulario y actua acorde si tiene que agregar borrar o modificar
     * y si hay algun problema devuelve los mensajes
     */
    try {
        if ($del) {
            $categoria->deleteCategoria();
            (new Alert())->insertAlerta('danger', "Se borro la categoria {$categoria->getName()}");        
            header('Location: ../index.php?view=categoria');
        } else {
            if (empty($datosPOST['name'])) {
                (new Validate)->inserForm($datosPOST);
                (new Alert())->insertFormAlert($datosPOST, 'danger', 'Debe llenar este camopo');
                header('Location: ../index.php?view=abm-categoria');
            } elseif ($id) {
                $categoria->editCategoria($datosPOST['name'], $datosPOST['descript']);  
                (new Alert())->insertAlerta('success', "Se edito la categoria {$categoria->getName()} correctamente");
                header('Location: ../index.php?view=categoria');
            } else {
                $categoria->insertCategoria($datosPOST['name'], $datosPOST['descript']);
                (new Alert())->insertAlerta('success', "Se agrego una nueva Categoria correctamente"); 
                header('Location: ../index.php?view=categoria');
            }
        }

    } catch (Exception $e) {
    
            // echo '<pre>';
            // print_r($e);
            // echo '<pre>';
            // die('No se pudo cargar la Categoria');
    
            if ($e->getCode() == 23000) {
                (new Alert())->insertAlerta('danger', "La categoria {$categoria->getName()} no se pudo eliminaro porque esta relacionada con un Tipo de producto.");
            } else {
                (new Alert())->insertAlerta('danger', "Hubo un error inesperado. Comunicarse con el Administrador de sistema.");
            }
    
            
            header('Location: ../index.php?view=categoria');
    }
