<?php

    require_once "includes/productos.php";
    require_once "datos/linksValidos.php";
 
    $viewSelected = isset($_GET['view']) ? $_GET['view'] : 'home';
    if (!array_key_exists($viewSelected, $linksValidos)) {
        $views = "404";
        $title = "Error 404 - Pagina no encontrada.";
    } else {
        $views = $viewSelected;
        $title = $linksValidos[$viewSelected]['title'];
    }
    $CategorySelected = isset($_GET['category']) ? $_GET['category'] : 'clases';
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komei Juku :: <?= $title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos/style.css">
</head>
<body>
    <header class="header">
        <nav class="navbar navbar-expand-md fixed-top container-fluid x-auto ">
            <div class="nav container align-items-center">
                <a class="navbar-brand " href="index.php?view=home"><img src="./img/logo/komei_Juku.png" alt="Logo de la escuela"></a>
                <h1 class="titulo text-uppercase text-center">Komei Juku</h1>
                <button class="navbar-toggler ms-auto m-2" type="button" data-bs-toggle="collapse" data-bs-target="#ContenidoSoporteBarranNav" aria-controls="ContenidoSoporteBarranNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="order-md-last minicarrito d-none d-lg-flex justify-content-lg-evenly align-items-lg-center">
                    <div class=" text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                            <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                        </svg>
                        <span class="minicarrito-precio">0</span>
                    </div>
                    <div class="text-center"> 
                        <button type="button" class="btn btn-komei position-relative px-3" data-bs-toggle="modal" data-bs-target="#carritoModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <span class="minicarrito-cantidad position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
                        </button>
                    </div>
                </div>
                <div class="collapse navbar-collapse ms-5" id="ContenidoSoporteBarranNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-center text-sm-end" aria-current="page" href="index.php?view=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-center text-sm-end" aria-current="page" href="index.php?view=nosotros">Nosotros</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="index.php?view=tienda" role="button" data-bs-toggle="dropdown" aria-expanded="false">Productos</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?view=tienda&category=clases">Clases</a></li>
                                <li><a class="dropdown-item" href="index.php?view=tienda&category=ropa">Ropa</a></li>
                                <li><a class="dropdown-item" href="index.php?view=tienda&category=equipos">Equipos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-center text-sm-end" aria-current="page" href="index.php?view=dojos">Dojos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="fixed-bottom navbar d-block d-lg-none">
            <div class="minicarrito row align-items-center my-3">
                <div class="col">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                            <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                        </svg>
                        <span class="minicarrito-precio">0</span>
                    </div>
                </div>
                <div class="col">
                    <div class="text-center">
                        <button type="button" class="btn btn-komei position-relative px-3"  data-bs-toggle="modal" data-bs-target="#carritoModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                            <span class="minicarrito-cantidad position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <?PHP require_once "views/$views.php";?>
    </main>
    <footer class="container-fluid mb-lg-0 footer">
        <div class="container-md">
            <div class="row align-items-center">
                <div class="col col-lg-4 p-1">
                <img class="imagen-perfil footer-perfil" src="./img/misc/perfil.jpg" alt="Un señor muy buen moso">
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-12 col-lg-5">
                        <ul class="datos">
                            <li>Nicolas,Alsinet</li>
                            <li>38 Años</li>
                            <li>nicolas.alsinet@davinci.edu.ar</li>
                        </ul>
                        </div>
                        <div class="col-12 col-lg-7">
                            <ul class="row social">
                                <li class="col"><a href="https://www.instagram.com/nicolas.alsinet/" target="_blank"><img src="./img/logo/SVG/Instagram_logo_2016.svg" alt="Logo de Instagram"></a></li>
                                <li class="col"><a href="https://www.linkedin.com/in/nicolas-alsinet-99a067226/" target="_blank"><img src="./img/logo/SVG/LinkedIn_icon.svg" alt="Logo de linkedin"></a></li>
                                <li class="col"><a href="https://github.com/Naio200000" target="_blank"><img src="./img/logo/SVG/github_icon.svg" alt="Logo de Github"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script type="module" src="js/main.js"></script>
</body>
<div>
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
    <div class="modal fade" id="modalContactoDojos" tabindex="-1" aria-labelledby="modalContactoDojosLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content modalCustom">
                <div class="modal-header">
                    <p class="modal-title fs-5" id="modalContactoDojosLabel">Mensaje Nuevo</p>
                </div>
                <div class="container-fluid ">
                    <form action="#">
                        <div class="row align-items-start">
                            <div class="col col-lg-6">
                                <div class="my-4">
                                    <p class="text-center">Envíanos un mensaje con cualquier consulta que tengas.</p>
                                    <p class="text-center">También contanos tus experiencias en las artes marciales.</p>
                                    <img class="d-none d-lg-block img-fluid mx-auto mt-3 rounded-3" src="./img/misc/imagen-contactos.jpg" alt="Persona escribiendo en Japones">
                                </div>
                            </div>
                            <div class="col col-lg-6 modal-body">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Receptor</label>
                                        <input type="text" class="form-control" id="recipient-name" disabled>
                                    </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label for="nombre" class="col-form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre">
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label for="apellido" class="col-form-label">Apellido</label>
                                    <input type="text" class="form-control" id="apellido">
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label for="email" class="col-form-label">E-mail</label>
                                    <input type="text" class="form-control" id="emaile">
                                </div>
                                <div class="mb-3 col-12 col-sm-6">
                                    <label for="telefono" class="col-form-label">Telefono</label>
                                    <input type="text" class="form-control" id="telefono">
                                </div>
                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea class="form-control" id="message-text"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <input type="submit" value="Enviar mensaje" data-bs-dismiss="modal" class="btn btn-komei">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="modal fade" id="carritoModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="carritoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modalCustom">
                <div class="modal-header">
                    <p class="modal-title fs-5" id="carritoModalLabel">Tu Carrito</p>
                </div>
                <div class="modal-body">
                    <div class="mx-auto container-md" id="modal-producto-carrito">
                        <div class="d-flex flex-column flex-lg-row align-items-center align-items-lg-start gap-2 carritoproductos">
                            <div id="contenedorProductosCarrito" class="contenedorProductosCarrito">
                            </div>
                            <div id="resumen" class="fs-5 mt-1 order-md-1 w-100 d-flex flex-column flex-grow-1 gap-3">
                                <form class="descuento" method="get">
                                    <label for="cupon-descuento" class="form-label">Código de descuento</label>
                                    <div class="mb-3 d-flex gap-1">
                                        <input type="text" class="form-control" id="cupon-descuento" placeholder="Código">
                                        <input type="button" value="Aplicar" id="descuento" class="btn btn-komei">
                                    </div>
                                </form>
                                <div class="recibo d-flex flex-column gap-3" id="recibo">
                                    <div class="reciboTotal d-flex justify-content-between fw-bold" id="reciboTotal">
                                        <span>Total</span>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                                <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                                            </svg>
                                            <span id="carritoPrecioProducto"></span>
                                        </span>
                                    </div>
                                    <div class="cuotas mt-3" id="cuotas">
                                        <img src="./img/misc/tarjetas.jfif" class="img-fluid" alt="logos de tarjetas" style="max-width:250px ;">
                                        <p>6 Cuotas sin Interes</p>
                                        <div class="cuotasCaldulo d-flex justify-content-between" id="cuotasCalculo">
                                            <span class="text-info fs-6">6 Cuotas de</span>
                                            <span class="text-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                                <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                                            </svg>
                                            <span id="carritoPrecioTotalCuota"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3 mb-1">
                                        <button type="button" class="btn btn-secondary me-3" id="vaciarCarrito">Vaciar</button>
                                        <button type="button" class="btn btn-komei fw-bold" data-bs-dismiss="modal">PAGAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
</html>