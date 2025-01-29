<?php
if ($evento) {
?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Zona</th>
        <th scope="col">valor</th>
        <th scope="col">aforo</th>
        <th scope="col">total</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $totalAforos = 0;
      $total = 0;
      $eventoZona = new EventoZona(null, null, $evento);
      $eventosZona = $eventoZona->consultarPorEvento();
      foreach ($eventosZona as $eventoZonaActual) {
        $totalAforos += $eventoZonaActual->getAforo();
        echo '<tr style="background-color:' . $eventoZonaActual->getZona()->getColor() . ';">';
        echo '<td>' . $eventoZonaActual->getZona()->getNombre() . '</td>';
        echo '<td>$' . number_format($eventoZonaActual->getValor(), 2) . '</td>';
        echo '<td>' . $eventoZonaActual->getAforo() . '</td>';
        echo '<td>' . number_format($eventoZonaActual->getAforo() * $eventoZonaActual->getValor(), 2) . '</td>';
        echo '</tr>';
        $total += $eventoZonaActual->getAforo() * $eventoZonaActual->getValor();
      }
      ?>
      <tr>
        <th scope="row">Total: </th>
        <td></td>
        <td><?php echo $totalAforos ?></td>
        <td><?php echo number_format($total, 2) ?></td>
      </tr>
    </tbody>
  </table>
<?php
}
?>