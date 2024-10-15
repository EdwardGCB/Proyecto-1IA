<?php
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

  public function consultarEvento($idEvento) {
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $EventoDAO = new EventoDAO();

    $conexion->ejecutarConsulta($EventoDAO->consultaIndividual($idEvento));

    if ($registro = $conexion->siguienteRegistro()) {
        $evento = new Evento(
            $registro[0],
            $registro[1],
            $registro[2],
            $registro[3],
            $registro[4],
            $registro[5],
            $registro[6],
            $registro[7],
            $registro[8],
            $registro[9]

        );
    } else {
        $evento = null;
    }

    $conexion->cerrarConexion();
    
    return $evento;
}


  }
?>