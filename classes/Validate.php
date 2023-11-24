<?php


class Validate {


    /**
     * inserta los datos del form en la session
     * @param array $datosForm los datos que vienen del formulario
     */
    public function inserForm (array $datosForm) {

        $_SESSION['form'] = $datosForm;
        
    }
        
    /**
     * Borra las alertas de las $_SESSION
     */
    public function deleteForm() {

        $_SESSION['form'] = [];
    }

        /**
     * Devuelve los datos de form de la variable session y los borra
     * @return mixed devuelve un array con los datos del form
     */
    public function getForm() :mixed {

        if (!empty($_SESSION['form'])) {

            $form = $_SESSION['form'];

            $this->deleteForm();
            return $form;

        } else {

            return false;
        }
    }


}