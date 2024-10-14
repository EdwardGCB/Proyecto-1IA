<?php
class CiudadDAO{
  private $idCiudad; 
  private $nombre;
  
  public function __construct($idCiudad=0, $nombre=""){
    $this->idCiudad = $idCiudad;
    $this->nombre = $nombre;
  }

  public function consultarTodos(){
    return "select idCiudad, nombre
            from Ciudad
            order by nombre asc";
  }

  public function consultaPorId(){
    return "select nombre 
            from Ciudad
            where idciudad = '" . $this -> idCiudad . "'";
  }
}
?>