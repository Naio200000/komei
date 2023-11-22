<?php
    $id = $_GET['id'] ?? 3;
    $del = $_GET['del'] ?? false;
    $producto = $id ? (new Producto)->productoID($id) : (new Producto);
    // $dispo = $caraval->getDisponibilidadId();
    // $disponibilidad = $caraval->getAllDisponibilidad();
    $categorias = (new Categoria)->getAllCategorias();
    $imagenes = (new Images)->getAllImages();
    $tipos = (new Tipo)->getAllTipos();
    echo '<pre>';
    print_r($producto);
    echo '</pre>';
?>

<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Alta, Baja y Modificacion de productos</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de productos principales de la tienda</p>
    <div class="listado pb-3">
        <article>
            <div class="row g-4 my-2 container mx-auto">
                <?php 
                    if ($producto){
                        if ($del) { ?>
                            <form action="acciones/abm-producto-accion.php?id=<?= $id ?>&del=<?= $del ?>" method="POST">
                        <?php } ?>
                        <form action="acciones/abm-producto-accion.php?id=<?= $id ?>" method="POST">
                <?php  } else {?>
                    <form action="acciones/abm-producto-accion.php" method="POST">
                <?php  }?>
                    <div class="row align-items-start">
                        <div class="mb-3">
                            <?php
                                echo "<h3";  
                                if (!$id) {
                                    echo " class='text-center fw-bold agregar'>Agregar";
                                } elseif (!$del) {
                                    echo " class='text-center fw-bold editar'> Editar";    
                                } else {
                                    echo " class='text-center fw-bold borrar'> Borrar";    
                                }
                                echo " Producto</h3>";
                            ?>
                        </div>
                        <div class=" col-12 col-sm-6">
                            <div class="mb-3 col-12 form-floating">
                                <?php 
                                    if ($id){?>
                                        <input type="text" class="form-control" id="name" <?php echo $del ? "Disabled" : ""; ?>   value="<?= $producto->getNombre() ?>"  name="name" >
                                <?php  } else {?>
                                    <input type="text" class="form-control" id="name" placeholder="a" name="name" >
                                <?php  }?>
                                <label for="name" class="col-form-label ms-2">Nombre de la producto</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <?php 
                                    if ($id){?>
                                        <textarea class="form-control" id="descript-text" <?php echo $del ? "Disabled" : ""; ?>  name="descript" rows="6" style="height:100%;" ><?= $producto->getDescrip() ?></textarea>
                                <?php  } else {?>
                                        <textarea class="form-control" id="descript-text" placeholder="a" name="descript" rows="6" style="height:100%;" ></textarea>
                                <?php  }?>
                                <label for="descript-text" class="col-form-label ms-2">Descripción del Producto</label>
                            </div>
                        </div>
                        <div class=" col-12 col-sm-6">
                            <div class="mb-3 form-floating">
                                <select <?php echo $del ? "Disabled" : ""; ?> class="form-select" name="id_categoria" id="id_categoria" required>
                                    <option value="" selected disabled>Elija una Categoria</option>
                                    <?PHP foreach ($categorias as $c) { ?>
                                        <option class="text-capitalize" value="<?= $c->getId() ?>" <?= $c->getId() == $producto->getTipo()->getCategoria()->getId() ? "selected" : "" ?>><?= $c->getName() ?></option>
                                    <?PHP } ?>
                                </select>
                                <label for="id_categoria" class="col-form-label ms-2"> Seleccione una Catergoria</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <select <?php echo $del ? "Disabled" : ""; ?> class="form-select" name="id_categoria" id="id_categoria" required>
                                    <option value="" selected disabled>Elija un Tipo</option>
                                    <?PHP foreach ($tipos as $t) { ?>
                                        <option class="text-capitalize" value="<?= $t->getId() ?>" <?= $t->getId() == $producto->getTipo()->getId() ? "selected" : "" ?>><?= $t->getName() ?></option>
                                    <?PHP } ?>
                                </select>
                                <label for="id_categoria" class="col-form-label ms-2"> Seleccione un Tipo</label>
                            </div>

                            <div class="mb-3 col-12 form-floating">
                                <?php 
                                    if ($id){?>
                                        <input type="text" class="form-control" id="name" <?php echo $del ? "Disabled" : ""; ?>   value="<?= $producto->getPrecio() ?>"  name="name" >
                                <?php  } else {?>
                                    <input type="text" class="form-control" id="name" placeholder="a" name="name" >
                                <?php  }?>
                                <label for="name" class="col-form-label ms-2">Precio</label>
                            </div>
                        </div>
                        <div class="col-12 tabla">
                            <div class="">
                                <p class="text-center fs-3">Imagenes del producto</p>
                            </div>
                            <div class="row py-3">
                                <?php 
                                    foreach ($producto->getImagen() as $i) { ?>
                                        <div class="col-12 col-md-6 col-lg-4 form-check">
                                            <div>
                                                <img src="./../img/productos/<?= $i->getName() ?>.webp" alt="<?= $i->getDescript() ?>" class="img-productos">    
                                            </div>
                                        </div>
                                <?php } ?>
                            </div>
                            <div class="py-3">
                                <article class="accordion" id="accordionImagenes">
                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed"  type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <span class="text-dark fw-bold fs-4">Cambiar Imagenes</span>
                                            </button>
                                        </h3>
                                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionImagenes">
                                            <div class="accordion-body">
                                                <div class="row g-4 my-2 container mx-auto">
                                                    <?php foreach ($imagenes as $i) { ?>
                                                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 form-check">
                                                                <div>
                                                                    <img src="./../img/productos/<?= $i->getName() ?>.webp" alt="<?= $i->getDescript() ?>" class="img-productos">    
                                                                </div>
                                                            </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="bg-light col-12 mt-3 p-2 d-flex">
                            <div class="ms-auto">
                                <?php
                                    echo "<a class='px-3 me-1' href='index.php?view=abm-producto-accion'><button class='fw-bold btn btn-";  
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
            </div>
        </article>
    </div>
</section>