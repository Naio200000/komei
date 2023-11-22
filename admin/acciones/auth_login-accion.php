<?PHP
    require_once "../../libraries/autoloader.php";
    $datosPOST = $_POST;


    $login = (new Login())->log_in($datosPOST['username'], $datosPOST['password']);
    echo '<pre>';
    print_r($_SESSION['user']);
    echo '</pre>';

    if ($login) {

        if($login == "usuario"){
            header('location: ../../index.php?view=home');
        }else{
            echo 'meg';
            header('location: ../index.php?view=dash');
        }
        
    } else {
        header('location: ../index.php?view=login');
    }
