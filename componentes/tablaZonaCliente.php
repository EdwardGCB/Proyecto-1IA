<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Zona</th>
      <th scope="col">valor</th>
      <th scope="col">aforo</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $totalAforos=0;
    $total=0;
    $eventoZona = new EventoZona(null,null,$evento);
    $eventosZona = $eventoZona->consultarPorEvento();
    foreach ($eventosZona as $eventoZonaActual) {
      $totalAforos +=$eventoZonaActual->getAforo();
      echo '<tr style="background-color:'.$eventoZonaActual->getZona()->getColor().';">';
      echo '<td>'.$eventoZonaActual->getZona()->getNombre().'</td>';
      echo '<td>$'.number_format($eventoZonaActual->getValor(),2).'</td>';
      echo '<td>'.$eventoZonaActual->getAforo().'</td>';
      echo '</tr>';
    }
    ?>
  </tbody>
</table>