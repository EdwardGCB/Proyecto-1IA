<?php

require_once "../persistencia/Conexion.php";
require "../persistencia/ZonaDAO.php";
class Zona{
  private $idZona;
  private $nombre;
  private $color;

  public function getIdZona() {
    return $this->idZona;
  }
  
  public function getNombre() {
    return $this->nombre;
  }
  
  public function getColor() {
    return $this->color;
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
  

  public function __construct($idZona=0, $nombre="", $color=""){
    $this -> idZona = $idZona;
    $this -> nombre = $nombre;
    $this -> color = $color;
  }

  public function consultarTodos(){
    $zonas = array();
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $zonaDAO = new ZonaDAO();
    $conexion->ejecutarConsulta($zonaDAO->consultarTodos());
    while($resultado = $conexion->siguienteRegistro()){
      $zona = new Zona($resultado[0], $resultado[1], $resultado[2]);
      array_push($zonas, $zona);
    }
    $conexion->cerrarConexion();
    return $zonas;
  }

  public function consultarPorId(){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $zonaDAO = new ZonaDAO($this->idZona);
    $conexion->ejecutarConsulta($zonaDAO->consultarPorId());
    $resultado = $conexion->siguienteRegistro();
    $this->nombre = $resultado[0];
    $this->color = $resultado[1];
    $conexion->cerrarConexion();
  }

}
?>