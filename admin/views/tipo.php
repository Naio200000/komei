<?php
    $tipos = (new Tipo)->getAllTipos();
?>
<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Categorias</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de Categorias principales de la tienda</p>
    <div class="listado pb-3">
        <article>
            <div class="row g-4 my-2 container mx-auto">
                <table class="tabla table table-striped">
                    <thead>
                        <tr>
                            <th class="px-1 text-center" scope="col">#</th>
                            <th class="px-1 text-center" scope="col">Nombre</th>
                            <th class="px-1 text-center" scope="col" width="40%">Descripción</th>
                            <th class="px-1 text-center" scope="col">Disponible</th>
                            <th class="px-1 text-center" scope="col">Categoria</th>
                            <th class="px-1 text-center" scope="col" width="20%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($tipos as $t) { ?>
                            <tr>
                                <th class="text-center" scope="row"><?= $t->getId() ?></th>
                                <td class="text-capitalize text-center"><?= $t->getName() ?></td>
                                <td><?= $t->getDescript() ?></td>
                                <td class="text-capitalize text-center"><?= $t->formateaDisponibilidad() ?></td>
                                <td class="text-capitalize text-center"><?= $t->getCategoria()->getName() ?></td>
                                <td>
                                    <ul>
                                        <li class="btn-editar btn"><a class="fw-bold" href="">Editar</a></li>
                                        <li class="btn-borrar btn"><a class="fw-bold" href="">Borrar</a></li>
                                    </ul>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="tabla col-12 p-2 d-flex">
                    <div class="ms-auto">
                    <a class=" px-3 me-1" href="index.php?view=abm-tipo"><button class="fw-bold btn btn-agregar">Agregar Tipo</button></a>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>