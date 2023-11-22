<?PHP
    require_once "../../libraries/autoloader.php";


    (new Login())->log_out();
    header('location: ../../index.php?view=login');
