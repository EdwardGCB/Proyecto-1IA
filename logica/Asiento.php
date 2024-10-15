<?php
require_once "../persistencia/Conexion.php" ;
require "../persistencia/AsientoDAO.php" ;
class Asiento{
  private $idAsiento;
  private $fila;
  private $columna;
  private $estado;
  private $zona;

  public function getIdAsiento() {
    return $this->idAsiento;
  }

  public function getFila() {
    return $this->fila;
  }
  
  public function getColumna() {
    return $this->columna;
  }
  
  public function getEstado() {
    return $this->estado;
  }
  
  public function getZona() {
    return $this->zona;
  }
  
  public function setIdAsiento($idAsiento) {
    $this->idAsiento = $idAsiento;
  }
  
  public function setFila($fila) {
    $this->fila = $fila;
  }
  
  public function setColumna($columna) {
    $this->columna = $columna;
  }
  
  public function setEstado($estado) {
    $this->estado = $estado;
  }
  
  public function setZona($zona) {
    $this->zona = $zona;
  }
  
  public function __construct($idAsiento=0,$fila="", $columna=0, $estado="", $zona=null){
    $this -> idAsiento = $idAsiento;
    $this -> fila = $fila;
    $this -> columna = $columna;
    $this -> estado = $estado;
    $this -> zona = $zona;
  }

  public function consultarFilasZona(){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $asientoDAO = new AsientoDAO(null,null,null,null,$this->zona);
    $conexion->ejecutarConsulta($asientoDAO -> consultarFilasZona());
    $filas = $conexion->numeroFilas();
    $conexion->cerrarConexion();
    return $filas;
  }

  public function consultarColumnasZona(){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $asientoDAO = new AsientoDAO(null,null,null,null,$this->zona);
    $conexion->ejecutarConsulta($asientoDAO -> consultarColumnasZona());
    $columnas = $conexion->numeroFilas();
    $conexion->cerrarConexion();
    return $columnas;
  }
}
?>