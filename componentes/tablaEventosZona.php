<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Evento</th>
      <th scope="col">Zona</th>
      <th scope="col">valor</th>
      <th scope="col">aforo</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $totalAforos=0;
    $eventoZona = new EventoZona(null,null,$evento);
    $ecentosZona = $eventoZona->consultarPorEvento();
    foreach ($ecentosZona as $ecentoZonaActual) {
      $totalAforos +=$ecentoZonaActual->getAforo();
      echo '<tr>';
      echo '<td>'.$ecentoZonaActual->getEvento()->getNombre().'</td>';
      echo '<td>'.$ecentoZonaActual->getZona()->getNombre().'</td>';
      echo '<td>$'.number_format($ecentoZonaActual->getValor(),2).'</td>';
      echo '<td>'.$ecentoZonaActual->getAforo().'</td>';
      echo '</tr>';
    }
    ?>
    <tr>
      <th scope="row">Total: </th>
      <td></td>
      <td></td>
      <td><?php echo $totalAforos ?></td>
    </tr>
  </tbody>
</table>