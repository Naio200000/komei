<?php
    $imagenes = (new Images)->getAllImages();
    // echo '<pre>';
    // print_r($imagenes);
    // echo '<pre>';
    // echo '<pre>';
    // print_r($datosPOST);
    // echo '<pre>';
?>
<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Imagenes</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de Imagenes principales de la tienda</p>
    <div class="listado pb-3">
        <article>
            <form action="">
                    <div class="row g-4 my-2 container mx-auto">
                    <?php 
                        foreach ($imagenes as $i) { ?>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 form-check">
                                <div>
                                    <label for="<?= $i->getid() ?>">
                                        <img src="./../img/productos/<?= $i->getName() ?>.webp" alt="<?= $i->getDescript() ?>" class="img-productos">    
                                    </label>
                                </div>
                                <input type="radio" class="form-check-input ms-1" name="imagen" id="<?= $i->getid() ?>" value="<?= $i->getid() ?>">
                                <label class="" for="<?= $i->getid() ?>"><?= $i->getName() ?></label>
                            </div>
                    <?php } ?>
                    <div class="col-12 p-2 d-flex tabla">
                        <div class="ms-auto">
                            <a class=" px-3" href="index.php?view=abm-imagenes"><button class="fw-bold btn btn-agregar">Agregar</button></a>
                        </div>
                        <div>
                            <a class=" px-3" href="index.php?view=abm-imagenes"><button class="me-1 btn-editar btn fw-bold">Editar</button></a>
                        </div>
                        <div>
                            <a class=" px-3" href="index.php?view=abm-imagenes"><button class="ms-1 btn-borrar btn fw-bold">Borrar</button></a>
                        </div>
                    </div>
                </form>

            </div>
        </article>
    </div>
</section>