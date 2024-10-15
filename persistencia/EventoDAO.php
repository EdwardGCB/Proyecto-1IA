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
    select idEvento, imagenSitio, flayer, logoEvento, edadMinima, nombre, fechaEvento, horaEvento, ciudad_idciudad, Categoria_idCategoria
    from Evento
    where idEvento = '". $this->idEvento."'";
  }

  public function consultaPorId(){
    return "
    select imagenSitio, flayer, logoEvento, edadMinima, nombre, fechaEvento, horaEvento, ciudad_idciudad, Categoria_idCategoria
    from Evento
    where idEvento = '". $this->idEvento."' and Proveedor_idProveedor = '". $this->proveedor->getIdPersona()."'";
  }

  public function numeroEventosProveedor(){
    return "select idEvento
    from Evento
    where Proveedor_idProveedor = '".$this->proveedor->getIdPersona()."'";
  }

//   public function consultaIndividual($idEvento) {
//     return "SELECT
//                 e.idEvento, e.sitio, e.flayer, e.logo, e.edadMinima, e.nombre AS artista, e.fechaEvento, e.horaEvento,
//                 p.usuario AS proveedor,
//                 c.nombre AS ciudad,
//                 ca.nombre AS categoria
//             FROM evento e
//             INNER JOIN proveedor p ON e.Proveedor = p.idProveedor
//             INNER JOIN ciudad c ON e.ciudad_idciudad = c.idciudad
//             INNER JOIN categoria ca ON e.categoria_idCategoria = ca.idCategoria
//         WHERE e.idEvento = $idEvento";
//     }
}
?>