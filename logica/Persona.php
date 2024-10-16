<?php
require_once(__DIR__. '/../persistencia/Conexion.php');
require(__DIR__. '/../persistencia/ClienteDAO.php');
require(__DIR__. '/../persistencia/ProveedorDAO.php');


class Persona{
  protected $idPersona;
  protected $nombre;
  protected $apellido;
  protected $correo;
  protected $telefono;
  protected $clave;
  protected $cc_nit;

  public function getIdPersona(){
    return $this->idPersona;
  }
  
  public function getNombre(){
    return $this->nombre;
  }
  
  public function getApellido(){
    return $this->apellido;
  }
  
  public function getCorreo(){
    return $this->correo;
  }
  
  public function getTelefono(){
    return $this->telefono;
  }
  
  public function getClave(){
    return $this->clave;
  }
  
  public function getCc_nit(){
    return $this->cc_nit;
  }
  
  public function setIdPersona($idPersona){
    $this->idPersona = $idPersona;
  }
  
  public function setNombre($nombre){
    $this->nombre = $nombre;
  }
  
  public function setApellido($apellido){
    $this->apellido = $apellido;
  }
  
  public function setCorreo($correo){
    $this->correo = $correo;
  }
  
  public function setTelefono($telefono){
    $this->telefono = $telefono;
  }
  
  public function setClave($clave){
    $this->clave = $clave;
  }
  
  public function setCc_nit($cc_nit){
    $this->cc_nit = $cc_nit;
  }
  
  public function __construct($idPersona, $nombre, $apellido, $correo, $telefono, $clave, $cc_nit){
    $this -> idPersona = $idPersona;
    $this -> nombre = $nombre;
    $this -> apellido = $apellido;
    $this -> correo = $correo;
    $this -> telefono = $telefono;
    $this -> clave = $clave;
    $this -> cc_nit = $cc_nit;
  }
}
?>