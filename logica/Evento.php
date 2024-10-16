<?php
require_once(__DIR__.'/../persistencia/Conexion.php');
require(__DIR__.'/../persistencia/EventoDAO.php');
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

  public function consultaGeneral($value=null, $inicio=null, $datos=null) {
    $eventos = array();
    $ciudades = array();
    $categorias = array();
    $proveedores = array();
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $eventoDAO = new EventoDAO();
    $conexion->ejecutarConsulta($eventoDAO->consultaGeneral($value, $inicio, $datos));
    while ($registro = $conexion->siguienteRegistro()) {
      $categoria=null;
      $ciudad=null;
      $proveedor=null;
      if(array_key_exists($registro[8],$proveedores)){
        $proveedor = $proveedores[$registro[8]];
      }else{
        $proveedor = new Proveedor($registro[8]);
        $proveedor -> consultarPorId();
        $proveedores[$registro[8]] = $proveedor;
      }
      if(array_key_exists($registro[9],$ciudades)){
        $ciudad = $ciudades[$registro[9]];
      }else{
        $ciudad = new Ciudad($registro[9]);
        $ciudad -> consultarPorId();
        $ciudades[$registro[9]] = $ciudad;
      }
      if(array_key_exists($registro[10],$categorias)){
        $categoria = $categorias[$registro[10]];
      }else{
        $categoria = new Categoria($registro[10]);
        $categoria -> consultarPorId();
        $categorias[$registro[10]] = $categoria;
      }
      
      $evento = new Evento($registro[0], $registro[1], $registro[2], $registro[3], $registro[4], $registro[5],$registro[6], $registro[7], $proveedor, $ciudad, $categoria);
        array_push($eventos, $evento);
    }
    $conexion->cerrarConexion();
    return $eventos;
  }

  public function consultarPorProveedor($value = null, $inicio=null, $datos=null) {
    $eventos = array();
    $ciudades = array();
    $categorias = array();
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $eventoDAO = new EventoDAO(null, null, null, null, null, null, null, null, $this->proveedor);
    $consulta = ($value == null) ? $eventoDAO->consultarPorProveedor($inicio, $datos) : $eventoDAO->consultarPorBusqueda($value, $inicio, $datos);
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
      /*seteo los datos del evento */
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

  public function consultarPorCategoria(){
    $eventos = array();
    $ciudades = array();
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $this->categoria->consultarPorId();
    $eventoDAO = new EventoDAO(null, null, null, null, null, null, null, null, null,null,$this->categoria);
    $conexion -> ejecutarConsulta($eventoDAO->consultarPorCategoria());
    while ($registro = $conexion->siguienteRegistro()) {
      $ciudad=null;
      if(array_key_exists($registro[9],$ciudades)){
        $ciudad = $ciudades[$registro[9]];
      } else{
        $ciudad = new Ciudad($registro[9]);
        $ciudad -> consultarPorId();
        $ciudades[$registro[9]] = $ciudad;
      }
      $proveedor = new Proveedor($registro[8]);
      $proveedor -> consultarPorId();
      $evento = new Evento($registro[0],$registro[1],$registro[2],$registro[3],$registro[4],$registro[5],$registro[6],$registro[7],$proveedor, $ciudad, $this->categoria);
      array_push($eventos, $evento);
    }
    $conexion->cerrarConexion();
    return $eventos;
  }

  public function consultarPorCiudad(){
    $eventos = array();
    $categorias = array();
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $this->ciudad->consultarPorId();
    $eventoDAO = new EventoDAO(null, null, null, null, null, null, null, null, null,$this->ciudad);
    $conexion -> ejecutarConsulta($eventoDAO->consultarPorCiudad());
    while ($registro = $conexion->siguienteRegistro()) {
      $categoria=null;
      if(array_key_exists($registro[9],$categorias)){
        $categoria = $categorias[$registro[9]];
      } else{
        $categoria = new Categoria($registro[9]);
        $categoria -> consultarPorId();
        $categorias[$registro[9]] = $categoria;
      }
      $proveedor = new Proveedor($registro[8]);
      $proveedor -> consultarPorId();
      $evento = new Evento($registro[0],$registro[1],$registro[2],$registro[3],$registro[4],$registro[5],$registro[6],$registro[7],$proveedor, $this->ciudad, $categoria,);
      array_push($eventos, $evento);
    }
    $conexion->cerrarConexion();
    return $eventos;
  }
}
?>