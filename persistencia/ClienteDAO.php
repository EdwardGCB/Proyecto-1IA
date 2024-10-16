<?php
class ClienteDAO{
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
    return "select idCliente
            from Cliente
            where email = '" . $this -> correo . "' and password = '" . $this -> clave . "'";
  }

  public function autenticarCorreo(){
    return "select idCliente, nombre, apellidos, telefono, cc
            from Cliente
            where email = '" . $this -> correo . "'";
  }

  public function consultarPorId(){
    return "select cc, nombre, apellidos, telefono, email
            from Cliente
            where idCliente = '". $this -> idPersona ."'";
  }

  public function insertar(){
    return "insert into Cliente (nombre, apellidos, telefono, email, password, cc)
            values ('". $this -> nombre. "', '". $this -> apellido. "', '". $this -> telefono. "', '". $this -> correo. "', '". $this -> clave. "', '". $this -> cc_nit. "')";
  }
}
?>