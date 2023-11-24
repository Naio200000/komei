<?php
    $id = $_GET['id'] ?? false;
    $del = $_GET['del'] ?? false;
    $datosForm = (new Validate)->getForm();
    $id = $datosForm ? ( $datosForm['id'] ?? $id ) : $id;
    $alertForm = $_SESSION['alertForm'] ? (new Alert)->getFormAlert() : false;
    $categoria = $id ? (new Categoria)->categoriaID($id) : (new Categoria);
?>

<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Alta, Baja y Modificacion de Categorias</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de Categorias principales de la tienda</p>
    <div class="listado pb-3">
        <article>
            <div class="row g-4 my-2 container mx-auto">
                <!-- form -->
                <form action="acciones/abm-categoria-accion.php<?= $id ? ($del ? "?id=$id&del=1" : "?id=$id" ) : "" ?>" method="POST">
                    <div class="row align-items-start">
                        <div class="mb-3 col-12 col-sm-6">
                            <!-- titulo -->
                            <h3 class='text-center fw-bold <?= $id ? ($del ? 'borrar' : 'editar' ) : 'agregar' ?> '>Agregar Categoria </h3>
                            <p class="text-center">Los campos marcados con <span class="obligatorio fs-4"> *</span> son obligatorios</p>
                        </div>
                        <!-- categoria -->
                        <div class="mb-3 col-12 col-sm-6 form-floating">
                            <?php 
                                if ($id){?>
                                    <input type="text" class="form-control" id="name" <?php echo $del ? "Disabled" : ""; ?>   value="<?= $categoria->getName() ?>"  name="name" >
                            <?php  } else {?>
                                <input type="text" class="form-control" id="name" placeholder="a" name="name" >
                            <?php  }?>
                            <label for="name" class="col-form-label ms-2">Nombre de la Categoria<span class="obligatorio fs-4"> *</span></label>
                            <div>
                            <?= $alertForm ? (array_key_exists('name', $alertForm) ? $alertForm['name'] : "") : '' ?>
                            </div> 
                        </div>
                        <!-- descript -->
                        <div class="mb-3 form-floating">
                        <?php 
                                if ($id){?>
                            <textarea class="form-control" id="descript-text" <?php echo $del ? "Disabled" : ""; ?>  name="descript" rows="6" style="height:100%;" ><?= $categoria->getDescript() ?? $datosForm['descript'] ?></textarea>
                            <?php  } else {?>
                                <textarea class="form-control" id="descript-text" placeholder="a" name="descript" rows="6" style="height:100%;" ><?= $datosForm['descript'] ?? "" ?></textarea>
                            <?php  }?>
                            <label for="descript-text" class="col-form-label ms-2">Descripción para ser mostrada en Pagina principal de la categoria</label>
                        </div>
                        <div class="bg-light col-12 p-2 d-flex">
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