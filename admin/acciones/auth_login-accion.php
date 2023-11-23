<?PHP
    require_once "../../libraries/autoloader.php";
    $datosPOST = $_POST;


    $login = (new Login())->log_in($datosPOST['username'], $datosPOST['password']);


    if ($login) {

        if($login == "usuario"){
            header('location: ../../index.php?view=home');
        }else{
            
            header('location: ../index.php?view=dash');
        }
        
    } else {
        header('location: ../../index.php?view=login');
    }
