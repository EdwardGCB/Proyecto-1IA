<?php
class EventoDAO{
  private $idEvento;
  private $sitio;
  private $flayer;
  private $logo;
  private $edadMinima;
  private $nombre;
  private $fechaEvento;
  private $horaEvento;
  private $proveedor;
  private $ciudad;
  private $categoria;
  
  public function __construct($idEvento=0, $sitio="", $flayer="", $logo="", $edadMinima=0, $nombre="", $fechaEvento="", $horaEvento="", $proveedor=null, $ciudad=null, $categoria=null){
    $this->idEvento = $idEvento;
    $this->sitio = $sitio;
    $this->flayer = $flayer;
    $this->logo = $logo;
    $this->edadMinima = $edadMinima;
    $this->nombre = $nombre;
    $this->fechaEvento = $fechaEvento;
    $this->horaEvento = $horaEvento;
    $this->proveedor = $proveedor;
    $this->ciudad = $ciudad;
    $this->categoria = $categoria;
  }

  public function consultarPorProveedor(){
    return "
    select idEvento, nombre, fechaEvento, horaEvento, ciudad_idCiudad, Categoria_idCategoria
    from Evento
    where Proveedor_idProveedor = '" .$this->proveedor->getIdPersona(). "'";
  }

  public function consultarPorBusqueda($value){
    return "
    select idEvento, nombre, fechaEvento, horaEvento, ciudad_idCiudad, Categoria_idCategoria
    from Evento
    where Proveedor_idProveedor = '" .$this->proveedor->getIdPersona(). "' and nombre= '". $value ."'";
  }

  public function agregar(){
    return "
    insert into Evento
    values ('". $this->idEvento ."', '". $this->sitio. "', '".$this->flayer."', '". $this->logo."', '". $this->edadMinima."', '".$this->nombre."', '". $this->fechaEvento."', '". $this->horaEvento."', '".$this->proveedor->getIdPersona()."', '". $this->ciudad->getIdCiudad()."', '".$this->categoria->getIdCategoria()."')";
  }

  public function consultaIndividual(){
    return "
    select idEvento, sitio, flayer, logo, edadMinima, nombre, fechaEvento, horaEvento, ciudad_idciudad, Categoria_idCategoria
    from Evento
    where idEvento = '". $this->idEvento."'";
  }

  public function consultaPorId(){
    return "
    select sitio, flayer, logo, edadMinima, nombre, fechaEvento, horaEvento, ciudad_idciudad, Categoria_idCategoria
    from Evento
    where idEvento = '". $this->idEvento."' and Proveedor_idProveedor = '". $this->proveedor->getIdPersona()."'";
  }

  public function numeroEventosProveedor(){
    return "select idEvento
    from Evento
    where Proveedor_idProveedor = '".$this->proveedor->getIdPersona()."'";
  }

  public function actualizar(){
    return "
      update Evento
      set sitio = '". $this->sitio. "', flayer = '". $this->flayer. "', logo = '". $this->logo. "', edadMinima = '". $this->edadMinima. "', nombre = '". $this->nombre. "', fechaEvento = '". $this->fechaEvento. "', horaEvento = '". $this->horaEvento. "', ciudad_idCiudad = '". $this->ciudad->getIdCiudad(). "', Categoria_idCategoria = '". $this->categoria->getIdCategoria(). "'
      where idEvento = '". $this->idEvento. "' and Proveedor_idProveedor = '". $this->proveedor->getIdPersona(). "'";
  }

}
?>