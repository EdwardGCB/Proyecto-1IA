<?php
require_once "../persistencia/Conexion.php";
require "../persistencia/EventoZonaDAO.php";
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

  public function consultarPorEvento() {
    $zonas = array();
    $eventosZona = array();
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $EventoZonaDAO = new EventoZonaDAO(null,null,$this->evento);
    $conexion->ejecutarConsulta($EventoZonaDAO->consultarPorEvento());
    while($registro = $conexion->siguienteRegistro()){
      $zona=null;
      if(array_key_exists($registro[2],$zonas)){
        $zona = $zonas[$registro[2]];
      }else{
        $zona = new Zona($registro[2]);
        $zona->consultarPorId();
        $zonas[$registro[2]] = $zona;
      }
      $eventoZona = new EventoZona($registro[0],$registro[1],$this->evento,$zona);
      array_push($eventosZona,$eventoZona);
    }
    $conexion->cerrarConexion();
    return $eventosZona;
  }

  public function insertar(){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $eventoZonaDAO = new EventoZonaDAO($this->valor, $this->aforo, $this->evento, $this->zona);
    $conexion->ejecutarConsulta($eventoZonaDAO->insertar());
    $conexion->cerrarConexion();
  }
}
?>