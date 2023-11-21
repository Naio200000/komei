<?php
    $id = $_GET['id'] ?? false;
    $del = $_GET['del'] ?? false;
    $imagen = $id ? (new Images)->imagenID($id) : new Images;
    // $dispo = $caraval->getDisponibilidadId();
    // $disponibilidad = $caraval->getAllDisponibilidad();
    // $categorias = (new Categoria)->getAllCategorias();
    echo '<pre>';
    print_r($imagen);
    echo '</pre>';
?>

<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Alta, Baja y Modificacion de Imagenes</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de Imagenes principales de la tienda</p>
    <div class="listado pb-3">
        <article>
            <?php 
                if ($imagen){
                    if ($del) { ?>
                        <form action="acciones/abm-imagenes-accion.php?id=<?= $id ?>&del=<?= $del ?>" method="POST" enctype="multipart/form-data">
                    <?php } ?>
                    <form action="acciones/abm-imagenes-accion.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
            <?php  } else {?>
                <form action="acciones/abm-imagenes-accion.php" method="POST" enctype="multipart/form-data">
            <?php  }?>
                <div class="row g-4 my-2 container mx-auto">
                    <div class="mb-3 col-12 col-sm-6">
                        <?php 
                            if (!$id) { ?>
                                <h3 class='text-center fw-bold agregar'>Agregar Imagen</h3>
                            <?php } else {
                                if (!$del) { ?>
                                    <h3 class='text-center fw-bold editar'> Editar Imagen</h3>
                                <?php } else  { ?>        
                                    <h3 class='text-center fw-bold borrar'> Borrar Imagen</h3>
                                <?php } ?>
                                    <div>
                                    <img src="./../img/productos/<?= $imagen->getName() ?>.webp" alt="<?= $imagen->getDescript() ?>" class="img-productos">  
                                    <input class="form-control" type="hidden" id="imagen_og" name="imagen_og" value="<?= $imagen->getName() ?>">
                                    </div>
                            <?php } ?>
                    </div>
                    <div class="col-12 col-sm-6 my-auto">
                        <?php 
                            if ($id){?>
                                <div class="mb-3 ">
                                    <label for="imagen" class="form-label ms-2">Cargue una Imagen a Reemplazar</label>
                                    <input class="form-control" type="file" id="imagen" name="imagen" <?php echo $del ? "Disabled" : ""; ?>>
                                </div>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="descript" placeholder="a" name="descript" value="<?= $imagen->getDescript() ?>" <?php echo $del ? "Disabled" : ""; ?>>
                                    <label for="descript" class="col-form-label ms-2">Escriba la descripcion de la Imagen</label>
                                </div>
                        <?php  } else {?>
                                <div class="mb-3">
                                    <label for="imagen" class="col-form-label ms-2">Cargue una Imagen</label>
                                    <input class="form-control" type="file" id="imagen" name="imagen" required>
                                </div>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="descript" placeholder="a" name="descript" required>
                                    <label for="descript" class="col-form-label ms-2">Escriba la descripcion de la Imagen</label>
                                </div>
                        <?php  }?>
                    </div>
                    <div class="bg-light col-12 p-2 d-flex">
                        <div class="ms-auto">
                            <?php
                                echo "<a class='px-3 me-1' href='index.php?view=abm-imagenes-accion'><button class='fw-bold btn btn-";  
                                if (!$id) {
                                    echo "agregar'";
                                } elseif (!$del) {
                                    echo "editar'";    
                                } else {
                                    echo "borrar'";    
                                }
                                echo ">Confirmar</button></a>";
                            ?>
                        </div>
                    </div>
                </div>
            </form>
        </article>
    </div>
</section>