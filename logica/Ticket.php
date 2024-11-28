<?php
require_once(__DIR__.'/../persistencia/Conexion.php');
require (__DIR__.'/../persistencia/TicketDAO.php');
class Ticket{
  private $idTicket;
  private $valor;
  private $asiento;
  private $cliente;
  private $factura;
  private $eventoZona;
  public function getIdTicket() {
    return $this->idTicket;
  }
  
  public function getValor() {
    return $this->valor;
  }
  
  public function getAsiento() {
    return $this->asiento;
  }
  
  public function getCliente() {
    return $this->cliente;
  }
  
  public function getFactura() {
    return $this->factura;
  }
  
  public function getEventoZona() {
    return $this->eventoZona;
  }
  public function setIdTicket($idTicket) {
    $this->idTicket = $idTicket;
  }
  
  public function setValor($valor) {
    $this->valor = $valor;
  }
  
  public function setAsiento($asiento) {
    $this->asiento = $asiento;
  }
  
  public function setCliente($cliente) {
    $this->cliente = $cliente;
  }
  
  public function setFactura($factura) {
    $this->factura = $factura;
  }
  
  public function setEventoZona($eventoZona) {
    $this->eventoZona = $eventoZona;
  }

  public function __construct($idTicket=0, $valor=0, $asiento=null, $cliente=null, $factura=null, $eventoZona=null){
    $this -> idTicket = $idTicket;
    $this -> valor = $valor;
    $this -> asiento = $asiento;
    $this -> cliente = $cliente;
    $this -> factura = $factura;
    $this -> eventoZona = $eventoZona;
  }

  public function consultarTicket() {
    $conexion = new Conexion();
    $conexion->abrirConexion();   
    $ticketDAO = new TicketDAO(null, null, null, $this->cliente, $this->factura, null);
    $conexion->ejecutarConsulta($ticketDAO->consultarTicket());

    if ($conexion->numeroFilas() != 0) {
        $result = $conexion->siguienteRegistro();
        $this->idTicket = $result[0];
        $this->valor = $result[1];
        $this->factura = $result[2];
        $this->asiento = $result[3];
        $evento = new Evento($result[4]);
        $evento -> consultaIndividual();
        $this->eventoZona = $evento;
        $conexion->cerrarConexion();
        return true;
    } else {
        $conexion->cerrarConexion();
        return false;
    }
}

public function consultarTicketsPorFactura() {
  $tickets = array();

  $conexion = new Conexion();
  $conexion->abrirConexion();   
  $ticketDAO = new TicketDAO(null, null, null, $this->cliente, $this->factura, null);
  $conexion->ejecutarConsulta($ticketDAO->consultarTicketPorFactura());
  while ($result = $conexion->siguienteRegistro()) {
      $asiento = new Asiento($result[3]); 
      $asiento->consultarPorId(); 
      $evento = new Evento($result[4]);
      $evento->consultaIndividual(); 
      $ticket = new Ticket($result[0], $result[1], $asiento, $this->cliente, $this->factura,$evento);
      array_push($tickets, $ticket);
  }
  $conexion->cerrarConexion();

  return $tickets;
}



  public function generarTicket(){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $ticketDAO = new TicketDAO(null, $this->valor, $this->asiento, $this->cliente, $this->factura, $this->eventoZona);
    $conexion->ejecutarConsulta($ticketDAO->generarTicket());
    $conexion->cerrarConexion();
  }
}
?>