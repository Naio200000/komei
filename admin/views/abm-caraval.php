<?php
    $id = $_GET['id'] ?? false;
    $del = $_GET['del'] ?? false;
    $datosForm = (new Validate)->getForm();
    $id = $datosForm ? ( $datosForm['id'] ?? $id ) : $id;
    $alertForm = $_SESSION['alertForm'] ? (new Alert)->getFormAlert() : false;
    $caraval = $id ? (new Caraval)->caravalID($id) : new Caraval;
    $caracteristicas = (new Caracteristica)->getAllCaracteristicas();
    $valores = (new Valor)->getAllValores();
?>

<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Alta, Baja y Modificacion de Tipos</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de Tipos de productos</p>
    <div class="listado pb-3">
        <article>
            <div class="row g-4 my-2 container mx-auto">
                <form action="acciones/abm-caraval-accion.php<?= $id ? ($del ? "?id=$id&del=1" : "?id=$id" ) : "" ?>" method="POST">
                    <div class="row align-items-start">
                        <div class="col-12 col-sm-6">
                            <!-- titlo -->
                            <div class="mt-5 mb-3">
                                <h3 class='text-center fw-bold text-capitalize <?= $id ? ($del ? 'borrar' : 'editar' ) : 'agregar' ?> '><?= $id ? ($del ? 'borrar' : 'editar' ) : 'agregar' ?>  Relación <span class="d-block">Caracteristica / Valor</span> </h3>
                                <p class="text-center">Los campos marcados con <span class="obligatorio fs-4"> *</span> son obligatorios</p>
                            </div>
                        </div>
                        <!-- caracteristicas -->
                        <div class="col-12 col-sm-6">
                            <div class="my-3">
                                <label for="caracterisitca" class="form-label">Caracteristicas<span class="obligatorio fs-4"> *</span></label>
                                <select class="form-select" <?php echo $del ? "Disabled" : ""; ?> name="caracteristica" id="caracteristica" >
                                    <option value="" selected disabled>Elija una Caracteristica</option>
                                    <?PHP foreach ($caracteristicas as $c) {
                                        $selectedCara = $datosForm['caracteristica'] == $c->getId() ? 'selected' : '' ?>
                                        <option value="<?= $c->getId() ?>" <?= $id ? ($c->getName() == $caraval->getName()->getName() ? "selected" : "" ) : "$selectedCara" ?>><?= $c->getName()?></option>
                                    <?PHP } ?>
                                </select>
                                <div>
                                    <?= $alertForm ? (array_key_exists('caracteristica', $alertForm) ? $alertForm['caracteristica'] : "") : "" ?>
                                </div> 
                            </div>
                            <!-- valores -->
                            <div class="my-3">
                                <label for="valor" class="form-label">Valores<span class="obligatorio fs-4"> *</span></label>
                                <select class="form-select" <?php echo $del ? "Disabled" : ""; ?> name="valor" id="valor">
                                    <option value="" selected disabled>Elija un Valor</option>
                                    <?PHP foreach ($valores as $v) { 
                                        $selectedVal = $datosForm['valor'] == $v->getId() ? 'selected' : '' ?>                                        
                                        <option value="<?= $v->getId() ?>" <?= $id ? ( $v->getValor() == $caraval->getValor()->getValor() ? "selected" : "" ) : "$selectedVal" ?>><?= $v->getValor() ?></option>
                                    <?PHP } ?>
                                </select>
                                <div>
                                    <?= $alertForm ? (array_key_exists('valor', $alertForm) ? $alertForm['valor'] : "") : "" ?>
                                </div>
                            </div>
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