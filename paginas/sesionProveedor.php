<?php
$id = $_SESSION["id"];
$proveedor = new Proveedor($id);
$proveedor->consultarPorId();
$evento = new Evento(
  null,
  null,
  null,
  null,
  null,
  null,
  null,
  null,
  $proveedor
);
$cantidadEventos = $evento->numeroEventosProveedor();
$hoy = date('y-m-d');
$evento = $evento->eventoCercano($hoy);
if ($evento) {
  $totalAforosR = 0;
  $total = 0;
  $eventoZona = new EventoZona(null, null, $evento);
  $eventosZona = $eventoZona->consultarPorEvento();
  $cantidadReservas = $eventoZona->cantidadReservas();
  $reserva = 0;
  $totalaforoReservado = 0;
  foreach ($eventosZona as $eventoZonaActual) {
    $totalaforoReservado += $cantidadReservas[$eventoZonaActual->getZona()->getNombre()];
    $reserva += $eventoZonaActual->getValor() * $cantidadReservas[$eventoZonaActual->getZona()->getNombre()];
  }
}
?>

<style>
  .full-height-sidebar {
    height: 100%;
  }

  .progress-bar {
    text-align: center;
    line-height: 30px;
    color: white;
  }

  .principal {
    height: 100%;
  }
</style>
<div class="row principal">
  <div class="col-2">
    <?php
    include "componentes/navProveedor.php";
    ?>
  </div>
  <div class="col-10">
    <div class="container">
      <div class="container mt-4">
        <div class="container-fluid">
          <h1>Inicio</h1>
          <p>Bienvenido <?php echo $proveedor->getNombre() ?></p>
        </div>
        <div class="row mt-3">
          <div class="col-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Eventos</h5>
                <p class="card-text">Cantidad de Eventos: <?php echo $cantidadEventos ?></p>
                <a href="eventos.php" class="btn btn-primary">Ver Eventos</a>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
              <div class="card-header text-white bg-dark">
                <h5 class="card-title">Evento mas cercano</h5>
              </div>
              <div class="card-body">
                <?php
                if ($evento) {
                  echo "<p class='card-text'> Nombre: " . $evento->getNombre() . "</p>";
                  echo "<p class='card-text'> Sitio: " . $evento->getSitio() . "</p>";
                  echo "<p class='card-text'> Ciudad: " . $evento->getCiudad()->getNombre() . "</p>";
                  echo "<p class='card-text'> Fecha: " . $evento->getFechaEvento() . " " . $evento->getHoraEvento() . "</p>";
                }
                ?>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Recaudo Evento </h5>
                <p class="card-text"> Cantidad reservas: <?= ($evento) ? $totalaforoReservado : "0" ?> </p>
                <p class="card-text"> Valor recaudo: <?= ($evento) ? $reserva : "0" ?> </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-6">
            <!-- Tabla evento -->
            <div class="card">
              <div class="card-header text-white bg-dark">
                <h5 class="card-title">Aforo <?= ($evento) ? $evento->getNombre() : "" ?></h5>
              </div>
              <div class="card-body">
                <?php include "componentes/tablaEventosZona.php"; ?>
              </div>
            </div>
          </div>
          <div class="col-6">
            <!-- lista de vantas -->
            <div class="card">
              <div class="card-header text-white bg-dark">
                <h5 class="card-title">Detalle ventas de: <?= ($evento) ? $evento->getNombre() : "" ?></h5>
              </div>
              <div class="card-body">
                <?php include "componentes/barraVentas.php" ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>