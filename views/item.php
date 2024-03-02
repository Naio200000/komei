<?php 
    $ID = $_GET['itemID'] ?? False;
    $item = $OBJProducto->productoID($ID);
?>

<section class="item container-fluid container-md pb-3">
    <?PHP
    if (!empty($item)) {?>
        <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center fw-bold my-2 mx-auto px-2"><?= $item->getNombre()?></h2>
        <p class="fs-5 w-75 mx-auto fw-bold text-center"><?= $item->formatearDescript()?></p>
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
                                foreach ($item->getImagen() as $v) { ?>
                                <div class="carousel-item <?php if ($i == 0 ) echo 'active'; ?>">
                                    <img class="card-img-top" src="./img/productos/<?= $v->getName() ?>.webp" alt="<?= $v->getDescript() ?>">
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
                    <span class="text-uppercase p-2 text-lg-start text-end"><?= $item->getCategoria()->getName()?></span>
                </div>
                <div class="col-lg-6 d-flex flex-column p-3">
                    <div class="card-body flex-grow-0">
                        <h3 class="card-title fs-2"><?= $item->getNombre()?></h3>
                        <p class="card-text fs-5"><?= $item->formatearDescript(true)?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class='list-group-item fs-5'><span class='fw-bold text-capitalize'> Disponibilidad:  </span><?= $item->formatearFecha() ?></li>
                        <li class='list-group-item fs-5'><span class='fw-bold text-capitalize'> Tipo:  </span><?= $item->getTipo()->getName() ?></li>
                        <?php foreach ($item->formatearCaravalOBJ() as $k => $v) { ?>
                            <li class='list-group-item fs-5 text-capitalize'><span class='fw-bold text-capitalize'> <?= "$k : </span> $v </li>"?>
                            <?php }?>
                    </ul>
                    <div class="card-body flex-grow-0 mt-auto" id="botonProducto">
                        <p class="fs-3 mb-3 fw-bold text-center preciocard"><?= $item->formatearPrecio()?></p>
                        <form action="admin/acciones/item-acc.php" class="row">
                            <div class="col-6 d-flex align-items-center">
                                <label class="px-1" for="cantidad">Cantidad: </label>
                                <input type="number" class="form-control fw-bold" value="1" name="cantidad" id="cantidad">
                            </div>
                            <div class="col-6">
                                <input type="hidden" value="<?= $item->getId() ?>" name="id" id="id">
                                <button type="submit" class="btn btn-komei w-100 fs-3 text-uppercase">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg> Comprar
                                </button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        <?PHP } else {?>
            <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center fw-bold my-2 mx-auto px-2">No pudimos encontrar el producto que buscabas.</h2>
            <p class="fs-5 w-75 mx-auto fw-bold text-center fs-5">Para volver a la home hás click <a class="fs-3" href="index.php?view=home">aquí.</a></p>
        <?PHP }?>
</section>