<?php
if (!isset($_GET["idEvento"])) {
  header("Location: ../Proyecto-1IA/");
}
$idEvento = $_GET["idEvento"];
$evento = new Evento($idEvento);
if (!$evento->consultaIndividual()) {
  header("Location: ../Proyecto-1IA/");
}
?>
<style>
  .custom-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    /* Centrado vertical */
    align-items: center;
    /* Centrado horizontal */
  }

  .custom-container img {
    width: 300;
    height: auto;
  }

  .custom-color {
    background-color: #8A0808;
    color: white;
    width: 100%;
    max-width: 100%;
    height: auto;
    padding: 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .button-color {
    background-color: #8A0808;
    color: white;
  }
</style>

<div class="container-fluid ">
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="http://www.w3.org/2000/svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        Bootstrap
      </a>
      <a href="?pid=<?= base64_encode("paginas/comprarTicket.php")?>&idEvento=<?= $evento->getIdEvento() ?>" class="btn button-color">
        <span>Comprar</span>
      </a>
    </div>
  </nav>
</div>
<div class="container mt-5">
  <div class="row">
    <div class="container custom-container">
      <img src="https://via.placeholder.com/300" alt="flayer del evento">

      <h1><?php echo $evento->getNombre(); ?></h1>
      <ul class="nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link active text-secondary" href="ciudadEvento.php?idCiudad=<?= $evento->getCiudad()->getIdCiudad() ?>"><?= $evento->getCiudad()->getNombre() ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-secondary" aria-current="page" href="?pid=<?=base64_encode("paginas/CategoriaEvento.php")?>&idCategoria=<?= $evento->getCategoria()->getIdCategoria() ?>"><?= $evento->getCategoria()->getNombre(); ?></a>
        </li>
      </ul>
      <p>Ubicación: <?= $evento->getSitio(); ?></p>
      <p>Fecha: <?php echo $evento->getFechaEvento() . " Hora: " . $evento->getHoraEvento(); ?></p>
      <p>Edad Minima: <?php echo $evento->getEdadMinima(); ?></p>
    </div>
  </div>
</div>
<div class="container mt-5 mb-5 custom-color">
  <div class="container custom-margin">
    <h2>Tarifas y localidades</h2>
    <div class="row">
      <div class="col">
        <div class="container">
          <img src="https://via.placeholder.com/300" alt="imagen estadio">
        </div>
      </div>
      <div class="col">
        <?php
        include "componentes/tablaZonaCliente.php";
        ?>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <h2>Disponibilidad</h2>
  <?php
  $cantidadReservas = $eventoZona->cantidadReservas();
  $reserva = 0;
  $totalaforoReservado = 0;
  foreach ($eventosZona as $eventoZonaActual) {
    $totalaforoReservado += $cantidadReservas[$eventoZonaActual->getZona()->getNombre()];
    $reserva += $eventoZonaActual->getValor() * $cantidadReservas[$eventoZonaActual->getZona()->getNombre()];
  }

  include "componentes/barraVentas.php";
  ?>
</div>
<?php include "componentes/footer.php"; ?>