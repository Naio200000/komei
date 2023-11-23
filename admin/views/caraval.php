<?php
    $caraval = (new Caraval);
    $allCaraval = $caraval->getAllCaraval();
    $caracteristicas = (new Caracteristica)->getAllCaracteristicas();
    $valores = (new Valor)->getAllValores();
?>
<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Categorias</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de Categorias principales de la tienda</p>
    <div class="listado pb-3">
        <div>
            <?= (new Alert())->getAlert(); ?>
        </div> 
        <article class="accordion" id="accordionCaraval">
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <span class="titulo-caraval">Relaciones Caracteristica/Valor</span>
                    </button>
                </h3>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionCaraval">
                    <div class="accordion-body">
                        <div class="row g-4 my-2 container mx-auto">
                            <div class="col">

                                <table class="tabla table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="px-1 text-center" scope="col">#</th>
                                            <th class="px-1 text-center" scope="col">Caracteristicas</th>
                                            <th class="px-1 text-center" scope="col">Valor</th>
                                            <th class="px-1 text-center" scope="col" width="20%">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($allCaraval as $cv) { ?>
                                            <tr>
                                                <th class="text-center" scope="row"><?= $cv->getId()?></th>
                                                <td class="text-capitalize text-center"><?= $cv->getName()->getName() ?></td>
                                                <td class="text-capitalize text-center"><?= $cv->getValor()->getValor() ?></td>
                                                <td class="d-flex justify-content-center">
                                                    <div>
                                                        <a href="index.php?view=abm-caraval&id=<?= $cv->getId()?>"><button class="me-1 btn-editar btn fw-bold">Editar</button></a>
                                                    </div>
                                                    <div>
                                                        <a href="index.php?view=abm-caraval&id=<?= $cv->getId()?>&del=true"><button class="ms-1 btn-borrar btn fw-bold">Borrar</button></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="tabla col-12 p-2 d-flex">
                                    <div class="ms-auto">
                                    <a class=" px-3 me-1" href="index.php?view=abm-caraval"><button class="fw-bold btn btn-agregar">Agregar Relacion</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <span class="titulo-caraval">Tablas de Caracteristicas y Valores</span>
                    </button>
                </h3>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionCaraval">
                    <div class="accordion-body">
                        <div class="row g-4 my-2 container mx-auto">
                            <div class="col-12 col-md-6">
                                <table class="tabla table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="px-1 text-center" scope="col">#</th>
                                            <th class="px-1 text-center" scope="col">Caracteristicas</th>
                                            <th class="px-1 text-center" scope="col" width="20%">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($caracteristicas as $c) { ?>
                                            <tr>
                                                <th class="text-center" scope="row"><?= $c->getID() ?></th>
                                                <td class="text-capitalize text-center"><?= $c->getName() ?></td>
                                                <td class="d-flex justify-content-center">
                                                    <div>
                                                        <a href="index.php?view=abm-caracteristica&id=<?= $c->getID()?>"><button class="me-1 btn-editar btn fw-bold">Editar</button></a>
                                                    </div>
                                                    <div>
                                                        <a href="index.php?view=abm-caracteristica&id=<?= $c->getID()?>&del=true"><button class="ms-1 btn-borrar btn fw-bold">Borrar</button></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="tabla col-12 p-2 d-flex">
                                    <div class="ms-auto">
                                    <a class=" px-3 me-1" href="index.php?view=abm-caracteristica"><button class="fw-bold btn btn-agregar">Agregar Caracteristica</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <table class="tabla table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="px-1 text-center" scope="col">#</th>
                                            <th class="px-1 text-center" scope="col">Valores</th>
                                            <th class="px-1 text-center" scope="col" width="20%">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($valores as $v) { ?>
                                            <tr>
                                                <th class="text-center" scope="row"><?= $v->getId()?></th>
                                                <td class="text-capitalize text-center"><?= $v->getValor()?></td>
                                                <td class="d-flex justify-content-center">
                                                    <div>
                                                        <a href="index.php?view=abm-valor&id=<?= $v->getId()?>"><button class="me-1 btn-editar btn fw-bold">Editar</button></a>
                                                    </div>
                                                    <div>
                                                        <a href="index.php?view=abm-valor&id=<?= $v->getId()?>&del=true"><button class="ms-1 btn-borrar btn fw-bold">Borrar</button></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="tabla col-12 p-2 d-flex">
                                    <div class="ms-auto">
                                        <a class=" px-3 me-1" href="index.php?view=abm-valor"><button class="fw-bold btn btn-agregar">Agregar Valor</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>