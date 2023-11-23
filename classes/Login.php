<?PHP

class Login {

    /**
     * Valida el ingreso de un usuario
     * @param string $username el nombre de usuario a verificar
     * @param string $password el password de usuario a verificar
     * @return mixed devuelve el rol del usuario si hay coinsidencias, false si el password es incorrecto y null si no encuentra usuario
     */
    public function log_in(string $usuario, string $password) :mixed {
        $datosUsuario = (new Usuario())->usuarioUsername($usuario);

        if ($datosUsuario) {
            if (password_verify($password, $datosUsuario->getPassword())) {
                $_SESSION['user'] = $datosUsuario;
                return $datosUsuario->getRol()->getRoles();
            } else {
                return FALSE;
            }
        } else {
            return NULL;
        }
    }

    /**
     * borra los datos de user en sesion
     */
    public function log_out() {
     
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        };
    }


    /**
     * veritica si hay datos de usuario en sesion si no hay usuario, redirige a la pagina de log in
     * @return true si hay usuario devuelve true
     */
    public function verificar() {

        if (isset($_SESSION['user'])) {
            return true; 
        } else {
            header('location: index.php?view=login');
        }
    }
}
