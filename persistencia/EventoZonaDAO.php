<?php
class EventoZonaDAO{
  private $valor;
  private $aforo;
  private $evento;
  private $zona;

  public function __construct($valor=0, $aforo=0, $evento=null, $zona=null){
    $this -> valor = $valor;
    $this -> aforo = $aforo;
    $this -> evento = $evento;
    $this -> zona = $zona;
  }

  public function consultaIndividual($evento) {
    return "SELECT 
            MIN(ev.valor) AS valor, 
              MIN(ev.aforo) AS aforo,
              e.nombre,
              z.nombre AS zona, 
              COUNT(*) AS disponibles
          FROM 
              eventozona ev 
          INNER JOIN 
              zona z ON ev.Zona_idZona = z.idZona 
          INNER JOIN 
              evento e ON ev.Evento_idEvento = e.idEvento 
              WHERE e.idEvento = $evento
          GROUP BY z.Asiento_fila";
}

}
?>