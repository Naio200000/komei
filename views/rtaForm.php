<article class="dojos container-fluid container-md pb-3">
        <?php 

        $formDatos = $_POST;
        if (!empty($formDatos)) {
            $formNombre = strtolower($formDatos['nombre']);
            $formApellido = strtolower($formDatos['apellido']);
            $formEmail = strtolower($formDatos['email']);
            $formMensaje = $formDatos['mensaje'];
            $formRecepor = $formDatos['recipient-name'];
            $formCheck = isset($datosForm['newsletter']) ? "En nuestro Newsletter encontraras promociones y todas nuestras novedades de las clases y seminarios." : "";
            ?>
            <p class="fs-5 w-75 px-5 text-capitalize"> Hola  <?= $formNombre . ' ' . $formApellido ?></p>
            <p class="fs-5 w-75 px-5">Recibimos tu mensaje: <span class="mensajeRespuesta">" <?= $formMensaje ?> "</span></p>
            <p class="fs-5 w-75 px-5">Sensei <?= buscaSensei($formRecepor); ?> se contactara con vos al mail: <span class="mensajeRespuesta"><?= $formEmail ?></span></p>
            <p class="fs-5 w-75 px-5 pb-3">Muchas gracias por tu mensaje. <span><?= $formCheck ?></span></p>

        
        <?php } ?>
    </article>