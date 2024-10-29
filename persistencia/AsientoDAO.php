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

  public function asientosDisponibles($evento){
    return "SELECT COUNT(a.idAsiento) AS asientos_disponibles
            FROM 
                Asiento a
            JOIN 
                EventoZona ez ON a.Zona_idZona = ez.Zona_idZona
            LEFT JOIN 
                Ticket t ON a.idAsiento = t.Asiento_idAsiento AND t.EventoZona_Evento_idEvento = ez.Evento_idEvento
            WHERE 
                ez.Evento_idEvento = '".$evento->getIdEvento()."'
                AND ez.Zona_idZona = '".$this->zona->getIdZona()."'
                AND t.idTicket IS NULL
    ";
  }

  public function consultarAsiento($limite, $idEvento){
    return "
        SELECT a.idAsiento, a.columna, a.fila
        FROM 
            Asiento a
        JOIN 
            EventoZona ez ON a.Zona_idZona = ez.Zona_idZona
        LEFT JOIN 
            Ticket t ON a.idAsiento = t.Asiento_idAsiento 
             AND t.EventoZona_Evento_idEvento = ez.Evento_idEvento
        WHERE 
        a.Zona_idZona = '" . $this->zona->getIdZona(). "' AND
        ez.Evento_idEvento = '".$idEvento."' AND
        t.idTicket IS NULL
        LIMIT $limite
    ";
  }

}
?>