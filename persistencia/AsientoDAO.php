<?php
class AsientoDAO{
  private $fila;
  private $columna;
  private $estado;
  
  public function __construct($fila=0, $columna=0, $estado=""){
    $this -> fila = $fila;
    $this -> columna = $columna;
    $this -> estado = $estado;
  }
}
?>