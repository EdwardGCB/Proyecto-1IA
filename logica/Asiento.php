<?php
require_once "../persistencia/Conexion.php" ;
require "../persistencia/AsientoDAO.php" ;
class Asiento{
  private $idAsiento;
  private $fila;
  private $columna;
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
  
  public function setZona($zona) {
    $this->zona = $zona;
  }
  
  public function __construct($idAsiento=0,$fila="", $columna=0, $zona=null){
    $this -> idAsiento = $idAsiento;
    $this -> fila = $fila;
    $this -> columna = $columna;
    $this -> zona = $zona;
  }

  public function consultarFilasZona(){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $asientoDAO = new AsientoDAO(null,null,null,$this->zona);
    $conexion->ejecutarConsulta($asientoDAO -> consultarFilasZona());
    $filas = $conexion->numeroFilas();
    $conexion->cerrarConexion();
    return $filas;
  }

  public function consultarColumnasZona(){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $asientoDAO = new AsientoDAO(null,null,null,$this->zona);
    $conexion->ejecutarConsulta($asientoDAO -> consultarColumnasZona());
    $columnas = $conexion->numeroFilas();
    $conexion->cerrarConexion();
    return $columnas;
  }

  public function asientosDisponibles($evento){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $asientoDAO = new AsientoDAO(null,null,null,$this->zona);
    $conexion->ejecutarConsulta($asientoDAO -> asientosDisponibles($evento));
    $resultado = $conexion->siguienteRegistro();
    $disponibles = $resultado[0];
    $conexion->cerrarConexion();
    return $disponibles;
  }

  public function consultarAsiento($limite, $idEvento){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $asientoDAO = new AsientoDAO(null,null,null,$this->zona);
    $conexion->ejecutarConsulta($asientoDAO -> consultarAsiento($limite, $idEvento));
    $resultado = $conexion->siguienteRegistro();
    $this->idAsiento = $resultado[0];
    $this->fila = $resultado[1];
    $this->columna = $resultado[2];
    $conexion->cerrarConexion();
  }

  public function consultarPorId() {
    $conexion = new Conexion();
    $conexion->abrirConexion();
    
    // Crear el DAO con el idAsiento actual
    $asientoDAO = new AsientoDAO($this->idAsiento);
    
    // Ejecutar la consulta para obtener los datos del asiento
    $conexion->ejecutarConsulta($asientoDAO->consultarPorId());
    $resultado = $conexion->siguienteRegistro();

    // Validar si se obtuvo un resultado
    if ($resultado) {
        $this->fila = $resultado[1];    // Fila
        $this->columna = $resultado[0]; // Columna
    }

    $conexion->cerrarConexion();
}


  public function existenciaEnZona(){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $asientoDAO = new AsientoDAO($this->idAsiento,null,null,$this->zona);
    $conexion->ejecutarConsulta($asientoDAO -> existenciaEnZona());
    if($conexion->numeroFilas()==0){
      return false;
      $conexion->cerrarConexion();
    }else{
      return true;
      $conexion->cerrarConexion();
    }
  }

  public function generarAsientos(){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    for ($char = 'A'; $char < 'Z'; $char++) {
      for ($j = 1; $j < 11; $j++) {
          $asientoDAO = new AsientoDAO(null, $char, $j, $this->zona);
          $conexion->ejecutarConsulta($asientoDAO->generarAsiento());
      }
    }
    $conexion->cerrarConexion();
  }
}
?>