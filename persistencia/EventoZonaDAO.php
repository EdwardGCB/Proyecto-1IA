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

  public function consultarPorEvento(){
    return "
    SELECT valor, afoto, Zona_idZona
    FROM EventoZona
    WHERE Evento_idEvento = '".$this->evento->getIdEvento()."'
    ORDER BY Evento_idEvento ASC
    ";
  }

  

  public function insertar(){
    return "INSERT INTO EventoZona (valor, afoto, Evento_idEvento, Zona_idZona)
    VALUES ('".$this->valor."', '".$this->aforo."', '".$this->evento->getIdEvento()."', '".$this->zona->getIdZona()."')";
  }

  public function cantidadReservas(){
    return "
      SELECT COUNT(t.idTicket) AS cantidad, z.nombre
      FROM zona AS z
      JOIN eventozona AS ez ON z.idZona = ez.Zona_idZona
      LEFT JOIN ticket AS t ON ez.Zona_idZona = t.EventoZona_Zona_idZona
      LEFT JOIN asiento AS a ON a.idAsiento = t.Asiento_idAsiento
      LEFT JOIN evento AS e ON t.EventoZona_Evento_idEvento = e.idEvento
      AND e.Proveedor_idProveedor = '".$this->evento->getProveedor()->getIdPersona()."' AND t.EventoZona_Evento_idEvento = '".$this->evento->getIdEvento()."'
      GROUP BY z.nombre
    ";
  }

  public function consultarExistencia(){
    return "
      SELECT Zona_idZona
      FROM EventoZona
      WHERE Zona_idZona = '". $this->zona->getIdZona()."' AND Evento_idEvento = '". $this->evento->getIdEvento()."'
    ";
  }
}
?>