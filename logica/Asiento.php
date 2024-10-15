<?php
require_once("../persistencia/Conexion.php");
class Asiento{
  private $fila;
  private $columna;
  private $estado;

  public function getFila() {
    return $this->fila;
  }
  
  public function getColumna() {
    return $this->columna;
  }
  
  public function getEstado() {
    return $this->estado;
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
  
  public function __construct($fila=0, $columna=0, $estado=""){
    $this -> fila = $fila;
    $this -> columna = $columna;
    $this -> estado = $estado;
  }

  public function crearAsientos(){
    $insertQuery = "INSERT INTO asiento (fila, columna, estado, Zona_idZona) VALUES ";
    $rows = range('A', 'Z');
    $columns = range(1, 10);
    $values = [];

    for ($id = 1; $id < 18; $id++) {
        foreach ($rows as $row) {
            foreach ($columns as $col) {
                $values[] = "('$row', $col, 0, $id)";
            }
        }
    }
    $insertQuery .= implode(", ", $values) . ";";
    $conexion = new Conexion();
    $conexion -> abrirConexion();
    $conexion -> ejecutarConsulta($insertQuery);
    $conexion -> cerrarConexion();
  }
}
?>