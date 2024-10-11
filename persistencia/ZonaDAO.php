<?php
class ZonaDAO{
  private $idZona;
  private $nombre;
  private $color;
  private $asiento;

  public function __construct($idZona=0, $nombre="", $color="", $asiento=""){
    $this -> idZona = $idZona;
    $this -> nombre = $nombre;
    $this -> color = $color;
    $this -> asiento = $asiento;
  }

}
?>