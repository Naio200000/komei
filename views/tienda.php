<?php

    $categoriaGET = isset($_GET['category']) ? (new Categoria)->categoriaName($_GET['category']) : false ;

    $tiposGET = $_GET['type'] ?? false;
    $datosPOST = $_POST ?? false ;
    if (empty($datosPOST)){
        if ($categoriaGET) {
            $filtrar = $categoriaGET->formateaCategoriasa();
            if (in_array($categoriaGET->getName(), $filtrar)) {
                $filtrar = $categoriaGET->formateaTipos($categoriaGET->getName()); 
                $category = $OBJProducto->filtrarCatalogo(true, $categoriaGET->getName(), $tiposGET);
                $CategorySelected = $categoriaGET->getName();
            } else {
                $filtrar = false;
                $CategorySelected = 'No se encontro la categoria';
                $category = [];
            }
        } else {
            $filtrar = (new Categoria())->formateaCategoriasa();;
            $category = $OBJProducto->filtrarCatalogo();
            $CategorySelected = 'Nuestro Catalogo Completo';
        }
    } else {
        $cateTienda = $datosPOST['category'] ?? null;
        $etcTienda = $datosPOST['etc'] ?? null;
        $datoTienda = $datosPOST['dato'] ?? null;
        $category = $OBJProducto->filtrarCatalogo(true, $cateTienda, $etcTienda, $datoTienda);
        $CategorySelected = $datosPOST['category'] ?? "";
    }
?>
<section class="tienda container-fluid container-md pb-3" id="tienda">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Tienda</h2>
    <p class="fs-5 w-75 mx-auto">En nuestra tienda encontrarás todo lo <em>necesario para tu entrenamiento</em>. Podrás encontrar paquetes de clases, toda la ropa necesaria (<span lang="ja">keikogi, Obi, Hakamas</span>) de diversos tamaños y calidad, y también podrás encontrar los equipos necesarios (<span lang="ja">Katana, Bokken</span>)</p>
    <div class="productos pb-3 formularioLogica">
        <article>
            <div class="categoria pt-2 pe-2">
                <h3 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2"><?= $CategorySelected ?></h3>
            </div>  
            <div class="categoria pt-2 pe-2 bg-light">
                <div class="w-75 w-lg-100 my-2 mx-auto px-2 pb-1" ><?= $categoriaGET ? $categoriaGET->getDescript() : "" ?></div>
            </div>
        </article>
        <?php if($filtrar) {  ?>
            <article class="accordion accordion-flush px-4" id="accordionFlushExample">
                <div class="accordion-item">
                    <p class="accordion-header" id="flush-headingOne">
                        <span class="accordion-button collapsed fs-3 titulocard" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">Filtros</span>
                    </p>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <p class="fs-5 w-75 mx-auto">Filtra nuestros productos por lo que estes buscando.</p>
                            <?php //Falta acomodar para que los filtros se actualicen cuando cargamos nuevos datos ?>
                            <div class="d-flex justify-content-around">
                                <?php foreach ($filtrar as $key => $value) { ?>
                                    <div>
                                        <a class='px-3 text-uppercase' href='index.php?view=tienda<?= $categoriaGET ? ($categoriaGET->getName() ? "&category={$categoriaGET->getName()}&type=$key" : "&category=$value") : "&category=$value" ?>'><button class='fw-bold btn btn-komei'><?= $value ?></button></a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        <?php } ?>
        <article id="productos">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 my-2 container mx-auto">
                <?PHP
                    foreach ($category as $producto) {?>   
                        <div class="col">
                            <?php 
                            ?>
                            <div class="card tarjetas-producto">
                                <img src="./img/productos/<?= $producto->getImagen()[0]->getName() ?>.webp" alt="<?= $producto->getImagen()[0]->getDescript() ?>" class="card-img-top">
                                <span class="mx-2 ms-auto capital"><?= $producto->getCategoria()->getName()?></span>
                                <div class="card-body">
                                    <h4 class="card-title fs-2 titulocard" type="button" id="<?= $producto->getId()?>boton_mostrar"><a href="index.php?view=item&itemID=<?= $producto->getId()?>" class="fs-2 titulocard"><?= $producto->getNombre()?></a></h4>
                                    <p class="card-text"><?= $producto->formatearDescript()?></p>
                                    <div class="row px2">
                                        <span class="col preciocard"><?=  $producto->formatearPrecio()?></span>
                                        <div class="col-7">
                                            <div class="row px-0">
                                                <button class="btn btn-komei col text-uppercase me-2"><a class="text-uppercase" href="index.php?view=item&itemID=<?= $producto->getId()?>">Ver mas</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?PHP } ?>
            </div>
        </article>
    </div>
    <script src="js/app.js"></script>
</section>