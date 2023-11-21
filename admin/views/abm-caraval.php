<?php
    $id = $_GET['id'] ?? false;
    $del = $_GET['del'] ?? false;
    $caraval = $id ? (new Caracteristicas)->caravalID($id) : new Caracteristicas;
    $caracteristicas = $caraval->getAllCaracteristicas();
    $valores = $caraval->getAllValores();
    // $dispo = $caraval->getDisponibilidadId();
    // $disponibilidad = $caraval->getAllDisponibilidad();
    // $categorias = (new Categoria)->getAllCategorias();
    echo '<pre>';
    print_r($caraval);
    echo '</pre>';
    // echo '<pre>';
    // print_r($caraval->getDisponibilidadId());
    // echo '</pre>';
   
?>

<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Alta, Baja y Modificacion de Tipos</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de Tipos de productos</p>
    <div class="listado pb-3">
        <article>
            <div class="row g-4 my-2 container mx-auto">
                <?php 
                    if ($caraval){
                        if ($del) { ?>
                            <form action="acciones/abm-caraval-accion.php?id=<?= $id ?>&del=<?= $del ?>" method="POST">
                        <?php } ?>
                        <form action="acciones/abm-caraval-accion.php?id=<?= $id ?>" method="POST">
                <?php  } else {?>
                    <form action="acciones/abm-caraval-accion.php" method="POST">
                <?php  }?>
                    <div class="row align-items-start">
                        <div class="col-12 col-sm-6">
                            <!-- titlo -->
                            <div class="mt-5 mb-3">
                                <?php
                                    echo "<h3";  
                                    if (!$id) {
                                        echo " class='text-center fw-bold agregar'>Agregar";
                                    } elseif (!$del) {
                                        echo " class='text-center fw-bold editar'> Editar";    
                                    } else {
                                        echo " class='text-center fw-bold borrar'> Borrar";    
                                    }
                                    echo " Relacion <br> Caracteristica/Valor</h3>";
                                ?>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="my-3">
                                <label for="caracterisitca" class="form-label">Caracteristicas</label>
                                <select class="form-select" name="caracterisitca" id="caracterisitca" required>
                                    <option value="" selected disabled>Elija una Caracteristica</option>
                                    <?PHP foreach ($caracteristicas as $c) { ?>
                                        <option  value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                                    <?PHP } ?>
                                </select>
                            </div>
                            <div class="my-3">
                                <label for="valor" class="form-label">Valores</label>
                                <select class="form-select" name="valor" id="valor" required>
                                    <option value="" selected disabled>Elija un Valor</option>
                                    <?PHP foreach ($valores as $v) { ?>
                                        <option value="<?= $v['id'] ?>"><?= $v['valor'] ?></option>
                                    <?PHP } ?>
                                </select>
                            </div>
                        </div>
                            

                        <!-- <div class="col-12 col-sm-6">
                            <radio -
                                <?php
                                //     $validate = false;
                                //     $ternaryVue = '(radio === "dias" || radio === "fecha") ? true : false';
                                //     $html = '';
                                //     if ($dispo){
                                //         foreach ($disponibilidad as $d => $v) {
                                //             $selected = '';
                                //             $tiempo = strtotime($v['tiempo']) ? $v['tiempo'] : $v['tiempo']." dias";
                                //             if ($dispo['id'] == $v['id']) {
                                //                 $validate = true;
                                //                 $selected = ' selected ';
                                //             }
                                //             $html = $html . '<option value=' . $v['id'] . $selected . '>' . $tiempo . '</option>';
                                //         }
                                //     } else {
                                //         foreach($disponibilidad as $d =>$v) {
                                //             $tiempo = strtotime($v['tiempo']) ? $v['tiempo'] : $v['tiempo']." dias";
                                //             $html = $html . '<option value=' . $v['id']  . '>' . $tiempo . '</option>';
                                //         }
                                //     }
                                 ?>
                                <div class="form-check d-flex justify-content-start">
                                    <input <?= $validate ? ":placeholder='checked()'":"" ?> <?php echo $del ? "Disabled" : ""; ?> v-model="radio" class="form-check-input" type="radio" id="select" name="radio" value="select">
                                    <label class="mx-2" for="select">Seleccione Disponibilidad</label>
                                    <select class="ms-auto my-1" name="select" id="select" <?php echo $del ? "Disabled" : ":disabled='$ternaryVue'" ?> >
                                        <option value="" selected >Elija una opción</option>
                                        <?= $html ?>
                                    </select>
                                </div>                         
                        </div> -->
                        <div class="bg-light col-12 p-2 d-flex">
                            <div class="ms-auto">
                                <?php
                                    echo "<a class='px-3 me-1' href='index.php?view=abm-caraval-accion'><button class='fw-bold btn btn-";  
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
    <script src="js/appForm.js"></script>
</section>