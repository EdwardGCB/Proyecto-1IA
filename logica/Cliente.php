<?php

class Cliente extends Persona{
  private $facturas;
  private $tickets;

  public function getFacturas(){
    return $this->facturas;
  }

  public function getTickets(){
    return $this->tickets;
  }

  public function setFacturas($facturas){
    $this->facturas = $facturas;
  }

  public function setTickets($tickets){
    $this->tickets = $tickets;
  }

  public function __construct($idPersona=0, $nombre="", $apellido="", $correo="", $telefono=0, $clave="", $cc_nit=0){
    parent::__construct($idPersona, $nombre, $apellido, $correo, $telefono, $clave, $cc_nit);
  }

  public function autenticar(){
    $conexion = new Conexion();
    $conexion -> abrirConexion();
    $clienteDAO = new ClienteDAO(null, null, null, $this->correo, null, $this->clave, null);
    $conexion -> ejecutarConsulta($clienteDAO -> autenticar());
    if($conexion -> numeroFilas() == 0){
      $conexion -> cerrarConexion();
      return false;
    }else{
      $registro = $conexion -> siguienteRegistro();
      $this -> idPersona = $registro[0];
      $conexion -> cerrarConexion();
      return true;
    }
  }

  public function autenticarCorreo(){
    $conexion = new Conexion();
    $conexion -> abrirConexion();
    $clienteDAO = new ClienteDAO(null, null, null, $this->correo);
    $conexion -> ejecutarConsulta($clienteDAO -> autenticarCorreo());
    if($conexion -> numeroFilas() == 0){
      $conexion -> cerrarConexion();
      return true;
    }else{
      $conexion -> cerrarConexion();
      return true;
    }
  }

  public function insertar(){
    $conexion = new Conexion();
    $conexion -> abrirConexion();
    $clienteDAO = new ClienteDAO(0,$this->nombre, $this->apellido, $this->correo, $this->telefono, $this->clave, $this->cc_nit);
    $conexion -> ejecutarConsulta($clienteDAO -> insertar());
    $conexion -> ejecutarConsulta($clienteDAO -> autenticarCorreo());
    $registro = $conexion -> siguienteRegistro();
    $this->idPersona = $registro[0];
    $conexion -> cerrarConexion();
  }

  public function consultar(){
    $conexion = new Conexion();
    $conexion -> abrirConexion();
    $clienteDAO = new ClienteDAO($this->idPersona);
    $conexion -> ejecutarConsulta($clienteDAO -> consultarPorId());
    $registro = $conexion -> siguienteRegistro();
    $this -> cc_nit = $registro[0];
    $this -> nombre = $registro[1];
    $this -> apellido = $registro[2];
    $this -> telefono = $registro[3];
  }

}
?>