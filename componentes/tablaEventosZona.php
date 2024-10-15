<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Evento</th>
      <th scope="col">Zona</th>
      <th scope="col">valor</th>
      <th scope="col">aforo</th>
      <th scope="col">total</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $totalAforos=0;
    $total=0;
    $eventoZona = new EventoZona(null,null,$evento);
    $ecentosZona = $eventoZona->consultarPorEvento();
    foreach ($ecentosZona as $ecentoZonaActual) {
      $totalAforos +=$ecentoZonaActual->getAforo();
      echo '<tr>';
      echo '<td>'.$ecentoZonaActual->getEvento()->getNombre().'</td>';
      echo '<td>'.$ecentoZonaActual->getZona()->getNombre().'</td>';
      echo '<td>$'.number_format($ecentoZonaActual->getValor(),2).'</td>';
      echo '<td>'.$ecentoZonaActual->getAforo().'</td>';
      echo '<td>'.number_format($ecentoZonaActual->getAforo()*$ecentoZonaActual->getValor(),2).'</td>';
      echo '</tr>';
      $total += $ecentoZonaActual->getAforo()*$ecentoZonaActual->getValor();
    }
    ?>
    <tr>
      <th scope="row">Total: </th>
      <td></td>
      <td></td>
      <td><?php echo $totalAforos ?></td>
      <td><?php echo number_format($total,2) ?></td>
    </tr>
  </tbody>
</table>