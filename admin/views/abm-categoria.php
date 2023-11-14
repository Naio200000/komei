<section class="abm container-fluid container-md pb-3" id="abm">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Alta, Baja y Modificacion de Categorias</h2>
    <p class="fs-5 w-75 text-center mx-auto">Administrador de Categorias principales de la tienda</p>
    <div class="listado pb-3">
        <article>
            <div class="row g-4 my-2 container mx-auto">
                <form action="index.php?view=rtaForm" method="POST">
                    <div class="row align-items-start">
                        <div class="mb-3 col-12 col-sm-6 form-floating">
                            <input type="text" class="form-control" id="nombre" placeholder="a" name="nombre" >
                            <label for="nombre" class="col-form-label ms-2">Nombre de la Categoria</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <textarea class="form-control" id="message-text" placeholder="a" name="mensaje" rows="6" style="height:100%;" ></textarea>
                            <label for="message-text" class="col-form-label ms-2">Descripción para ser mostrada en Pagina principal de la categoria</label>
                        </div>
                        <div class="bg-light col-12 p-2 d-flex">
                            <div class="ms-auto">
                                <a class=" px-3 me-1" href="index.php?view=abm-categoria"><button class="fw-bold btn btn-agregar">Agregar Categoria</button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </article>
    </div>
</section>