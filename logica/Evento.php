<?php
require_once ("../persistencia/Conexion.php");
require ("../persistencia/EventoDAO.php");

class Evento{
  private $idEvento;
  private $sitio;
  private $flayer;
  private $logo;
  private $edadMinima;
  private $nombre;
  private $fechaEvento;
  private $horaEvento;
  private $proveedor;
  private $ciudad;
  private $categoria;

  public function getIdEvento() {
    return $this->idEvento;
  }
  
  public function getSitio() {
    return $this->sitio;
  }
  
  public function getFlayer() {
    return $this->flayer;
  }
  
  public function getLogo() {
    return $this->logo;
  }
  
  public function getEdadMinima() {
    return $this->edadMinima;
  }
  
  public function getNombre() {
    return $this->nombre;
  }
  
  public function getFechaEvento() {
    return $this->fechaEvento;
  }
  
  public function getHoraEvento() {
    return $this->horaEvento;
  }
  
  public function getProveedor() {
    return $this->proveedor;
  }
  
  public function getCiudad() {
    return $this->ciudad;
  }
  
  public function getCategoria() {
    return $this->categoria;
  }
  
  public function setIdEvento($idEvento) {
    $this->idEvento = $idEvento;
  }
  
  public function setSitio($sitio) {
    $this->sitio = $sitio;
  }
  
  public function setFlayer($flayer) {
    $this->flayer = $flayer;
  }
  
  public function setLogo($logo) {
    $this->logo = $logo;
  }
  
  public function setEdadMinima($edadMinima) {
    $this->edadMinima = $edadMinima;
  }
  
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }
  
  public function setFechaEvento($fechaEvento) {
    $this->fechaEvento = $fechaEvento;
  }
  
  public function setHoraEvento($horaEvento) {
    $this->horaEvento = $horaEvento;
  }
  
  public function setProveedor($proveedor) {
    $this->proveedor = $proveedor;
  }

  public function setCiudad($ciudad) {
    $this->ciudad = $ciudad;
  }
  
  public function setCategoria($categoria) {
    $this->categoria = $categoria;
  }
  
  public function __construct($idEvento=0, $sitio="", $flayer="", $logo="", $edadMinima=0, $nombre="", $fechaEvento="", $horaEvento="", $proveedor=null, $ciudad=null, $categoria=null){
    $this->idEvento = $idEvento;
    $this->sitio = $sitio;
    $this->flayer = $flayer;
    $this->logo = $logo;
    $this->edadMinima = $edadMinima;
    $this->nombre = $nombre;
    $this->fechaEvento = $fechaEvento;
    $this->horaEvento = $horaEvento;
    $this->proveedor = $proveedor;
    $this->ciudad = $ciudad;
    $this->categoria = $categoria;
  }

  public function consultarPorProveedor($value = null) {
    $eventos = array();
    $ciudades = array();
    $categorias = array();
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $eventoDAO = new EventoDAO(null, null, null, null, null, null, null, null, $this->proveedor);
    $consulta = ($value == null) ? $eventoDAO->consultarPorProveedor() : $eventoDAO->consultarPorBusqueda($value);
    $conexion->ejecutarConsulta($consulta);
    while ($registro = $conexion->siguienteRegistro()) {
      $categoria=null;
      $ciudad=null;
      if(array_key_exists($registro[4],$ciudades)){
        $ciudad = $ciudades[$registro[4]];
      }else{
        $ciudad = new Ciudad($registro[4]);
        $ciudad -> consultarPorId();
        $ciudades[$registro[4]] = $ciudad;
      }
      if(array_key_exists($registro[5],$categorias)){
        $categoria = $categorias[$registro[5]];
      }else{
        $categoria = new Categoria($registro[5]);
        $categoria -> consultarPorId();
        $categorias[$registro[5]] = $categoria;
      }
        $evento = new Evento($registro[0], null, null, null, null, $registro[1], $registro[2], $registro[3], $this->proveedor, $ciudad, $categoria);
        array_push($eventos, $evento);
    }
    
    $conexion->cerrarConexion();
    return $eventos;
}

  public function agregar() {
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $this->idEvento = rand(1, 1000000);
    if($this->consultaIndividual()==false){
      $eventoDAO = new EventoDAO($this->idEvento, $this->sitio, $this->flayer, $this->logo, $this->edadMinima, $this->nombre, $this->fechaEvento, $this->horaEvento, $this->proveedor, $this->ciudad, $this->categoria);
      $conexion->ejecutarConsulta($eventoDAO->agregar());
      $conexion->cerrarConexion();
      return true;
    }else{
      $conexion->cerrarConexion();
      $this->agregar();
    }
  }

  public function consultaIndividual() {
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $eventoDAO = new EventoDAO($this->idEvento);
    $conexion -> ejecutarConsulta($eventoDAO->consultaIndividual());
    if($conexion -> numeroFilas() == 0){
      $conexion -> cerrarConexion();
      return false;
    }else{
      $conexion -> cerrarConexion();
      return true;
    }
  }

  public function consultaPorID(){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $eventoDAO = new EventoDAO($this->idEvento, null,null,null,null,null,null,null,$this->proveedor);
    $conexion -> ejecutarConsulta($eventoDAO->consultaPorID());
    if($conexion -> numeroFilas() == 0){
      $conexion -> cerrarConexion();
      return false;
    }else{
      $registro = $conexion -> siguienteRegistro();
      $this->sitio = $registro[0];
      $this->flayer = $registro[1];
      $this->logo = $registro[2];
      $this->edadMinima = $registro[3];
      $this->nombre = $registro[4];
      $this->fechaEvento = $registro[5];
      $this->horaEvento = $registro[6];
      $ciudad=new Ciudad($registro[7]);
      $ciudad->consultarPorId();
      $this->ciudad = $ciudad;
      $categoria = new Categoria($registro[8]);
      $categoria->consultarPorId();
      $this->categoria = $categoria;
      $conexion -> cerrarConexion();
      return true;
    }
  }

  public function numeroEventosProveedor(){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $eventoDAO = new EventoDAO(null, null, null, null, null, null, null, null, $this->proveedor);
    $conexion -> ejecutarConsulta($eventoDAO->numeroEventosProveedor());
    $numero = $conexion -> numeroFilas();
    $conexion -> cerrarConexion();
    return $numero;
  }

  public function actualizar(){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $eventoDAO = new EventoDAO($this->idEvento, $this->sitio, $this->flayer, $this->logo, $this->edadMinima, $this->nombre, $this->fechaEvento, $this->horaEvento, $this->proveedor, $this->ciudad, $this->categoria);
    $conexion->ejecutarConsulta($eventoDAO->actualizar());
    $conexion->cerrarConexion();
    return true;
  }

  public function eventoCercano($date){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $eventoDAO = new EventoDAO(null, null, null, null, null, null, null, null, $this->proveedor);
    $conexion -> ejecutarConsulta($eventoDAO->eventoCercano($date));
    $resultado = $conexion -> siguienteRegistro();
    $ciudad = new Ciudad($resultado[6]);
    $ciudad->consultarPorId();
    $categoria = new Categoria($resultado[7]);
    $categoria->consultarPorId();
    $evento = new Evento($resultado[0],$resultado[1],null,null,$resultado[2],$resultado[3],$resultado[4],$resultado[5],$this->proveedor,$ciudad, $categoria);
    $conexion -> cerrarConexion();
    return $evento;
  }
}
?>