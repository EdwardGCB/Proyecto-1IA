<?php

class ProveedorDAO {
  private $idPersona;
  private $nombre;
  private $apellido;
  private $correo;
  private $telefono;
  private $clave;
  private $cc_nit;

  public function __construct($idPersona=0, $nombre="", $apellido="", $correo="", $telefono=0, $clave="", $cc_nit=0) {
    $this->idPersona = $idPersona;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->correo = $correo;
    $this->telefono = $telefono;
    $this->clave = $clave;
    $this->cc_nit = $cc_nit;
  }

  public function autenticar(){
    return "select idProveedor
            from Proveedor 
            where correo = '" . $this -> correo . "' and password = '" . $this -> clave . "'";
  }

  public function consultarPorId(){
    return "select nit, nombre, apellido, telefono
            from Proveedor
            where idProveedor = '". $this -> idPersona ."'";
  }

}

?>