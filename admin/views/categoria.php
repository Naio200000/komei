<?php
    $categorias = (new Categoria)->getAllCategorias();
?>
<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Categorias</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de Categorias principales de la tienda</p>
    <div class="listado pb-3">
        <article>
            <div class="row g-4 my-2 container mx-auto">               
                <div>
                    <?= (new Alert())->getAlert(); ?>
                </div> 
                <table class="tabla table table-striped">
                    <thead>
                        <tr>
                            <th class="px-1 text-center" scope="col">#</th>
                            <th class="px-1 text-center" scope="col">Nombre</th>
                            <th class="px-1 text-center" scope="col" width="60%">Descripción</th>
                            <th class="px-1 text-center" scope="col" width="20%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($categorias as $c) { ?>
                            <tr>
                                <th class="text-center" scope="row"><?= $c->getId() ?></th>
                                <td class="text-capitalize text-center"><?= $c->getName() ?></td>
                                <td><?= $c->getDescript() ?></td>
                                <td class="d-flex justify-content-center">
                                    <div>
                                        <a href="index.php?view=abm-categoria&id=<?= $c->getId() ?>"><button class="me-1 btn-editar btn fw-bold">Editar</button></a>
                                    </div>
                                    <div>
                                        <a href="index.php?view=abm-categoria&id=<?= $c->getId() ?>&del=true"><button class="ms-1 btn-borrar btn fw-bold">Borrar</button></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="tabla col-12 p-2 d-flex">
                    <div class="ms-auto">
                        <a class=" px-3 me-1" href="index.php?view=abm-categoria"><button class="fw-bold btn btn-agregar">Agregar Categoria</button></a>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>