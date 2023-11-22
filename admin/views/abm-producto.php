<?php
    $id = $_GET['id'] ?? false;
    $del = $_GET['del'] ?? false;
    $producto = $id ? (new Producto)->productoID($id) : (new Producto);
    $imagenes = (new Images)->getAllImages();
    $tipos = (new Tipo)->getAllTipos();
    $caraval = (new Caraval)->getAllCaraval();

?>

<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Alta, Baja y Modificacion de productos</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de productos principales de la tienda</p>
    <div class="listado pb-3">
        <article>
            <div class="row g-4 my-2 container mx-auto">
                <!-- form -->
                <?php 
                    if ($id){
                        if ($del) { ?>
                            <form action="acciones/abm-producto-accion.php?id=<?= $id ?>&del=<?= $del ?>" method="POST">
                        <?php } ?>
                        <form action="acciones/abm-producto-accion.php?id=<?= $id ?>" method="POST">
                <?php  } else {?>
                    <form action="acciones/abm-producto-accion.php" method="POST">
                <?php  }?>
                    <div class="row align-items-start">
                        <!-- Titulo -->
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
                            <!-- Nombre -->
                            <div class="mb-3 col-12 form-floating">
                                <?php 
                                    if ($id){?>
                                        <input type="text" class="form-control" id="name" <?php echo $del ? "Disabled" : ""; ?> value="<?= $producto->getNombre() ?>"  name="name" >
                                <?php  } else {?>
                                    <input type="text" class="form-control" id="name" placeholder="a" name="name" >
                                <?php  }?>
                                <label for="name" class="col-form-label ms-2">Nombre de la producto</label>
                            </div>
                            <!-- Descripcion -->
                            <div class="mb-3 form-floating">
                                <?php 
                                    if ($id){?>
                                        <textarea class="form-control" id="descript-text" <?php echo $del ? "Disabled" : ""; ?>  name="descript" rows="6" style="height:100%;" ><?= $producto->getDescrip() ?></textarea>
                                <?php  } else {?>
                                        <textarea class="form-control" id="descript-text" placeholder="a" name="descript" rows="4" style="height:100%;" ></textarea>
                                <?php  }?>
                                <label for="descript-text" class="col-form-label ms-2">Descripción del Producto</label>
                            </div>
                        </div>
                        <div class=" col-12 col-sm-6">
                            <!-- Tipos -->
                            <div class="mb-3 form-floating">
                                <select <?php echo $del ? "Disabled" : ""; ?> class="form-select" name="id_tipo" id="id_tipo" required>
                                    <option value="" selected disabled>Elija un Tipo</option>
                                    <?PHP foreach ($tipos as $t) { ?>
                                        <option class="text-capitalize" value="<?= $t->getId() ?>" <?= $id ? $t->getId() == $producto->getTipo()->getId() ? "selected" : "" : "" ?>><?= $t->getName() ?></option>
                                    <?PHP } ?>
                                </select>
                                <label for="id_tipo" class="col-form-label ms-2"> Seleccione un Tipo</label>
                            </div>
                            <!-- precio -->
                            <div class="mb-3 col-12 form-floating">
                                <?php 
                                    if ($id){?>
                                        <input type="text" class="form-control" id="precio" <?php echo $del ? "Disabled" : ""; ?>   value="<?= $producto->getPrecio() ?>"  name="precio" >
                                <?php  } else {?>
                                    <input type="text" class="form-control" id="precio" placeholder="a" name="precio" >
                                <?php  }?>
                                <label for="precio" class="col-form-label ms-2">Precio del Produto</label>
                            </div>
                            <!-- caracteristicas -->
                            <?php 
                                if ($id) { ?>
                                    <div class="mb-3 <?php echo $del ? "grey" : "tabla"; ?> px-2 py-1 ">
                                        <p class="text-center">Caracteristicas del Producto</p>
                                        <div class="d-flex justify-content-around">
                                            <?php foreach ($producto->formatearCaravalOBJ() as $k => $v) { ?>
                                                <p class=''><span class='fw-bold text-capitalize'> <?= "$k : </span> $v </p>"?>
                                            <?php }?>
                                        </div>
                                    </div>
                            <?php } ?>
                        </div>
                        <!-- Accordion  -->
                        <div class="col-12 <?php echo $del ? "grey" : "tabla"; ?> mb-3">
                            <div class="py-3">
                                <article class="accordion " id="accordionSelect">
                                    <div class="accordion-item ">
                                        <h3 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <span class="text-dark fw-bold fs-4">Seleccionar Caracteristica</span>
                                            </button>
                                        </h3>
                                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionSelect">
                                            <div class="accordion-body">
                                                <div class="row g-4 my-2 container mx-auto">
                                                    <?php
                                                            foreach ($caraval as $cv) { ?>
                                                                <div class="col-6 col-md-4 col-lg-3 form-check">
                                                                    <div class="form-check form-switch pt-1">
                                                                        <?php
                                                                            $checked = '';
                                                                            if ($id) {
                                                                                foreach ($producto->getCaracteristicas() as $pcv) {
                                                                                    if ($pcv->getId() == $cv->getId()){
                                                                                        $checked = 'checked';
                                                                                    }
                                                                                }
                                                                            }
                                                                        ?>
                                                                        <input class="form-check-input" <?= $checked ?> type="checkbox" role="switch" id="<?= $cv->getId()?>" name="caraval[]" value="<?= $cv->getId()?>" <?php echo $del ? "Disabled" : ""; ?>>
                                                                        <label class="form-check-label" for="<?= $cv->getId()?>">
                                                                            <p class=''><span class='fw-bold text-capitalize'> <?= $cv->getName()->getName()?> : </span><?= $cv->getValor()->getValor()?> </p> 
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                        <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- imagenes -->
                                    <div class="col-12 <?php echo $del ? "grey" : "tabla"; ?> my-3">
                                        <?php 
                                            if ($id) { ?>
                                                <div class="">
                                                    <p class="text-center fs-3">Imagenes del producto</p>
                                                </div>
                                                <!-- imagenes de producto -->
                                                <div class="row py-3">
                                                    <?php
                                                        if ($id) {
                                                            foreach ($producto->getImagen() as $i) { ?>
                                                                <div class="col-12 col-md-6 col-lg-4 form-check">
                                                                    <div>
                                                                        <img src="./../img/productos/<?= $i->getName() ?>.webp" alt="<?= $i->getDescript() ?>" class="img-productos">    
                                                                    </div>
                                                                </div>
                                                        <?php }
                                                        } 
                                                    ?>
                                                </div>
                                        <?php } ?>
                                    </div>
                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <span class="text-dark fw-bold fs-4">Seleccionar Imagenes</span>
                                            </button>
                                        </h3>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="accordionSelect">
                                            <div class="accordion-body">
                                                <div class="row g-4 my-2 container mx-auto">
                                                    <?php foreach ($imagenes as $i) { ?>
                                                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 form-check">
                                                                <?php
                                                                    $checked = '';
                                                                    if ($id) {
                                                                        foreach ($producto->getImagen() as $pi) {
                                                                            if ($pi->getId() == $i->getId()){
                                                                                $checked = 'checked';
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                                    <div>
                                                                    <label for="<?= $i->getId()?>">
                                                                        <img src="./../img/productos/<?= $i->getName() ?>.webp" alt="<?= $i->getDescript() ?>" class="img-productos">    
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-switch pt-1">
                                                                    <input  class="form-check-input" type="checkbox" role="switch" id="<?= $i->getId()?>" <?= $checked?> name="imagenes[]" value="<?= $i->getId()?>" <?php echo $del ? "Disabled" : ""; ?>>
                                                                    <label class="form-check-label" for="<?= $i->getId()?>">Seleccionar</label>
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