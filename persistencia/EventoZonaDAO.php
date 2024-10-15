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
    ";
  }

  public function insertar(){
    return "INSERT INTO EventoZona (valor, afoto, Evento_idEvento, Zona_idZona)
    VALUES ('".$this->valor."', '".$this->aforo."', '".$this->evento->getIdEvento()."', '".$this->zona->getIdZona()."')";
  }
}
?>