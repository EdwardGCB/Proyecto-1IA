<?php
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
}
?>