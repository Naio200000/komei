<?php 
    $category = isset($_GET['category']) ? $OBJProducto->catalogoCategoria($_GET['category']) : $OBJProducto->catalogoCompleto();
    $CategorySelected = $_GET['category'] ?? false;
    $filtrar = $_POST ?? false;

    print_r($filtrar);
    if ($filtrar) {
        $category = $OBJProducto-> filtrarCatalogo($CategorySelected, $filtrar['etc'], $filtrar['dato']);
    }
?>
<section class="tienda container-fluid container-md pb-3" id="tienda">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Tienda</h2>
    <p class="fs-5 w-75 mx-auto">En nuestra tienda encontrarás todo lo <em>necesario para tu entrenamiento</em>. Podrás encontrar paquetes de clases, toda la ropa necesaria (<span lang="ja">keikogi, Obi, Hakamas</span>) de diversos tamaños y calidad, y también podrás encontrar los equipos necesarios (<span lang="ja">Katana, Bokken</span>)</p>
    <div class="productos pb-3 formularioLogica">
        <article class="accordion accordion-flush px-4" id="accordionFlushExample">
            <div class="accordion-item">
                <p class="accordion-header" id="flush-headingOne">
                    <span class="accordion-button collapsed fs-3 titulocard" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">Filtros</span>
                </p>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form action="index.php?view=tienda&category=<?= $CategorySelected ?>" method="POST">
                            <div class="row row-cols-1 row-cols-md-2 g-4 my-2 container mx-auto">
                                <!-- <input type="hidden" name="view" value="tienda">
                                <input type="hidden" name="category" value=""> -->
                                <div class="col form-floating">
                                    <select class="form-select" name="etc" v-model="dataSelected" aria-label="Default select example">
                                        <option v-for="(item, key) of <?= $CategorySelected ?>" :value="key">{{item}}</option>
                                    </select>
                                    <label for="etc">Filtrart por:</label>
                                </div>
                                <div class="col form-floating">
                                    <select class="form-select" name="dato" aria-label="Default select example">
                                        <template v-if="<?= $CategorySelected ?> == clases" v-for="(item, key) of datosClases[dataSelected]">
                                            <option :value="key" class="1">{{item}}</option>
                                        </template>
                                        <option v-if="<?= $CategorySelected ?> == ropa" v-for="(item, key) of datosRopa[dataSelected]" :value="key" class="2">{{item}}</option>
                                        <option v-if="<?= $CategorySelected ?> == equipos" v-for="(item, key) of datosEquipos[dataSelected]" :value="key" class="3">{{item}}</option>
                                    </select>
                                    <label for="dato">Datos</label>
                                </div>
                            </div>
                            <input type="submit" value="dale">
                        </form>
                    </div>
                </div>
        </article>
        <div class="categoria pt-2 pe-2">
            <h3 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2"><?PHP $CategorySelected = $CategorySelected ? $CategorySelected: 'Nustro catalogo completo';
            echo  $CategorySelected; ?></h3>
        </div> 
        <article id="productos">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 my-2 container mx-auto">
                <?PHP
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
                                    <h4 class="card-title fs-2 titulocard" type="button" id="<?= $producto->getId()?>boton_mostrar"><a href="index.php?view=item&itemID=<?= $producto->getId()?>" class="fs-2 titulocard"><?= $producto->getNombre()?></a></h4>
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
                <?PHP } ?>
            </div>
        </article>
    </div>
    <script src="js/app.js"></script>
</section>