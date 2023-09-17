<?php 
    $CategorySelected = $_GET['category'] ?? false;
    $category = $OBJProducto->catalogoCategoria($CategorySelected);
?>
<section class="tienda container-fluid container-md pb-3" id="tienda">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Tienda</h2>
    <p class="fs-5 w-75 mx-auto">En nuestra tienda encontrarás todo lo <em>necesario para tu entrenamiento</em>. Podrás encontrar paquetes de clases, toda la ropa necesaria (<span lang="ja">keikogi, Obi, Hakamas</span>) de diversos tamaños y calidad, y también podrás encontrar los equipos necesarios (<span lang="ja">Katana, Bokken</span>)</p>
    <?php $OBJProducto->filtrarCatalogo('ropa', 'material',  'Tetron'); ?>
    <div class="productos pb-3">
        <div class="categoria py-1 pe-2">
            <h3 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2"><?= $CategorySelected ?></h3>
        </div> 
        <article id="productos">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 my-2 container mx-auto">
                <?PHP
                    if (!empty($category)) {
                        foreach ($category as $producto) {?>         
                        <div class="col">
                            <div class="card tarjetas-producto">
                                <?php
                                    $imagenCard = $producto->formatearSTNOBJ('imagen');
                                    foreach (array_splice($imagenCard,0,1) as $k => $v) { ?>
                                        <img src="<?= $k ?>" alt="<?= $v ?>" class="card-img-top">
                                        <?php } ?>
                                <span class="mx-2 ms-auto capital"><?= $producto->getCategoria()?></span>
                                <div class="card-body">
                                    <h3 class="card-title" type="button" id="<?= $producto->getId()?>boton_mostrar"><a href="index.php?view=item&itemID=<?= $producto->getId()?>" class="fs-2 titulocard"><?= $producto->getNombre()?></a></h3>
                                    <p class="card-text"><?= $producto->getDescripCorta()?></p>
                                    <div class="row px2">
                                        <span class="col preciocard"><?=  $producto->formatearPrecio()?></span>
                                        <div class="col-7">
                                            <div class="row px-0">
                                                <button class="btn btn-komei col text-uppercase me-2"><a class="text-uppercase" href="index.php?view=item&itemID=<?= $producto->getId()?>">Ver mas</a></button>
                                                <button class="btn btn-komei col px-0" id="<?= $producto->getId()?>boton_agregar'"><?= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16"><path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>' ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?PHP }} else {?>
            </div>
                <div class="row">
                    <h3 class="col-12 fw-bold text-center h2">No pudimos encontrar la Categoria que estas buscando</h3>
                </div>
            <?PHP }?>
        </article>
    </div>
</section>
