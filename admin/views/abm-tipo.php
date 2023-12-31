<?php
    $id = $_GET['id'] ?? false;
    $del = $_GET['del'] ?? false;
    $datosForm = (new Validate)->getForm();
    $id = $datosForm ? ( $datosForm['id'] ?? $id ) : $id;
    $alertForm = $_SESSION['alertForm'] ? (new Alert)->getFormAlert() : false;
    $tipo = $id ? (new tipo)->tipoID($id) : new Tipo;
    $dispo = $tipo->getDisponibilidadId();
    $disponibilidad = $tipo->getAllDisponibilidad();
    $categorias = (new Categoria)->getAllCategorias();
?>

<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Alta, Baja y Modificacion de Tipos</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de Tipos de productos</p>
    <div class="listado pb-3">
        <article>
            <div class="row g-4 my-2 container mx-auto">
                <form action="acciones/abm-tipo-accion.php<?= $id ? ($del ? "?id=$id&del=1" : "?id=$id" ) : "" ?>" method="POST">
                    <div class="row align-items-start">
                        <div class="col-12 col-sm-6">
                            <!-- titlo -->
                            <div class="mb-3">
                            <h3 class='text-center fw-bold <?= $id ? ($del ? 'borrar' : 'editar' ) : 'agregar' ?> '>Agregar Tipo</h3>
                            <p class="text-center">Los campos marcados con <span class="obligatorio fs-4"> *</span> son obligatorios</p>
                            </div>
                            <!-- input nombre -->
                            <div class="mb-3 form-floating">
                                <?php 
                                    if ($id){?>
                                        <input type="text" class="form-control" id="name" <?php echo $del ? "Disabled" : ""; ?>   value="<?=  $tipo->getName() ?>"  name="name" >
                                <?php  } else {?>
                                    <input type="text" class="form-control" id="name" placeholder="a" name="name" value="<?= $datosForm['name'] ?? $tipo->getName() ?>" >
                                <?php  }?>
                                <label for="name" class="col-form-label ms-2" placeholder="a">Nombre del tipo<span class="obligatorio fs-5"> *</span></label>
                                <div>
                                    <?= $alertForm ? (array_key_exists('name', $alertForm) ? $alertForm['name'] : "") : '' ?>
                                </div> 
                            </div>
                            <!-- input cate -->
                            <div class="mb-3 form-floating">
                                <select <?php echo $del ? "Disabled" : ""; ?> class="form-select" name="id_categoria" id="id_categoria" >
                                    <option value="" selected disabled>Elija una Categoria</option>
                                    <?PHP foreach ($categorias as $c) { 
                                        $selectedCate = $datosForm['id_categoria'] == $c->getId() ? 'selected' : '' ?>
                                        <option class="text-capitalize" value="<?= $c->getId() ?>" <?= $id ? ($c->getId() == $tipo->getCategoria()->getId() ? "selected" : "") : "$selectedCate" ?>><?= $c->getName() ?></option>
                                    <?PHP } ?>
                                </select>
                                <label for="id_categoria" class="col-form-label ms-2"> Seleccione una Catergoria<span class="obligatorio fs-5"> *</span></label>
                                <div>
                                <?= $alertForm ? (array_key_exists('id_categoria', $alertForm) ? $alertForm['id_categoria'] : "") : '' ?>
                                </div> 
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <!-- texto radio -->
                            <div class="mb-3">
                               <?php echo $del ? " <p class='text-center'><span class='fs-5'>Disponibilidad</span></p>" : "<p><span Class='fw-bold'>Seleccione si la Disponibilidad del Tipo de producto si ya existe.</span><br></span>Selecciones 0 si esta disponible todos los dias<br> <span class='fw-bold'>Si tiene que cargar nueva,</span> tiene la opción de elegir una Fecha Particular o Ingresar una cantidad de días.<span class='obligatorio fs-5'> *</span></p>"; ?>
                            </div>
                            <!-- radio -->
                            <div class="mb-3 formularioApp">
                                <?php
                                    $checkRadio = $datosForm['radio'] ?? false;
                                    $ternaryVue = '(radio === "dias" || radio === "fecha") ? true : false';
                                    $html = '';
                                    if ($dispo){
                                        foreach ($disponibilidad as $d => $v) {
                                            $selected = '';
                                            $tiempo = strtotime($v['tiempo']) ? $v['tiempo'] : $v['tiempo']." dias";
                                            if ($dispo['id'] == $v['id']) {
                                                $checkRadio = 'select';
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
                                <div>
                                <?= $alertForm ? (array_key_exists('radio', $alertForm) ? $alertForm['radio'] : "") : '' ?>
                                </div>
                                <div class="form-check d-flex justify-content-start">
                                    <input <?= $checkRadio == 'select' ? ":placeholder='checked()'" :"" ?> <?php echo $del ? "Disabled" : ""; ?> v-model="radio" class="form-check-input" type="radio" id="select" name="radio" value="select">
                                    <label class="mx-2" for="select">Seleccione Disponibilidad</label>
                                    <select class="ms-auto my-1" name="select" id="select" <?php echo $del ? "Disabled" : ":disabled='$ternaryVue'" ?> >
                                        <option value="" selected >Elija una opción</option>
                                        <?= $html ?>
                                    </select>
                                </div>
                                <div class="form-check d-flex justify-content-start">
                                    <input v-model="radio" <?= $checkRadio == 'fecha' ? ":placeholder='checked()'" :"" ?> class="form-check-input" type="radio" id="fecha" name="radio" value="fecha">
                                    <label class="mx-2" for="fecha">Ingrese la Fecha</label>
                                    <input class="ms-auto my-1" type="date" name="fecha" :disabled="(radio === 'dias' || radio === 'select') ? true : false" value="<?= $datosForm['fecha'] ?? "" ?>">
                                </div>
                                <div class="form-check  d-flex justify-content-start">
                                    <input v-model="radio" <?= $checkRadio == 'dias' ? ":placeholder='checked()'" :"" ?> class="form-check-input" type="radio" id="dias" name="radio" value="dias">
                                    <label class="mx-2" for="dias">Ingrese la cantidad de días</label>
                                    <input class="ms-auto my-1" type="number" name="dias" :disabled="(radio === 'fecha' || radio === 'select') ? true : false" value="<?= $datosForm['dias'] ?? "" ?>" >
                                </div>
                            </div>
                            <?= $alertForm ? (array_key_exists('tiempo', $alertForm) ? $alertForm['tiempo'] : "") : '' ?>
                        </div>
                        <!-- descript -->
                        <div class="mb-3 form-floating">
                            <?php 
                                if ($id){?>
                            <textarea class="form-control" id="descript-text" <?php echo $del ? "Disabled" : ""; ?>  name="descript" rows="6" style="height:100%;" placeholder="a"><?= $datosForm['descript'] ?? $tipo->getDescript() ?></textarea>
                            <?php  } else {?>
                                <textarea class="form-control" id="descript-text" placeholder="a" name="descript" rows="6" style="height:100%;" ><?= $datosForm['descript'] ?? "" ?></textarea>
                            <?php  }?>
                            <label for="descript-text" class="col-form-label ms-2">Descripción del Tipo de producto</label>
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
    <script src="js/appForm.js"></script>
</section>