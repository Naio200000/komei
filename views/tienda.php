<section class="tienda container-fluid container-md pb-3" id="tienda">
    <h2 class="titulo-seccion w-75 w-lg-100 text-uppercase text-center my-2 mx-auto px-2">Tienda</h2>
    <p class="fs-5 w-75 mx-auto">En nuestra tienda encontrarás todo lo <em>necesario para tu entrenamiento</em>. Podrás encontrar paquetes de clases, toda la ropa necesaria (<span lang="ja">keikogi, Obi, Hakamas</span>) de diversos tamaños y calidad, y también podrás encontrar los equipos necesarios (<span lang="ja">Katana, Bokken</span>)</p>
    <div class="productos pb-3">
        <div class="categoria py-1 pe-2">
            <form action="#" class="d-flex justify-content-between">
                <div class="px-2">
                    <label for="ordenar-producto" class="form-label ">Ordenar</label>
                    <select name="ordenar-producto" id="ordenar-producto">
                        <option value="relevancia">Más Relevantes</option>
                        <option value="mayor">Mayor Precio</option>
                        <option value="menor">Menor Precio</option>
                    </select>
                </div>
                <div class="">
                    <label for="categoria-producto" class="form-label ">Filtrar por Categoría</label>
                    <select name="categoria-producto" id="categoria-producto">
                        <option value="Todas">Todas</option>
                        <option value="Clases">Clases</option>
                        <option value="Ropa">Ropa</option>
                        <option value="Equipos">Equipos</option>
                    </select>
                </div>
            </form>
        </div>
        <article class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 my-2 container mx-auto" id="productos">
        </article>
    </div>
</section>