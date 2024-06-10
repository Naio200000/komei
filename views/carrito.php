<?php
    $carrito = (new Carrito)->get_carrito();
?>

<section class="item container-fluid container-md pb-3">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center fw-bold my-2 mx-auto px-2">Tu Carrito</h2>
    <?php
        if(!empty($carrito)) { ?>
            <form action="admin/acciones/actualizar-carrito-acc.php" method="POST">
                <table class="tabla table">
                    <thead>
                        <tr>
                            <th class="px-1 text-center" scope="col" width="10%">Producto</th>
                            <th class="px-1 text-center" scope="col" width="20%" >Nombre</th>
                            <th class="px-1 text-center" scope="col" width="10%">Cantidad</th>
                            <th class="px-1 text-center" scope="col" width="20%">Precio</th>
                            <th class="px-1 text-center" scope="col" width="20%">Subtotal</th>
                            <th class="px-1 text-center" scope="col" width="5%">Eliminar</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php            
                            foreach($carrito as $k => $p) { ?>
                            <tr>
                                <td class="text-center align-middle" scope="row">
                                    <div>
                                        <img class="img-fluid" src="./img/productos/<?= $p['imagen']->getName() ?>.webp" alt="<?= $p['imagen']->getDescript() ?>">
                                    </div>    
                                </td>
                                <td class="text-capitalize text-center">
                                    <p class="h4"><?= $p['nombre']?></p>
                                </td>
                                <td class=" ms-0 d-flex justify-content-center align-items-stretch">                    
                                    <div class=" ms-0 d-flex align-items-center justify-content-center">
                                        <label class="visually-hidden" for="<?= $k ?>">Cantidad: </label>
                                        <input type="number" class="form-control" value="<?= $p['cantidad'] ?>" id="<?= $k ?>" name="<?= $k ?>" size="3">
                                    </div>
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
                                <td>
                                    <div class="productoCarritoCerrar ms-auto d-flex puntero  d-flex align-items-center">
                                        <a href="admin/acciones/item-acc.php?id=<?= $k?>&del=true">
                                            <span class="me-1"></span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="contenedorProductosCarrito">
                    <div class="p-3 fs-4">
                        <p class="my-3 text-end">Total <span class="fw-bold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16"><path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/></svg><span>2000.00</span></p>
                    </div>
                </div>
                <div class="p-3 my-3 d-flex justify-content-end gap-2">
                    <div>
                        <a href="admin/acciones/vaciar-carrito-acc.php" class="btn btn-borrar fw-bold text-light">Vaciar Carrito</a>
                    </div>
                    <div>
                        <a href="index.php?view=tienda" class="btn btn-editar fw-bold text-light">Seguir Comprando</a>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-editar fw-bold text-light" value="Actualizar Valores">
                    </div>
                    <div>
                        <a href="#" class="btn btn-agregar fw-bold text-light">Finalizar Compra</a>
                    </div>
                </div>
            </form>
        <?php } else { ?>
            <div>
                <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center fw-bold my-2 mx-auto px-2">Tu carrito esta vacio</h2>
                <p class="fs-5 w-75 mx-auto fw-bold text-center fs-5">Para volver a la tienda hás click <a class="fs-3" href="index.php?view=tienda">aquí.</a></p>
            </div>
        <?php } ?>
</section>