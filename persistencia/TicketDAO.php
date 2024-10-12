<?php
class TicketDAO{
  private $idTicket;
  private $valor;
  private $asiento;
  private $cliente;
  private $factura;
  private $eventoZona;
  
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