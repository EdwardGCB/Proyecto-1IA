<?php
require_once(__DIR__.'/../persistencia/Conexion.php');
require (__DIR__.'/../persistencia/FacturaDAO.php');
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

  public function generarFactura(){
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $facturaDAO = new FacturaDAO(null, $this->precioTotal, $this->cantidadTotal, $this->iva, $this->cliente);
    $conexion->ejecutarConsulta($facturaDAO->generarFactura());
    $this->idFactura = $conexion->obtenerLlaveAutonumerica();
    $conexion->cerrarConexion();
  }
  
}

?>