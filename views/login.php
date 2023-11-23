<?php

?>
<section class="login container-fluid container-md">
    <div class="home">
        <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center mt-2 mb-5 mx-auto px-2">Inciar Sessión</h2>
        <div class="row my-5 justify-content-center">
            <div class="col col-md-4">
                <div>
                    <?= (new Alert())->getAlert(); ?>
                </div> 
                <form action="./admin/acciones/auth_login-accion.php" method="POST">
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="username" name="username" placeholder="a">
                        <label for="username" class="form-label">Nombre de Usuario</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="password" class="form-control" id="pass" name="password" placeholder="a">
                        <label for="pass" class="form-label">Contraseña</label>
                    </div>
                    <button type="submit" class="btn btn-komei fw-bold ms-auto">Login</button>
                </form>
            </div>
        </div>
    </div>
</section>