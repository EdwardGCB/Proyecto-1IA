<?php
//primero dedo buscar que los asientos queden juntos y despues preguntar a que cliente van
if (!isset($_GET['idEvento'])) {
  header("Location: ../index.php");
}
$idEvento = $_GET['idEvento'];
$idCliente = $_SESSION['id'];
$cliente = new Cliente($idCliente);
if ($cliente->consultar() == false) {
  header("Location: iniciarSesion.php");
}
// Crear una instancia de Evento con el idEvento y obtener los detalles del evento
$evento = new Evento($idEvento);
// Esto debería cargar todos los datos del event
// Verificar si el evento fue encontrado
if (!$evento->consultaIndividual()) {
  header("Location: ../Proyecto-1IA/");
}
$total = 0;
$eventoZona = new EventoZona(null, null, $evento);
$eventosZona = $eventoZona->consultarPorEvento();
$cantidadCorreos = 0;
if (isset($_POST["consultar"])) {
  $numeros = $_POST['numero'];
}
if (isset($_POST["agregar"])) {
  $numeros = $_POST['numero'];
  $correos = $_POST['correo'];
  $correosRepetidos = array();
}
if (isset($_POST["generarTicket"])) {
  $iva = 0.19;
  $tickets = array();
  $numeros = $_POST['numero'];
  $correos = $_POST['correo'];
  foreach ($eventosZona as $eventoZona2) {
    $idZona = $eventoZona2->getZona()->getIdZona();
    for ($i = 0; $i < $numeros[$idZona]; $i++) {
      if ($correos[$idZona][$i] == "") {
      } else {
        $clienteTemp = new Cliente(null, null, null, $correos[$idZona][$i]);
        $clienteTemp->autenticarCorreo();
        $asiento = new Asiento(null, null, null, $eventoZona2->getZona());
        $asiento->consultarAsiento(1, $evento->getIdEvento());
        $ticket = new Ticket(null, $eventoZona2->getValor(), $asiento, $clienteTemp, null, $eventoZona2);
        $total += $eventoZona2->getValor();
        $cantidadCorreos++;
        array_push($tickets, $ticket);
      }
    }
  }
  $factura = new Factura(null, $total, $cantidadCorreos, $iva, $cliente);
  $factura->generarFactura();
  echo $factura->getIdFactura();
  foreach ($tickets as $ticketActual) {
    $ticketActual->setFactura($factura);
    $ticketActual->generarTicket();
  }
  header("Location: ../Factura.php?idFactura=" . $factura->getIdFactura() . "");
}
?>
<style>
  .p-3 {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 6px;
  }

  .col-md-4 {
    justify-content: center;
    align-items: center;
  }

  .col-lg-4 .p-3 {
    margin: 5px;
    width: 25vw;
    height: 31vw;
  }

  .card-custom {
    margin-top: 20px;
  }

  .card .row {
    padding: 10px;
  }

  .square {
    width: 19vw;
    height: 19vw;
  }

  /* Table and form styling to match the mockup */
  .container {
    max-width: 1200px;
    margin: auto;
  }

  .seat-reservation table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
  }

  .seat-reservation th,
  .seat-reservation td {
    padding: 10px;
    text-align: left;
  }

  .seat-reservation th {
    background-color: #f4f4f4;
  }

  .payment {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .payment h3 {
    font-size: 24px;
  }

  .payment p {
    font-size: 24px;
  }

  .payment button {
    background-color: #f39c12;
    border: none;
    padding: 10px 20px;
    color: white;
    cursor: pointer;
    font-size: 16px;
  }
</style>

<!-- Include the navigation bar component -->
<?php include("componentes/navcliente.php") ?>
<br>

<!-- Event details section -->
<main class="container">
  <div class="row">
    <div class="col">
      <section class="event-details">
        <h1><?php echo $evento->getNombre(); ?></h1>
        <p>
          <?php echo "Fecha: " . $evento->getFechaEvento() . ", Hora: " . $evento->getHoraEvento() . ", Lugar: " . $evento->getSitio() . ", Ciudad: " . $evento->getCiudad()->getNombre(); ?>
        </p>
        <p>Promotor: <?php echo $evento->getProveedor()->getNombre(); ?></p>
      </section>
    </div>
    <div class="col">
      <img src="https://via.placeholder.com/150" alt="flayer del evento">
    </div>
  </div>


  <!-- Seat reservation table -->
  <section class="seat-reservation">
    <h2>Reserva de asientos automáticos</h2>
    <form method="post" action="?pid=<?=base64_encode("paginas/comprarTicket.php")?>&idEvento=<?= $evento->getIdEvento() ?>">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Categoría de asiento</th>
            <th>Preferencia (*)</th>
            <th>Cantidad</th>
            <th>Precio unitario</th>
            <th>Disponibilidad</th>
            <th>Accion</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($eventosZona as $eventoZonaActual) {
            $idZona = $eventoZonaActual->getZona()->getIdZona();
            $asiento = new Asiento(null, null, null, $eventoZonaActual->getZona());
            $cantAsientos = $asiento->asientosDisponibles($evento);
          ?>
            <tr>
              <td><span style="color: <?= $eventoZonaActual->getZona()->getColor(); ?>;">●
                  <?= $eventoZonaActual->getZona()->getNombre() ?></span> <?= ($cantAsientos != 0) ? "" : "agotado" ?>
              </td>
              <td>Automático</td>
              <td>
                <input <?= ($cantAsientos != 0) ? "" : "for='disabledTextInput'" ?> class="form-control" type="number"
                  name="numero[<?= $idZona ?>]" min="0" max="10"
                  value="<?= isset($numeros[$idZona]) ? htmlspecialchars($numeros[$idZona]) : 0 ?>">
                <?php
                if (isset($numeros[$idZona]) && $numeros[$idZona] > $cantAsientos) {
                  echo "<div class='alert alert-danger' role='alert'>Cantidad no disponible</div></td><td>$0</td>";
                }
                ?>
              </td>
              <td>$<?= number_format($eventoZonaActual->getValor(), 2); ?></td>
              <td><?= $cantAsientos; ?></td>
              <td>
                <button type="submit" name="consultar" class="btn btn-dark"
                  <?= ($cantAsientos != 0) ? "" : "disabled" ?>>Consultar</button>
              </td>
            </tr>
            <?php if (isset($_POST["consultar"]) || isset($numeros)) {
              if (array_key_exists($idZona, $numeros) && $numeros[$idZona] > 0) {
                for ($i = 0; $i < $numeros[$idZona]; $i++) { ?>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>
                      <div class="form-floating mb-3">
                        <input type="email" name="correo[<?= $idZona ?>][<?= $i ?>]" class="form-control" id="floatingInput"
                          placeholder="name@example.com" value="<?php echo (isset($correos) && !in_array($correos[$idZona][$i], array_column($correosRepetidos, 'email'))) ? $correos[$idZona][$i] : "" ?>">
                        <label for="floatingInput">Correo Usuario</label>
                      </div>
                    </td>
                    <td>
                      <?php
                      if (isset($_POST["agregar"]) || isset($correos)) {
                        if (array_key_exists($idZona, $correos)) {
                          //Validacion de correo repetido
                          if (in_array($correos[$idZona][$i], array_column($correosRepetidos, 'email'))) {
                            echo "<div class='alert alert-danger' role='alert'>Correo ya registrado</div></td><td>$0</td>";
                          } else {
                            $clienteTemp = new Cliente(null, null, null, $correos[$idZona][$i]);
                            if (!$clienteTemp->autenticarCorreo()) {
                              $ticket = new Ticket(null, null, null, $clienteTemp, null, $eventoZonaActual);
                              //Validacion de correo con ticket 
                              if (!$ticket->consultarTicket()) {
                                $correosRepetidos[] = ['email' => $clienteTemp->getCorreo()];
                                $cantidadCorreos++;
                                echo "<div class='alert alert-success' role='alert'>" . htmlspecialchars($clienteTemp->getCorreo()) . "</div></td>";
                                echo "<td>" . number_format($eventoZonaActual->getValor(), 2) . "</td>";
                              } else {
                                echo "<div class='alert alert-danger' role='alert'>Correo ya cuenta con un ticket</div></td><td>$0</td>";
                              }
                            } else {
                              echo "<div class='alert alert-danger' role='alert'>Correo no encontrado</div></td><td>$0</td>";
                            }
                          }
                        }
                      } else {
                        echo "</td><td></td>";
                      } ?>
                <?php
                }
                $total += $eventoZonaActual->getValor() * $cantidadCorreos;
                echo "
                  <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>SubTotal:</td>
                    <td><input type='hidden' name='subTotal[$idZona]' value='" . ($eventoZonaActual->getValor() * $cantidadCorreos) . "'>$" . number_format(($eventoZonaActual->getValor() * $cantidadCorreos), 2) . "</td>
                    <td><button type='submit' name='agregar' class='btn btn-success'>Agregar</button></td>
                </tr>";
              }
            } ?>
              <?php
            } ?>
        </tbody>
      </table>
      <div class="row">
        <div class="col">
          <h3>Total</h3>
        </div>
        <div class="col">
          <p>$<?= $total ?></p>
        </div>
        <div class="col">
          <button type="submit" name="generarTicket" class="btn btn-warning">Pagar</button>
          <input type="hidden" name="total" value="<?= $total ?>">
        </div>
      </div>
    </form>
  </section>
  <!-- Include the footer component -->
  <?php include("componentes/footer.php"); ?>

  <script src="js/compratTicket.js">

  </script>