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

  public function consultarTicket(){
    return "
    SELECT idTicket, valor, Factura_idFactura, Asiento_idAsiento 
    FROM TICKET
    WHERE Cliente_idCliente = '".$this->cliente->getIdPersona()."' and 
    EventoZona_Evento_idEvento = '".$this->eventoZona->getEvento()->getIdEvento()."'
    ";
  }

  public function generarTicket(){
    return "
    INSERT INTO ticket (valor, Factura_idFactura, Asiento_idAsiento, Cliente_idCliente, EventoZona_Evento_idEvento, EventoZona_Zona_idZona)
    VALUES ('".$this->valor."', '".$this->factura->getIdFactura()."', 
    '".$this->asiento->getIdAsiento()."', '".$this->cliente->getIdPersona()."', 
    '".$this->eventoZona->getEvento()->getIdEvento()."', '".$this->eventoZona->getZona()->getIdZona()."')
    ";
  }

  public function consultarTicketPorFactura() {
    return "
    SELECT idTicket, valor, Cliente_idCliente, Factura_idFactura, Asiento_idAsiento, EventoZona_Evento_idEvento
    FROM TICKET
    WHERE Factura_idFactura = '".$this->factura->getIdFactura()."'
    "; 
  }
}
?>