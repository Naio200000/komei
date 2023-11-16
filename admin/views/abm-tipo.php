<?php
    $id = $_GET['id'] ?? false;
    $del = $_GET['del'] ?? false;
    $tipo = $id ? (new tipo)->tipoID($id) : new Tipo;
    $dispo = $tipo->getDisponibilidadId();
    $disponibilidad = $tipo->getAllDisponibilidad();
    $categorias = (new Categoria)->getAllCategorias();
    echo '<pre>';
    print_r($tipo);
    echo '</pre>';
    // echo '<pre>';
    // print_r($tipo->getDisponibilidadId());
    // echo '</pre>';
   
?>

<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Alta, Baja y Modificacion de Tipos</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de Tipos de productos</p>
    <div class="listado pb-3">
        <article>
            <div class="row g-4 my-2 container mx-auto">
                <?php 
                    if ($tipo){
                        if ($del) { ?>
                            <form action="acciones/abm-tipo-accion.php?id=<?= $id ?>&del=<?= $del ?>" method="POST">
                        <?php } ?>
                        <form action="acciones/abm-tipo-accion.php?id=<?= $id ?>" method="POST">
                <?php  } else {?>
                    <form action="acciones/abm-tipo-accion.php" method="POST">
                <?php  }?>
                    <div class="row align-items-start">
                        <div class="col-12 col-sm-6">
                            <!-- titlo -->
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
                                    echo " TIPO</h3>";
                                ?>
                            </div>
                            <!-- input nombre -->
                            <div class="mb-3 form-floating">
                                <?php 
                                    if ($tipo){?>
                                        <input type="text" class="form-control" id="name" <?php echo $del ? "Disabled" : ""; ?>   value="<?= $tipo->getName() ?>"  name="name" >
                                <?php  } else {?>
                                    <input type="text" class="form-control" id="name" placeholder="a" name="name" >
                                <?php  }?>
                                <label for="name" class="col-form-label ms-2">Nombre del tipo</label>
                            </div>
                            <!-- input cate -->
                            <div class="mb-3 form-floating">
                                <select class="form-select" name="id_categoria" id="id_categoria" required>
                                    <option value="" selected disabled>Elija una opción</option>
                                    <?PHP foreach ($categorias as $c) { ?>
                                        <option class="text-capitalize" value="<?= $c->getId() ?>" <?= $c->getId() == $tipo->getCategoria() ? "selected" : "" ?>><?= $c->getName() ?></option>
                                    <?PHP } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <!-- texto radio -->
                            <div class="mb-3">
                                <p class=""><span Class="fw-bold">Seleccione si la Disponibilidad del Tipo de producto si ya existe. <br></span><span class="fw-bold">Si tiene que cargar nueva,</span> tiene la opción de elegir una Fecha Particular o Ingresar una cantidad de días. Ponga 0 en cantidad de días si está disponible en el momento o todos los días</p>
                            </div>
                            <!-- radio -->
                            <div class="mb-3 formularioApp">
                                <?php
                                    $validate = false;
                                    $html = '';
                                    if ($dispo){
                                        foreach ($disponibilidad as $d => $v) {
                                            $selected = '';
                                            $tiempo = strtotime($v['tiempo']) ? $v['tiempo'] : $v['tiempo']." dias";
                                            if ($dispo['id'] == $v['id']) {
                                                $validate = true;
                                                $selected = ' selected ';
                                            }
                                            $html = $html . '<option value=' . $v['id'] . $selected . '>' . $tiempo . '</option>';
                                        }
                                    } else {
                                        foreach($disponibilidad as $d =>$v) {
                                            $tiempo = strtotime($v['tiempo']) ? $v['tiempo'] : $v['tiempo']." dias";
                                            $html = $html . '<option value=' . $v['id']  . '>' . $tiempo . '</option>';
                                        }
                                    }
                                ?>
                                <div class="form-check d-flex justify-content-start">
                                    <input <?= $validate ? ":placeholder='checked()'":"" ?> v-model="radio" class="form-check-input" type="radio" id="select" name="radio" value="select">
                                    <label class="mx-2" for="select">Seleccione Disponibilidad</label>
                                    <select class="ms-auto my-1" name="select" id="select" :disabled="(radio === 'dias' || radio === 'fecha') ? true : false">
                                        <option value="" selected >Elija una opción</option>
                                        <?= $html ?>
                                    </select>
                                </div>
                                <div class="form-check d-flex justify-content-start">
                                    <input v-model="radio" class="form-check-input" type="radio" id="fecha" name="radio" value="fecha">
                                    <label class="mx-2" for="fecha">Ingrese la Fecha</label>
                                    <input class="ms-auto my-1" type="date" name="fecha" :disabled="(radio === 'dias' || radio === 'select') ? true : false">
                                </div>
                                <div class="form-check  d-flex justify-content-start">
                                    <input v-model="radio" class="form-check-input" type="radio" id="dias" name="radio" value="dias">
                                    <label class="mx-2" for="dias">Ingrese la cantidad de días</label>
                                    <input class="ms-auto my-1" type="number" name="dias" :disabled="(radio === 'fecha' || radio === 'select') ? true : false">
                                </div>
                            </div>
                            
                        </div>
                        <div class="mb-3 form-floating">
                            <?php 
                                if ($tipo){?>
                            <textarea class="form-control" id="descript-text" <?php echo $del ? "Disabled" : ""; ?>  name="descript" rows="6" style="height:100%;" ><?= $tipo->getDescript() ?></textarea>
                            <?php  } else {?>
                                <textarea class="form-control" id="descript-text" placeholder="a" name="descript" rows="6" style="height:100%;" ></textarea>
                            <?php  }?>
                            <label for="descript-text" class="col-form-label ms-2">Descripción del Tipo de producto</label>
                        </div>
                        <div class="bg-light col-12 p-2 d-flex">
                            <div class="ms-auto">
                                <?php
                                    echo "<a class='px-3 me-1' href='index.php?view=abm-tipo-accion'><button class='fw-bold btn btn-";  
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