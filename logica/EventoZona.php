<?php
class EventoZona{
  private $valor;
  private $aforo;
  private $evento;
  private $zona;

  public function getValor() {
    return $this->valor;
  }
  
  public function getAforo() {
    return $this->aforo;
  }
  
  public function getEvento() {
    return $this->evento;
  }
  
  public function getZona() {
    return $this->zona;
  }
  
  public function setValor($valor) {
    $this->valor = $valor;
  }
  
  public function setAforo($aforo) {
    $this->aforo = $aforo;
  }
  
  public function setEvento($evento) {
    $this->evento = $evento;
  }
  
  public function setZona($zona) {
    $this->zona = $zona;
  }

  public function __construct($valor=0, $aforo=0, $evento=null, $zona=null){
    $this -> valor = $valor;
    $this -> aforo = $aforo;
    $this -> evento = $evento;
    $this -> zona = $zona;
  }
}
?>