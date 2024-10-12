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
}
?>