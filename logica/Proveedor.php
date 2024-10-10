<?php

class Proveedor extends Persona{
  private $eventos;

  public function getEventos(){
    return $this->eventos;
  }

  public function setEventos($eventos){
    $this->eventos = $eventos;
  }

  public function __construct($idPersona=0, $nombre="", $apellido="", $correo="", $telefono=0, $clave="", $cc_nit=0){
    parent::__construct($idPersona, $nombre, $apellido, $correo, $telefono, $clave, $cc_nit);
  }
  public function autenticar(){
    $conexion = new Conexion();
    $conexion -> abrirConexion();
    $proveedorDAO = new ProveedorDAO(null, null, null, $this->correo, null, $this->clave, null);
    $conexion -> ejecutarConsulta($proveedorDAO -> autenticar());
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

  public function consultar(){
    $conexion = new Conexion();
    $conexion -> abrirConexion();
    $proveedorDAO = new ProveedorDAO($this->idPersona);
    $conexion -> ejecutarConsulta($proveedorDAO -> consultarPorId());
    $registro = $conexion -> siguienteRegistro();
    $this -> cc_nit = $registro[0];
    $this -> nombre = $registro[1];
    $this -> apellido = $registro[2];
    $this -> telefono = $registro[3];
  }

}
?>