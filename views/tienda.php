<?php 
    require_once 'includes/productos.php';
    $CategorySelected = $_GET['category'] ?? false;
    $category = catalogoCategoria($CategorySelected);
?>
<section class="tienda container-fluid container-md pb-3" id="tienda">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Tienda</h2>
    <p class="fs-5 w-75 mx-auto">En nuestra tienda encontrarás todo lo <em>necesario para tu entrenamiento</em>. Podrás encontrar paquetes de clases, toda la ropa necesaria (<span lang="ja">keikogi, Obi, Hakamas</span>) de diversos tamaños y calidad, y también podrás encontrar los equipos necesarios (<span lang="ja">Katana, Bokken</span>)</p>
    <div class="productos pb-3">
        <div class="categoria py-1 pe-2">
            <h3 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2"><?= $CategorySelected ?></h3>
        </div> 
        <article id="productos">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 my-2 container mx-auto">
                <?PHP
                    if (!empty($category)) {
                        foreach ($category as $producto) { ?>
                    <div class="col">
                        <div class="card tarjetas-producto">
                            <img src="<?= $producto['imagen'][0]?>" alt="<?= $producto['altImagen'][0]?>" class="card-img-top">
                            <span class="mx-2 ms-auto capital"><?= $producto["categoria"]?></span>
                            <div class="card-body">
                                <h3 class="card-title fs-2 titulocard" type="button" type="button" data-bs-toggle="modal" data-bs-target="#ProductoModal" id="<?= $producto['id'] . 'boton_mostrar'?>"><?= $producto['nombre']?></h3>
                                <p class="card-text"><?= $producto['descrip'] ?></p>
                                <div class="row px2">
                                    <span class="col preciocard"><?=  "$" . $producto['precio'] . ".00" ?></span>
                                    <button class="btn btn-komei col" id="<?= $producto['id'] . 'boton_agregar'?>"><?= 'Agregar <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16"><path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>' ?></button>
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
<!-- <div class="modal fade" id="ProductoModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tituloProducto" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modalCustom">
            <div class="modal-header">
                <p class="modal-title h3 mx-auto" id="tituloProducto"></p>
            </div>
            <div class="modal-body row">
                <div id="carouselProductoImagen" class="carousel slide col-12  col-lg-7" data-bs-ride="true">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselProductoImagen" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselProductoImagen" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselProductoImagen" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner" id="carrusel-producto">
                        <div class="carousel-item active">
                        </div>
                        <div class="carousel-item">
                        </div>
                        <div class="carousel-item">
                        </div>
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
                <div class="col-12 col-lg-5 d-flex flex flex-column">
                    <span class="mx-2 align-self-end text-secondary" id="categoriaProducto"></span>
                    <div class="fs-5 mt-3 order-md-1">
                        <div class="text-end p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                            </svg>
                            <span id="precioProducto"></span>
                            <span class="text-info fs-6">6 x $</span>
                            <span id="precioCuotas" class="text-info fs-6"></span>
                            <p>Hasta 6 cuotas sin interes con todas las tarjetas</p>
                            <img src="./img/misc/tarjetas.jfif" class="w-50" alt="logos de tarjetas">
                        </div>
                        <div class="mt-5 text-end">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                            </svg>
                            <span>Envios gratis a todo el país</span>
                        </div>
                    </div>
                    <p id="descripProducto" class="my-3"></p>
                </div>
            </div>
            <div class="modal-footer" id="botonProducto">
                <button id="cambiarIDBoton" class="btn btn-komei" data-bs-dismiss="modal"></button>
            </div>
        </div>
    </div>
</div> -->