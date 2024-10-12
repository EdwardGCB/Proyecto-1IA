<?php
class FacturaDAO{
  private $idFactura;
  private $precioTotal;
  private $cantidadTotal;
  private $iva;
  private $cliente;

  public function __construct($idFactura=0, $precioTotal=0, $cantidadTotal=0, $iva=0, $cliente=null){
    $this -> idFactura = $idFactura;
    $this -> precioTotal = $precioTotal;
    $this -> cantidadTotal = $cantidadTotal;
    $this -> iva = $iva;
    $this -> cliente = $cliente;
  }

}
?>