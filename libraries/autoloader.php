<?php 
session_start();
function autoloadClass($clase) {
    
    $classFile = __DIR__ . "/../classes/$clase.php";
    if (file_exists($classFile)) {
        require_once $classFile;
    } else {
        die("No se pudo cargar la clase: $classFile");
    }
}
spl_autoload_register('autoloadClass');