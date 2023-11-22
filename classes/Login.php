<?PHP

class Login {

    /**
     * Valida el ingreso de un usuario
     * @param string $username el nombre de usuario a verificar
     * @param string $password el password de usuario a verificar
     * @return bool devuelve el rol del usuario si hay coinsidencias, false si el password es incorrecto y null si no encuentra usuario
     */
    public function log_in(string $usuario, string $password) :?bool {

        $datosUsuario = (new Usuario())->usuarioUsername($usuario);

        if ($datosUsuario) {
            if (password_verify($password, $datosUsuario->getPassword())) {
                $_SESSION['user'] = $datosUsuario;
                echo 'ok';
                return $datosUsuario->getRol()->getRol();
            } else {
                echo 'no pw';
                return FALSE;
            }
        } else {
            echo 'no';
            return NULL;
        }
    }

    public function log_out() {
     
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        };
    }

    // public function verify($admin = TRUE): bool
    // {
      
    //     if (isset($_SESSION['user'])) {

    //         if($admin){

    //             if ($_SESSION['user']['rol'] == "admin" OR $_SESSION['user']['rol'] == "superadmin"){
    //                 return TRUE;
    //             }else{
    //                 // (new Alerta())->add_alerta('warning', "El usuario no tiene permisos para ingresar a este area");
    //                 header('location: index.php?sec=login');
    //             }

    //         }else{
    //             return TRUE;
    //         }
    //     } else {
    //         header('location: index.php?sec=login');
    //     }
    // }
}
