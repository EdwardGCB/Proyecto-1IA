<?php
class Factura{
  private $idFactura;
  private $precioTotal;
  private $cantidadTotal;
  private $iva;
  private $cliente;
  
  public function getIdFactura() {
    return $this->idFactura;
  }
  
  public function getPrecioTotal() {
    return $this->precioTotal;
  }
  
  public function getCantidadTotal() {
    return $this->cantidadTotal;
  }
  
  public function getIva() {
    return $this->iva;
  }
  
  public function getCliente() {
    return $this->cliente;
  }
  
  public function setIdFactura($idFactura) {
    $this->idFactura = $idFactura;
  }
  
  public function setPrecioTotal($precioTotal) {
    $this->precioTotal = $precioTotal;
  }
  
  public function setCantidadTotal($cantidadTotal) {
    $this->cantidadTotal = $cantidadTotal;
  }
  
  public function setIva($iva) {
    $this->iva = $iva;
  }
  
  public function setCliente($cliente) {
    $this->cliente = $cliente;
  }

  public function __construct($idFactura=0, $precioTotal=0, $cantidadTotal=0, $iva=0, $cliente=null){
    $this -> idFactura = $idFactura;
    $this -> precioTotal = $precioTotal;
    $this -> cantidadTotal = $cantidadTotal;
    $this -> iva = $iva;
    $this -> cliente = $cliente;
  }

}

?>