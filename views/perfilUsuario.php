<?php
    $carrito = (new Carrito)->get_carrito();

?>

<section class="item container-fluid container-md pb-3">
    <div>
        <?= (new Alert())->getAlert(); ?>
    </div> 
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center fw-bold my-2 mx-auto px-2">Finalizar Compra</h2>

    <section class="row row-cols-1 row-cols-lg-2 g-4 my-2 container mx-auto">
        <article class="col-12 col-lg-7">
            <h3 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Articulos</h3>
            <table class="tabla table bg-light rounded">
                <thead>
                    <tr>
                        <th class="px-1 text-center" scope="col" width="20%" >Nombre</th>
                        <th class="px-1 text-center" scope="col" width="10%">Cantidad</th>
                        <th class="px-1 text-center" scope="col" width="20%">Precio</th>
                        <th class="px-1 text-center" scope="col" width="20%">Subtotal</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php            
                        foreach($carrito as $k => $p) { ?>
                        <tr>
                            <td class="text-capitalize text-center">
                                <p class="h4"><?= $p['nombre']?></p>
                            </td>
                            <td class="text-capitalize text-center">
                                <p class="h4"><?= $p['cantidad'] ?></p>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-currency-dollar " viewBox="0 0 16 16"><path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/></svg>
                                    </div>
                                    <div>
                                        <span class="fw-bold fs-5 tenxt-end"><?=  number_format($p['precio'], 2, ",", ".") ?></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-currency-dollar " viewBox="0 0 16 16"><path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/></svg>
                                    </div>
                                    <div>
                                        <span class="fw-bold fs-5 tenxt-end"><?=  number_format($p['cantidad'] * $p['precio'], 2, ",", ".") ?></span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </article>
        <article class="col-12 col-lg-5">
            <h3 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Resumen</h3>
            <div class="contenedorProductosCarrito bg-light rounded">
                <div class="p-3">
                    <h4 class="text-center"><?= $user->getFull_name() ?></h4>
                    <p class="text-center">email: <span><?= $user->getEmail() ?></span></p>
                </div>
                <div class="p-3 fs-4 d-flex justify-content-between">
                    <p>Total</p>
                    <p class="fw-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16"><path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/></svg>
                        <span><?= number_format((new Carrito)->calculaTotal()) ?></span>
                    </p>
                </div>
                <div class="p-2">
                    <a href="admin/acciones/finaliza-compra-acc.php" class="btn btn-agregar d-block fw-bold text-light">Pagar</a>
                </div>
            </div>
        </article>
    </section>
</section>