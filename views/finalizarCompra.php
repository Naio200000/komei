<?php
    $carrito = (new Carrito)->get_carrito();

?>

<section class="item container-fluid container-md pb-3">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center fw-bold my-2 mx-auto px-2">Finalizar Compra</h2>

    <pre>
        <?php
        var_dump($user);
        print_r($_SESSION);
        
        ?>
    </pre>
</section>