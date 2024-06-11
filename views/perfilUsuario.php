<?php
    $compras = (new Compra)->comprasUserId($user->getId())

?>

<section class="item container-fluid container-md pb-3">
    <div>
        <?= (new Alert())->getAlert(); ?>
    </div> 
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center fw-bold my-2 mx-auto px-2">Perfil del usuario</h2>

    <section class="row row-cols-1 row-cols-lg-2 g-4 my-2 container mx-auto">
        <article class="col-12 col-lg-7">
            <h3 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Mis compras</h3>
                <?php
                    foreach ($compras as $c) { ?>
                    <div class="bg-light m-2 p-2">
                        <h4>Detalles</h4>
                            <?php 
                                foreach ($c['detcan'] as $k => $v) {?>
                                    <div class="d-flex justify-content-between">
                                        <p class="fw-bold px-5">Nombre <span class="fw-normal"><?= $k ?></span></p>
                                        <p class="fw-bold px-5">Cantidad <span class="fw-normal"><?= $v ?></span></p>
                                    </div>
                            <?php } ?>  
                        <div class="d-flex justify-content-between">
                            <p class="fw-bold px-5">Fecha <span class="fw-normal"><?= $c['fecha'] ?></span></p>
                            <p class="fw-bold px-5">Total <span class="fw-normal"><?= $c['importe'] ?></span></p>
                        </div>
                            
                    </div>
                <?php } ?>
            </table>
        </article>
        <article class="col-12 col-lg-5">
            <h3 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Resumen</h3>
            <div class="contenedorProductosCarrito bg-light rounded">
                <div class="p-3">
                    <h4 class="mb-3 text-center"><?= $user->getFull_name() ?></h4>

                    <p class="mb-3 ">nombre de usuario: <span><?= $user->getUsername() ?></span></p>
                    <p class="mb-3 ">email: <span><?= $user->getEmail() ?></span></p>
                </div>

            </div>
        </article>
    </section>
</section>