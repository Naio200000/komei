 <?php


class Alert {

    //profe, esta clase me la copie ¯(ツ)/¯

    /**
     * carga una alerta el la $_SESSION
     * @param string $tipo el tipo de alerta 
     * @param string $mensaje mensaje de la alerta
     */
    public function insertAlerta( string $tipo, string $mensaje)  {

        $_SESSION['alert'][] = [
            'tipo' => $tipo,
            'mensaje' => $mensaje
        ];
    }

    

    /**
     * Borra las alertas de las $_SESSION
     */
    public function deleteAlert() {

        $_SESSION['alert'] = [];
    }

    /**
     * da formato a las alertas para que se vean rendericen
     * @param array $alert array con los datos a formatear
     * @return string datos de la alerta formateados 
     */
    private function formateaAlert($alert): string
    {
        $html = "<div class='alert alert-{$alert['tipo']} alert-dismissible fade show' role='alert'>";
        $html .= $alert['mensaje'];
        $html .= "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        $html .= "</div>";    

        return $html;
    }

     /**
     * Devuelve las alertas que se encuentre en la $_SESSION y despues las borra
     * @return ?string devuelve las alertas formateadas o null de no haber alertas.
     */
    public function getAlert() :?string {

        if (!empty($_SESSION['alert'])) {

            $alerts = '';
            foreach ($_SESSION['alert'] as $a) {
                $alerts .= $this->formateaAlert($a);
            }
            $this->deleteAlert();
            return $alerts;
        } else {
            return null;
        }
    }

     /**
     * Devuelve las alertas de los formularios que se encuentre en la $_SESSION y despues las borra
     * @param array array de campos con errores de formulario.
     * @return ?string devuelve las alertas formateadas o null de no haber alertas.
     */
    public function insertFormAlert($array, $tipo, $mensaje)  {

        $arrayAlert = [];
        foreach ($array as $key => $value) {
            if (!$value) {
                $arrayAlert[$key] = [
                    'tipo' => $tipo,
                    'mensaje' => $mensaje
                ];

            }   
        }    
        $_SESSION['alertForm'][] = $arrayAlert;

    }

     /**
     * Devuelve las alertas que se encuentre en la $_SESSION y despues las borra
     * @return ?array devuelve las alertas formateadas o null de no haber alertas.
     */
    public function getFormAlert() :?array {

        if (!empty($_SESSION['alertForm'])) {

            $alerts = [];
            foreach ($_SESSION['alertForm'] as $v) {

                foreach ($v as $k => $a) {
                    $alerts[$k] = $this->formateaAlert($a);
                }
            }
            $this->deleteFormAlert();

            return $alerts;
        } else {
            return null;
        }
    }


    /**
     * Borra las alertas de las $_SESSION
     */
    public function deleteFormAlert() {

        $_SESSION['alertForm'] = [];
    }
}