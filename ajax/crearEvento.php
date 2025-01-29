<div class="modal-dialog" role="document">
    <div class="modal-content rounded-5 shadow">
        <div class="modal-header p-5 pb-4 border-bottom-0">

            <h2 class="fw-bold mb-0">Nuevo Evento</h2>
        </div>
        <form action="?pid=<?= base64_encode("paginas/eventos.php"); ?>&pagina=1" method="post">
            <div class="modal-body p-5 pt-0">
                <!-- Nombre del evento -->
                <div class="form-floating mb-3">
                    <input type="text" class="form-control rounded-4" name="nombreEvento" id="nombreEvento" placeholder="">
                    <label for="nombreEvento">Nombre evento</label>
                </div>
                <!-- Edad Minima del evento -->
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="edadMinima" placeholder="" id="edadMinima"
                        aria-describedby="basic-addon1">
                    <label for="edadMinima">Edad Minima</label>
                </div>
                <!-- Fecha del evento -->
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" name="fechaEvento" id="fechaEvento" aria-label="fechaEvento"
                        aria-describedby="basic-addon1">
                    <label for="fechaEvento">Fecha Evento</label>
                </div>
                <!-- hora del evento -->
                <div class="form-floating mb-3">
                    <input type="time" class="form-control" name="horaEvento" id="horaEvento" aria-label="horaEvento"
                        aria-describedby="basic-addon1">
                    <label for="horaEvento">Hora Evento</label>
                </div>
                <!-- hora del evento -->
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="ubicacionEvento" id="ubicacionEvento"
                        aria-label="ubicacionEvento" aria-describedby="basic-addon1">
                    <label for="ubicacionEvento">Ubicacion del Evento</label>
                </div>
                <!-- Lugar del evento -->
                <select class="form-select mb-3" name="ciudad" id="ciudad" aria-label="Default select example">
                    <option selected>Ciudad</option>
                    <?php
                    $ciudad = new Ciudad();
                    $ciudades = $ciudad->consultarTodos();
                    foreach ($ciudades as $ciudadActual) {
                        echo '<option value="' . $ciudadActual->getIdCiudad() . '">' . $ciudadActual->getNombre() . '</option>';
                    }
                    ?>
                </select>
                <!-- Tipo de evento -->

                <select class="form-select mb-3" name="categoria" id="categoria" aria-label="Default select example">
                    <option selected>Categoria</option>
                    <?php
                    $categoria = new Categoria();
                    $categorias = $categoria->consultarCategorias();
                    foreach ($categorias as $categoriaActual) {
                        echo '<option value="' . $categoriaActual->getIdCategoria() . '">' . $categoriaActual->getNombre() . '</option>';
                    }
                    ?>
                </select>
                <div class="modal-footer">
                    <?php
                    $rutaCodificada = base64_encode("paginas/eventos.php");
                    ?>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?pid=<?=$rutaCodificada?>&pagina=1';">
                        Cancelar
                    </button>
                    <button type="submit" name="agregarEvento" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </form>
    </div>
</div>