<?php

require_once "../../libraries/autoloader.php";


(new Carrito())->vaciarCarrito();

header('Location: ../../index.php?view=carrito');