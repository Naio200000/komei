<?php
    $producto = (New Producto)->filtrarCatalogo();
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
                            <th class="px-1 text-center" scope="col" width="15%">Descripción Corta</th>
                            <th class="px-1 text-center" scope="col" width="40%">Descripción Larga</th>
                            <th class="px-1 text-center" scope="col">Tipo</th>
                            <th class="px-1 text-center" scope="col" width="15%">Caracteristicas</th>
                            <th class="px-1 text-center" scope="col">Precio</th>
                            <th class="px-1 text-center" scope="col" width="15%">Imagenes</th>
                            <th class="px-1 text-center" scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($producto as $p) { ?>
                            <tr>
                                <th class="text-center" scope="row"><?= $p->getId() ?></th>
                                <td class="text-capitalize text-center"><?= $p->getNombre() ?></td>
                                <td><?= $p->formatearDescript() ?></td>
                                <td><?= $p->formatearDescript(true) ?></td>
                                <td><?= $p->getTipo()->getName() ?></td>
                                <td><?php foreach ($p->formatearCaravalOBJ() as $k => $v) { ?>
                                    <p class=''><span class='fw-bold text-capitalize'> <?= "$k : </span> $v </p>"?><?php }?>
                                </td>
                                <td><?= $p->getPrecio() ?></td>
                                <td>
                                    <?php foreach($p->getImagen() as $i) { ?> 
                                        <div>
                                            <img class="w-100" src="../img/productos/<?= $i->getName() ?>.webp" alt="<?= $i->getDescript() ?>" > 
                                        </div>    
                                    <?php } ?></td>
                                <td>
                                    <ul>
                                        <li class="btn-editar btn m-1"><a class="fw-bold" href="index.php?view=abm-producto&id=<?= $p->getId() ?>">Editar</a></li>
                                        <li class="btn-borrar btn m-1"><a class="fw-bold" href="index.php?view=abm-producto&id=<?= $p->getId() ?>&del=1">Borrar</a></li>
                                    </ul>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="tabla col-12 p-2 d-flex">
                    <div class="ms-auto">
                    <a class=" px-3 me-1" href="index.php?view=abm-producto"><button class="fw-bold btn btn-agregar">Agregar Producto</button></a>  
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>