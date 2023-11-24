<?php
    $id = $_GET['id'] ?? false;
    $del = $_GET['del'] ?? false;
    $datosForm = (new Validate)->getForm();
    $id = $datosForm ? ( $datosForm['id'] ?? $id ) : $id;
    $alertForm = $_SESSION['alertForm'] ? (new Alert)->getFormAlert() : false;
    $imagen = $id ? (new Images)->imagenID($id) : new Images;

?>

<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Alta, Baja y Modificacion de Imagenes</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de Imagenes principales de la tienda</p>
    <div class="listado pb-3">
        <article>
            <form action="acciones/abm-imagenes-accion.php<?= $id ? ($del ? "?id=$id&del=1" : "?id=$id" ) : "" ?>" method="POST" enctype="multipart/form-data">
                <div class="row g-4 my-2 container mx-auto">
                    <div class="mb-3 col-12 col-sm-6">
                        <div class="mt-5 mb-3">
                            <h3 class='text-center fw-bold text-capitalize <?= $id ? ($del ? 'borrar' : 'editar' ) : 'agregar' ?> '><?= $id ? ($del ? 'borrar' : 'editar' ) : 'agregar' ?>  Imagen</h3>
                            <p class="text-center">Los campos marcados con <span class="obligatorio fs-4"> *</span> son obligatorios</p>
                        </div>
                        <!-- imagen referencia -->
                        <div>
                            <img src="./../img/productos/<?= $imagen->getName() ?>.webp" alt="<?= $imagen->getDescript() ?>" class="img-productos">  
                            <input class="form-control" type="hidden" id="imagen_og" name="imagen_og" value="<?= $imagen->getName() ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 my-auto">
                        <?php 
                            if ($id){?>
                                <div class="mb-3 ">
                                    <label for="imagen" class="form-label ms-2">Cargue una Imagen a Reemplazar</label>
                                    <input class="form-control" type="file" id="imagen" name="imagen" <?php echo $del ? "Disabled" : ""; ?>>
                                </div>
                                <div>
                                    <?= $alertForm ? (array_key_exists('tmp_name', $alertForm) ? $alertForm['tmp_name'] : "") : "" ?>
                                </div> 
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="descript" placeholder="a" name="descript" value="<?= $imagen->getDescript() ?>" <?php echo $del ? "Disabled" : ""; ?>>
                                    <label for="descript" class="col-form-label ms-2">Escriba la descripcion de la Imagen</label>
                                </div>
                                <div>
                                    <?= $alertForm ? (array_key_exists('descript', $alertForm) ? $alertForm['descript'] : "") : "" ?>
                                </div> 
                        <?php  } else {?>
                                <div class="mb-3">
                                    <label for="imagen" class="col-form-label ms-2">Cargue una Imagen</label>
                                    <input class="form-control" type="file" id="imagen" name="imagen">
                                </div>
                                <div>
                                    <?= $alertForm ? (array_key_exists('tmp_name', $alertForm) ? $alertForm['tmp_name'] : "") : "" ?>
                                </div> 
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="descript" placeholder="a" name="descript" >
                                    <label for="descript" class="col-form-label ms-2">Escriba la descripcion de la Imagen</label>
                                </div>
                                <div>
                                    <?= $alertForm ? (array_key_exists('descript', $alertForm) ? $alertForm['descript'] : "") : "" ?>
                                </div> 
                        <?php  }?>
                    </div>
                    <div class="bg-light col-12 p-2 d-flex">
                        <div class="ms-auto">
                            <a class="mx-3 me-1" href=""><button class="fw-bold btn btn-<?= $id ? ($del ? 'borrar' : 'editar' ) : 'agregar' ?>">Confirmar</button></a>
                        </div>
                    </div>
                </div>
            </form>
        </article>
    </div>
</section>