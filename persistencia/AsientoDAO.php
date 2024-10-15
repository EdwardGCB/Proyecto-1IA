<?php
class AsientoDAO{
  private $idAsiento;
  private $fila;
  private $columna;
  private $estado;
  private $zona;
  
  public function __construct($idAsiento=0,$fila="", $columna=0, $estado=0, $zona=null){
    $this -> idAsiento = $idAsiento;
    $this -> fila = $fila;
    $this -> columna = $columna;
    $this -> estado = $estado;
    $this -> zona = $zona;
  }

  public function consultarFilasZona(){
    return "
        SELECT fila
        FROM asiento
        WHERE zona_idZona='" . $this->zona->getIdZona() . "'
        GROUP BY fila;
    ";
}


  public function consultarcolumnasZona(){
    return "
      SELECT columna
      FROM asiento 
      WHERE zona_idZona='".$this->zona->getIdZona()."'
      GROUP By columna;
    ";
  }

}
?>