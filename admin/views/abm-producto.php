<?php
    $id = $_GET['id'] ?? false;
    $del = $_GET['del'] ?? false;
    $datosForm = (new Validate)->getForm();
    $id = $datosForm ? ( $datosForm['id'] ?? $id ) : $id;
    $alertForm = isset($_SESSION['alertForm']) ? (new Alert)->getFormAlert() : false;
    $producto = $id ? (new Producto)->productoID($id) : (new Producto);
    $imagenes = (new Images)->getAllImages();
    $tipos = (new Tipo)->getAllTipos();
    $caraval = (new Caraval)->getAllCaraval();
    echo '<pre>';
    // print_r($producto->getCaracteristicas());
    // print_r($caraval);
    echo '</pre>';

?>

<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Alta, Baja y Modificacion de productos</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de productos principales de la tienda</p>
    <div class="listado pb-3">
        <article>
            <div class="row g-4 my-2 container mx-auto">
                <!-- form -->
                <form action="acciones/abm-producto-accion.php<?= $id ? ($del ? "?id=$id&del=1" : "?id=$id" ) : "" ?>" method="POST">
                    <div class="row align-items-start">
                        <!-- Titulo -->
                        <div class="mb-3">
                            <h3 class='text-center fw-bold text-capitalize <?= $id ? ($del ? 'borrar' : 'editar' ) : 'agregar' ?> '><?= $id ? ($del ? 'borrar' : 'editar' ) : 'agregar' ?> Producto</h3>
                            <p class="text-center">Los campos marcados con <span class="obligatorio fs-4"> *</span> son obligatorios</p>
                       </div>
                        <div class=" col-12 col-sm-6">
                            <!-- Nombre -->
                            <div class="mb-3 col-12 form-floating">
                                <?php 
                                    if ($id){?>
                                        <input type="text" class="form-control" id="name" <?php echo $del ? "Disabled" : ""; ?> value="<?= $datosForm['name'] ?? $producto->getNombre() ?>"  name="name" >
                                <?php  } else {?>
                                    <input type="text" class="form-control" id="name" placeholder="a" name="name" value="<?= $datosForm['name'] ?? $producto->getNombre() ?>" >
                                <?php  }?>
                                <label for="name" class="col-form-label ms-2">Nombre de la producto<span class="obligatorio fs-4"> *</span></label>
                                <div>
                                    <?= $alertForm ? (array_key_exists('name', $alertForm) ? $alertForm['name'] : "") : '' ?>
                                </div> 
                            </div>
                            <!-- Descripcion -->
                            <div class="mb-3 form-floating">
                                <?php 
                                    if ($id){?>
                                        <textarea class="form-control" id="descript-text" <?php echo $del ? "Disabled" : ""; ?>  name="descriptlarga" rows="6" style="height:100%;" ><?= $producto->formatearDescript(true) ?></textarea>
                                <?php  } else {?>
                                        <textarea class="form-control" id="descript-text" placeholder="a" name="descriptlarga" rows="4" style="height:100%;" ><?php  echo $datosForm['descriptlarga'] ?? '' ?></textarea>
                                <?php  }?>
                                <label for="descript-text" class="col-form-label ms-2">Descripción larga del Producto<span class="obligatorio fs-4"> *</span></label>
                            </div>
                            <div>
                                <?= $alertForm ? (array_key_exists('descript', $alertForm) ? $alertForm['descript'] : "") : '' ?>
                            </div> 
                        </div>
                        <div class=" col-12 col-sm-6">
                            <!-- Tipos -->
                            <div class="mb-3 form-floating">
                                <select <?php echo $del ? "Disabled" : ""; ?> class="form-select" name="id_tipo" id="id_tipo" >
                                    <option value="" selected disabled>Elija un Tipo</option>
                                    <?PHP foreach ($tipos as $t) { 
                                        $selectedTipo = $datosForm['id_tipo'] == $t->getId() ? 'selected' : '' ?>
                                        <option class="text-capitalize" value="<?= $t->getId() ?>" <?= $id ? ($t->getId() == $producto->getTipo()->getId() ? "selected" : "") : "$selectedTipo" ?>><?= $t->getName() ?></option>
                                    <?PHP } ?>
                                </select>
                                <label for="id_tipo" class="col-form-label ms-2"> Seleccione un Tipo<span class="obligatorio fs-4"> *</span></label>
                                <div>
                                    <?= $alertForm ? (array_key_exists('id_tipo', $alertForm) ? $alertForm['id_tipo'] : "") : '' ?>
                                </div> 
                            </div>
                            <!-- precio -->
                            <div class="mb-3 col-12 form-floating">
                                <?php 
                                    if ($id){?>
                                        <input type="text" class="form-control" id="precio" <?php echo $del ? "Disabled" : ""; ?>    value="<?= $datosForm['precio'] ?? $producto->getPrecio() ?>"  name="precio" >
                                <?php  } else {?>
                                    <input type="number" class="form-control" id="precio" placeholder="a" name="precio"    value="<?= $datosForm['precio'] ?? '' ?>" >
                                <?php  }?>
                                <label for="precio" class="col-form-label ms-2">Precio del Produto<span class="obligatorio fs-4"> *</span></label>
                            </div>
                            <div>
                                    <?= $alertForm ? (array_key_exists('precio', $alertForm) ? $alertForm['precio'] : "") : '' ?>
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
                        <!-- descript corta -->
                        <div class="mb-3 col-12 form-floating">
                                <?php 
                                    if ($id){?>
                                        <input type="text" class="form-control" id="descriptcorta" <?php echo $del ? "Disabled" : ""; ?> value="<?= $datosForm['descriptcorta'] ?? $producto->formatearDescript() ?>"  name="descriptcorta" >
                                <?php  } else {?>
                                    <input type="text" class="form-control" id="descriptcorta" placeholder="a" name="descriptcorta" value="<?= $datosForm['descriptcorta'] ?? ''?>">
                                <?php  }?>
                                <label for="descriptcorta" class="col-form-label ms-2">Descripcion corta del producto<span class="obligatorio fs-4"> *</span></label>
                            </div>
                            <div>
                                <?= $alertForm ? (array_key_exists('descriptcorta', $alertForm) ? $alertForm['descriptcorta'] : "") : '' ?>
                            </div> 
                        <!-- Accordion  -->
                        <div class="col-12 <?php echo $del ? "grey" : "tabla"; ?> mb-3">
                            <div class="py-3">
                                <article class="accordion " id="accordionSelect">
                                    <div class="accordion-item ">
                                        <h3 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <span class="text-dark fw-bold fs-4">Seleccionar Caracteristica<span class="obligatorio fs-4"> *</span></span>
                                            </button>
                                        </h3>
                                        <div id="collapseOne" class="accordion-collapse collapse <?= $datosForm['imagenes'] ? 'show' : '' ?>" aria-labelledby="headingOne" data-bs-parent="#accordionSelect">
                                            <div class="accordion-body">
                                                <div class="row g-4 my-2 container mx-auto">
                                                    <?php
                                                        $cara = '';
                                                        foreach ($caraval as $cv) {
                                                            // echo '<pre>';
                                                            // print_r($cv);
                                                            // echo '</pre>';
                                                            if ($cara == '') {
                                                                $cara = $cv->getName()->getName(); ?>
                                                                <div class="col-3">
                                                                    <label for="<?= $cv->getName()->getName() ?>"><?= $cv->getName()->getName() ?></label>
                                                                    <select class="form-select" multiple aria-label="Multiple select example" id="<?= $cv->getName()->getName() ?>" name="caraval[]">
                                                                    <option value="<?= $cv->getValor()->getValor()?>"><?= $cv->getValor()->getValor()?></option>
                                                            <?php } elseif ($cara == $cv->getName()->getName()) {  ?>
                                                                    <option value="<?= $cv->getValor()->getValor()?>"><?= $cv->getValor()->getValor()?></option>
                                                            <?php } else { ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-3">
                                                                    <label for="<?= $cv->getName()->getName() ?>"><?= $cv->getName()->getName() ?></label>
                                                                    <select class="form-select" multiple aria-label="Multiple select example" id="<?= $cv->getName()->getName() ?>" name="caraval[]">
                                                                    <option value="<?= $cv->getValor()->getValor()?>"><?= $cv->getValor()->getValor()?></option>
                                                                <?php 
                                                                $cara = $cv->getName()->getName(); 
                                                            }
                                                    }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <?= $alertForm ? (array_key_exists('caraval', $alertForm) ? $alertForm['caraval'] : "") : '' ?>
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
                                                <span class="text-dark fw-bold fs-4">Seleccionar Imagenes<span class="obligatorio fs-4"> *</span></span>
                                            </button>
                                        </h3>
                                        <div id="collapseTwo" class="accordion-collapse collapse <?= $datosForm['imagenes'] ? 'show' : '' ?>" aria-labelledby="headingTwo" data-bs-parent="accordionSelect">
                                            <div class="accordion-body">
                                                <div class="row g-4 my-2 container mx-auto">
                                                    <?php foreach ($imagenes as $i) { ?>
                                                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 form-check">
                                                                <?php
                                                                    $checked = '';
                                                                    if (!$datosForm) {
                                                                        foreach ($producto->getImagen() as $pi) {
                                                                            if ($pi->getId() == $i->getId()){
                                                                                $checked = 'checked';
                                                                            }
                                                                        }
                                                                    } else {
                                                                        foreach($datosForm['imagenes'] as $pi) {
                                                                            if ($pi == $i->getId()){
                                                                                $checked = 'checked';
                                                                            }  
                                                                        }
                                                                    }
                                                                ?>
                                                                    <div>
                                                                    <label for="imagen<?= $i->getId()?>">
                                                                        <img src="./../img/productos/<?= $i->getName() ?>.webp" alt="<?= $i->getDescript() ?>" class="img-productos">    
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-switch pt-1">
                                                                    <input  class="form-check-input" type="checkbox" role="switch" id="imagen<?= $i->getId()?>" <?= $checked?> name="imagenes[]" value="<?= $i->getId()?>" <?php echo $del ? "Disabled" : ""; ?>>
                                                                    <label class="form-check-label" for="imagen<?= $i->getId()?>">Seleccionar</label>
                                                                </div>
                                                            </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <?= $alertForm ? (array_key_exists('imagenes', $alertForm) ? $alertForm['imagenes'] : "") : '' ?>
                                    </div> 
                                </article>
                            </div>
                        </div>
                        <div class="bg-light col-12 mt-3 p-2 d-flex">
                        <div class="ms-auto">
                                <a class="mx-3 me-1" href=""><button class="fw-bold btn btn-<?= $id ? ($del ? 'borrar' : 'editar' ) : 'agregar' ?>">Confirmar</button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </article>
    </div>
</section>