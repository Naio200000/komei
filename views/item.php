<?php 
    $ID = $_GET['itemID'] ?? False;
    $item = $OBJProducto->productoID($ID);
?>

<section class="item container-fluid container-md pb-3">
    <?PHP
    if (!empty($item)) {?>
        <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center fw-bold my-2 mx-auto px-2"><?= $item->getNombre()?></h2>
        <p class="fs-5 w-75 mx-auto fw-bold text-center"><?= $item->getDescripCorta()?></p>
        <div class="card">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                    <div id="carouselProductoImagen" class="carousel slide mx-auto" data-bs-ride="true">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselProductoImagen" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselProductoImagen" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselProductoImagen" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner p-5" id="carrusel-producto">
                            <?php
                                $i = 0;
                                foreach ($item->formatearSTNOBJ('imagen') as $k => $v) { ?>
                                <div class="carousel-item <?php if ($i == 0 ) echo 'active'; ?>">
                                    <img class="card-img-top" src="<?= $k ?>" alt="<?= $v ?>">
                                </div>
                            <?php $i++; }?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductoImagen" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselProductoImagen" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Proximo</span>
                        </button>
                    </div>
                    <span class="text-uppercase p-2 text-lg-start text-end"><?= $item->getCategoria()?></span>
                </div>
                <div class="col-lg-6 d-flex flex-column p-3">
                    <div class="card-body flex-grow-0">
                        <h3 class="card-title fs-2"><?= $item->getNombre()?></h3>
                        <p class="card-text fs-5"><?= $item->getDescripLarga()?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($item->formatearSTNOBJ('etc') as $k => $v) { ?>
                            <li class='list-group-item fs-5'>
                                <span class='fw-bold text-capitalize'> <?= "$k : </span> $v </li>"?>
                            <?php } ?>

                    </ul>
                    <div class="card-body flex-grow-0 mt-auto" id="botonProducto">
                        <p class="fs-3 mb-3 fw-bold text-center preciocard"><?= $item->formatearPrecio()?></p>
                        <button id="" class="btn btn-komei w-100 fs-3 text-uppercase fw-bold">Comprar</button>
                    </div>
                </div>
            </div>
        </div>
        <?PHP } else {?>
            <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center fw-bold my-2 mx-auto px-2">No pudimos encontrar el producto que buscabas.</h2>
            <p class="fs-5 w-75 mx-auto fw-bold text-center fs-5">Para volver a la home hás click <a class="fs-3" href="index.php?view=home">aquí.</a></p>
        <?PHP }?>
</section>z