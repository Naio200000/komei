<?php
    $id = $_GET['id'] ?? false;
    $del = $_GET['del'] ?? false;
    $categoria = $id ? (new Categoria)->categoriaID($id) : (new Categoria);
    $datosForm = (new Validate)->getForm();
    echo "<pre>";
    print_r($datosForm);
    echo "</pre>";
?>

<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Alta, Baja y Modificacion de Categorias</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de Categorias principales de la tienda</p>
    <div class="listado pb-3">
        <article>
            <div class="row g-4 my-2 container mx-auto">
                <?php 
                    if ($id){
                        if ($del) { ?>
                            <form action="acciones/abm-categoria-accion.php?id=<?= $id ?>&del=<?= $del ?>" method="POST">
                        <?php } ?>
                        <form action="acciones/abm-categoria-accion.php?id=<?= $id ?>" method="POST">
                <?php  } else {?>
                    <form action="acciones/abm-categoria-accion.php" method="POST">
                <?php  }?>
                    <div class="row align-items-start">
                        <div class="mb-3 col-12 col-sm-6">
                           <?php 
                            if (!$id) { ?>
                                <h3 class='text-center fw-bold agregar'>Agregar Categoria</h3>
                            <?php } else {
                                if (!$del) { ?>
                                    <h3 class='text-center fw-bold editar'> Editar Categoria</h3>
                                <?php } else  { ?>        
                                    <h3 class='text-center fw-bold borrar'> Borrar Categoria</h3>
                                <?php } 
                            } ?>
                            <p class="text-center">Los campos marcados con <span class="obligatorio fs-4"> *</span> son obligatorios</p>
                        </div>
                        <div class="mb-3 col-12 col-sm-6 form-floating">
                            <?php 
                                if ($id){?>
                                    <input type="text" class="form-control" id="name" <?php echo $del ? "Disabled" : ""; ?>   value="<?= $categoria->getName() ?>"  name="name" >
                            <?php  } else {?>
                                <input type="text" class="form-control" id="name" placeholder="a" name="name" >
                            <?php  }?>
                            <label for="name" class="col-form-label ms-2">Nombre de la Categoria<span class="obligatorio fs-4"> *</span></label>
                        </div>

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
                                <?php
                                    echo "<a class='px-3 me-1' href='index.php?view=abm-categoria-accion'><button class='fw-bold btn btn-";  
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