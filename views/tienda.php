<?php
    $datosGET = $_GET['category'] ?? false ;
    $datosPOST = $_POST ?? false ;
    if (empty($datosPOST)){
        $filtrar = (new Categoria())->formateaCategoriasa();
        if ($datosGET) {
            if (in_array($datosGET, $categorias)) {
                $filtrar = (new Categoria)->formateaTipos($datosGET);
                
                $category = $OBJProducto->filtrarCatalogo($datosGET);
                $CategorySelected = $datosGET;
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
        $category = $OBJProducto->filtrarCatalogo($cateTienda, $etcTienda, $datoTienda);
        $CategorySelected = $datosPOST['category'] ?? "";
    }
?>
<section class="tienda container-fluid container-md pb-3" id="tienda">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Tienda</h2>
    <p class="fs-5 w-75 mx-auto">En nuestra tienda encontrarás todo lo <em>necesario para tu entrenamiento</em>. Podrás encontrar paquetes de clases, toda la ropa necesaria (<span lang="ja">keikogi, Obi, Hakamas</span>) de diversos tamaños y calidad, y también podrás encontrar los equipos necesarios (<span lang="ja">Katana, Bokken</span>)</p>
    <div class="productos pb-3 formularioLogica">
        <?php if($filtrar) { ?>
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
                                        <a class='px-3 text-capitalize' href=''><button class='fw-bold btn btn-komei'><?= $value ?></button></a>
                                    </div>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        <?php } ?>
        <div class="categoria pt-2 pe-2">
            <h3 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2"><?= $CategorySelected ?></h3>
        </div> 
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
                                                <button class="btn btn-komei col px-0" id="<?= $producto->getId()?>boton_agregar'"><?= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16"><path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>' ?></button>
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