<?php
require_once ("../persistencia/Conexion.php");
require ("../persistencia/CiudadDAO.php");

class Ciudad{ 
  private $idCiudad; 
  private $nombre;
  
  public function getIdCiudad() {
    return $this->idCiudad;
  }
  
  public function getNombre() {
    return $this->nombre;
  }
  
  public function setIdCiudad($idCiudad) {
    $this->idCiudad = $idCiudad;
  }
  
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  public function __construct($idCiudad=0, $nombre=""){
    $this->idCiudad = $idCiudad;
    $this->nombre = $nombre;
  }

  public function consultarTodos(){
    $ciudades = array();
    $conexion = new Conexion();
    $conexion -> abrirConexion();
    $ciudadDAO = new CiudadDAO();
    $conexion -> ejecutarConsulta($ciudadDAO -> consultarTodos());
    while($registro = $conexion -> siguienteRegistro()){
        $ciudad = new Ciudad($registro[0], $registro[1]);
        array_push($ciudades, $ciudad);
    }
    $conexion -> cerrarConexion();
    return $ciudades;
  }

  public function consultaIndividual(){
    $conexion = new Conexion();
    $conexion -> abrirConexion();
    $ciudadDAO = new CiudadDAO($this -> idCiudad);
    $conexion -> ejecutarConsulta($ciudadDAO -> consultaIndividual());
    $registro = $conexion -> siguienteRegistro();
    $this -> nombre = $registro[0];
    $conexion -> cerrarConexion();
  }
}
?>