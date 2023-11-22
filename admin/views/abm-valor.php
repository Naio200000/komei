<?php
    $id = $_GET['id'] ?? false;
    $del = $_GET['del'] ?? false;
    $valor = $id ? (new Valor)->valorID($id) : false;
    // $dispo = $caraval->getDisponibilidadId();
    // $disponibilidad = $caraval->getAllDisponibilidad();
    // $categorias = (new Categoria)->getAllCategorias();
    echo '<pre>';
    print_r($valor);
    echo '</pre>';
    // echo '<pre>';
    // print_r($caraval->getDisponibilidadId());
    // echo '</pre>';
?>

<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Alta, Baja y Modificacion de Categorias</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de Categorias principales de la tienda</p>
    <div class="listado pb-3">
        <article>
            <div class="row g-4 my-2 container mx-auto">
                <?php 
                    if ($valor){
                        if ($del) { ?>
                            <form action="acciones/abm-valor-accion.php?id=<?= $id ?>&del=<?= $del ?>" method="POST">
                        <?php } ?>
                        <form action="acciones/abm-valor-accion.php?id=<?= $id ?>" method="POST">
                <?php  } else {?>
                    <form action="acciones/abm-valor-accion.php" method="POST">
                <?php  }?>
                    <div class="row align-items-start">
                        <div class="mb-3 col-12 col-sm-6 form-floating">
                            <?php 
                                if ($valor){?>
                                    <input type="text" class="form-control" required id="valor" <?php echo $del ? "Disabled" : ""; ?>   value="<?= $valor->getValor() ?>"  name="valor" >
                            <?php  } else {?>
                                <input type="text" class="form-control" required id="valor" placeholder="a" name="valor" >
                            <?php  }?>
                            <label for="valor" class="col-form-label ms-2">Nombre de la Valor</label>
                        </div>
                        <div class="mb-3 col-12 col-sm-6">
                            <?php
                                echo "<h3";  
                                if (!$id) {
                                    echo " class='text-center fw-bold agregar'>Agregar";
                                } elseif (!$del) {
                                    echo " class='text-center fw-bold editar'> Editar";    
                                } else {
                                    echo " class='text-center fw-bold borrar'> Borrar";    
                                }
                                echo " Valor</h3>";
                            ?>
                        </div>
                        <div class="bg-light col-12 p-2 d-flex">
                            <div class="ms-auto">
                                <?php
                                    echo "<a class='px-3 me-1' href='index.php?view=abm-valor-accion'><button class='fw-bold btn btn-";  
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