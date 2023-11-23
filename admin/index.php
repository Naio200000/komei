<?php
    require_once "../libraries/autoloader.php";
    $linksValidos = (new Links)->formateaLinks();
    $viewSelected = $_GET['view'] ??  header('location: ../index.php?view=404');
    $validar = false;
    if (!array_key_exists($viewSelected, $linksValidos)) {
        $views = "404";
        $title = "Error 404 - Pagina no encontrada.";
    } else {
        if ($viewSelected != 'login') {
            if ((new Login)->verificar()) {
                $user =  $_SESSION['user'];
                if ($user->getRol()->getRoles() != 'usuario') {
                    $validar = true;
                }else {
                    header('location: ../index.php?view=404');
                }
            }
        }
        $views = $viewSelected;
        $title = $linksValidos[$viewSelected]['title'];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komei Juku :: <?= $title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <link rel="stylesheet" href="./estilos/style.css">
</head>
<body>
    <!-- <header class="header">
        <nav class="navbar navbar-expand-md fixed-top container-fluid x-auto ">
            <div class="nav container align-items-center">
                <a class="navbar-brand " href="index.php?view=dash"><img src="../img/logo/komei_Juku.webp" alt="Logo de la escuela"></a>
                <h1 class="titulo text-uppercase text-center">Komei Juku</h1>
                <button class="navbar-toggler ms-auto m-2" type="button" data-bs-toggle="collapse" data-bs-target="#ContenidoSoporteBarranNav" aria-controls="ContenidoSoporteBarranNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse ms-5" id="ContenidoSoporteBarranNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-center text-sm-end" aria-current="page" href="index.php?view=dash">Dashboard</a>
                        </li>
                        <?php 
                            if ($validar) { ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="index.php?view=tienda" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administrar</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="index.php?view=categoria">Categorias</a></li>
                                        <li><a class="dropdown-item" href="index.php?view=tipo">Tipos</a></li>
                                        <li><a class="dropdown-item" href="index.php?view=caraval">Caracteristicas</a></li>
                                        <li><a class="dropdown-item" href="index.php?view=imagenes">Imagenes</a></li>
                                        <li><a class="dropdown-item" href="index.php?view=producto">Productos</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div>

                        </div>
                        <div>
                            <a href="acciones/auth_logout-accion.php"><p class="btn btn-komei fw-bold">Log out</p></a>
                        </div>
                    <?php }
                ?>
            </div>
        </nav>
    </header> -->
    <main>
        <?PHP require_once "views/$views.php"; ?>
    </main>
    <footer class="container-fluid mb-lg-0 footer">
        <div class="container-md">
            <div class="row align-items-center">
                <div class="col col-lg-4 p-1">
                <img class="imagen-perfil footer-perfil" src="../img/misc/perfil.webp" alt="Un señor muy buen moso">
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
                                <li class="col"><a href="https://www.instagram.com/nicolas.alsinet/" target="_blank"><img src="../img/logo/SVG/Instagram_logo_2016.svg" alt="Logo de Instagram"></a></li>
                                <li class="col"><a href="https://www.linkedin.com/in/nicolas-alsinet-99a067226/" target="_blank"><img src="../img/logo/SVG/LinkedIn_icon.svg" alt="Logo de linkedin"></a></li>
                                <li class="col"><a href="https://github.com/Naio200000" target="_blank"><img src="../img/logo/SVG/github_icon.svg" alt="Logo de Github"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script type="module" src="../js/main.js"></script>
</body>
<div class="modal fade contactoModal" id="modalContactoDojos" tabindex="-1" aria-labelledby="modalContactoDojosLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modalCustom">
            <div class="modal-header">
                <p class="modal-title fs-5" id="modalContactoDojosLabel">Mensaje Nuevo</p>
            </div>
            <div class="container-fluid ">
                <form action="index.php?view=rtaForm" method="POST">
                    <div class="row align-items-start">
                        <div class="col col-lg-6">
                            <div class="my-4">
                                <p class="text-center">Envíanos un mensaje con cualquier consulta que tengas.</p>
                                <p class="text-center">También contanos tus experiencias en las artes marciales.</p>
                                <img class="d-none d-lg-block img-fluid mx-auto mt-3 rounded-3" src="./img/misc/imagen-contactos.webp" alt="Persona escribiendo en Japones">
                            </div>
                        </div>
                        <div class="col col-lg-6 modal-body">
                            <div class="row">
                                <div class="mb-3 form-floating">
                                    <input type="text" class="form-control" id="recipient-show" placeholder="a" name="recipient-show" disabled>
                                    <input type="hidden" class="form-control inputRecipient" id="recipient-name" name="recipient-name">
                                    <label for="recipient-show" class="col-form-label ms-2">Receptor:</label>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 form-floating">
                                    <input type="text" class="form-control" id="nombre" placeholder="a" name="nombre" >
                                    <label for="nombre" class="col-form-label ms-2">Nombre</label>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 form-floating">
                                    <input type="text" class="form-control" id="apellido" placeholder="a" name="apellido" >
                                    <label for="apellido" class="col-form-label ms-2">Apellido</label>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="a" name="email" >
                                    <label for="email" class="col-form-label ms-2">E-mail</label>
                                </div>
                                <div class="mb-3 col-12 col-sm-6 form-floating">
                                    <input type="text" class="form-control" id="telefono" placeholder="a" name="telefono">
                                    <label for="telefono" class="col-form-label ms-2">Telefono</label>
                                </div>
                                <div class="mb-3 form-floating">
                                    <textarea class="form-control" id="message-text" placeholder="a" name="mensaje" rows="6" style="height:100%;" ></textarea>
                                    <label for="message-text" class="col-form-label ms-2">Mensaje:</label>
                                </div>
                                <div class="form-check form-switch mb-3 ms-3">
                                    <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter">
                                    <label class="form-check-label" for="newsletter">Deseas recibir promociones y noticias</label>
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
</html>