<?php
class Zona{
  private $idZona;
  private $nombre;
  private $color;
  private $asiento;

  public function getIdZona() {
    return $this->idZona;
  }
  
  public function getNombre() {
    return $this->nombre;
  }
  
  public function getColor() {
    return $this->color;
  }
  
  public function getAsiento() {
    return $this->asiento;
  }
  
  public function setIdZona($idZona) {
    $this->idZona = $idZona;
  }
  
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }
  
  public function setColor($color) {
    $this->color = $color;
  }
  
  public function setAsiento($asiento) {
    $this->asiento = $asiento;
  }

  public function __construct($idZona=0, $nombre="", $color="", $asiento=""){
    $this -> idZona = $idZona;
    $this -> nombre = $nombre;
    $this -> color = $color;
    $this -> asiento = $asiento;
  }

}
?>