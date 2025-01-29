<?php
if($evento){
  foreach ($eventosZona as $eventoZonaActual) {
    $porcentajeVenta= (100*$cantidadReservas[$eventoZonaActual->getZona()->getNombre()])/$eventoZonaActual->getAforo();
  
    echo "
    <div class='container mt-3'>
      <h5>Zona: ".$eventoZonaActual->getZona()->getNombre()."</h5>
      <div class='progress'>
        <div class='progress-bar progress-bar-striped bg-success' role='progressbar' style='width: ".$porcentajeVenta."%;' id='progress-bar'>".$porcentajeVenta."%</div>
      </div>
    </div>
    ";
  }
}

?>