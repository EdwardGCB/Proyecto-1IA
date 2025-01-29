<?php
if (isset($_GET['name'])) {
    $evento = new Evento(null, null, null, null, null, $_GET['name']);
    $eventos = $evento->consultarPorNombre();
} else {
    $evento = new Evento();
    $eventos = $evento->consultaGeneral(null, 0, 15);
    $hoy = date('y-m-d');
    $evento = $evento->eventoCercano($hoy);
}
?>

<div class="row">
    <!-- Columna izquierda -->
    <?php
    if (isset($evento) && !isset($_GET['name'])) {
    ?>
        <div class="col-md-5">
            <div class="card">
                <img src="https://via.placeholder.com/750" class="card-img-top" alt="Imagen de ejemplo">
                <div class="card-body">
                    <h5 class="card-title"><?= $evento->getNombre() ?></h5>
                    <p class="card-text">Sitio: <?= $evento->getCiudad()->getNombre() . " " . $evento->getSitio() ?></p>
                    <p class="card-text">Fecha: <?= $evento->getFechaEvento() . " / " . $evento->getHoraEvento() ?></p>
                    <p class="card-text">Edad Minima: <?= $evento->getEdadMinima() ?></p>
                    <p class="card-text">Categoría: <?= $evento->getCategoria()->getNombre() ?></p>
                    <a href="paginas/eventoInfo.php?idEvento=<?= $evento->getIdEvento() ?>" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
    <?php
    } else {
        if(!isset($_GET['name'])){
            echo "<p>No se encontró el evento.</p>";
        }
    }
    ?>
    <!-- Columna derecha -->
    <div class="col-md-7">
        <div class="row">
            <?php
            $counter = 0;
            foreach ($eventos as $eventoActual) {
                if ($counter >= 6) break;
                if ($counter % 3 === 0 && $counter > 0) echo '</div><div class="row">';
                if ($evento->getIdEvento() != $eventoActual->getIdEvento()) {
            ?>
                    <div class="col-md-4 card-custom">
                        <div class="card">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Imagen de ejemplo">
                            <div class="card-body">
                                <h6 class="card-title"><?= $eventoActual->getNombre() ?></h6>
                                <p class="card-text">Sitio: <?= $eventoActual->getSitio() ?></p>
                                <p class="card-text">Fecha: <?= $eventoActual->getFechaEvento() . " / " . $eventoActual->getHoraEvento() ?></p>
                                <a href='paginas/eventoInfo.php?idEvento=<?= $eventoActual->getIdEvento() ?>'>Ver más</a>
                            </div>
                        </div>
                    </div>
            <?php
                    $counter++;
                }
            }
            ?>
        </div>
    </div>
</div>