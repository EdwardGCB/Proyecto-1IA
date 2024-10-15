<?php
class EventoZona{
  private $valor;
  private $aforo;
  private $evento;
  private $zona;
  private $disponibles;

  public function getValor() {
    return $this->valor;
  }
  
  public function getAforo() {
    return $this->aforo;
  }
  
  public function getEvento() {
    return $this->evento;
  }
  
  public function getZona() {
    return $this->zona;
  }
  
  public function setValor($valor) {
    $this->valor = $valor;
  }
  
  public function setAforo($aforo) {
    $this->aforo = $aforo;
  }
  
  public function setEvento($evento) {
    $this->evento = $evento;
  }
  
  public function setZona($zona) {
    $this->zona = $zona;
  }
  public function getDisponibles() {
    return $this->disponibles;
}

  public function setDisponibles($disponibles) {
      $this->disponibles = $disponibles;
  }

  public function __construct($valor=0, $aforo=0, $evento=null, $zona=null, $disponibles=0) {
    $this->valor = $valor;
    $this->aforo = $aforo;
    $this->evento = $evento;
    $this->zona = $zona;
    $this->disponibles = $disponibles;
}

  public function consultarPorZona($evento) {
    $eventos = array();    
    $conexion = new Conexion();
    $conexion->abrirConexion();
    $EventoZonaDAO = new EventoZonaDAO();

    // Ejecutar consulta para obtener eventos por categoría
    $conexion->ejecutarConsulta($EventoZonaDAO->consultaIndividual($evento));
    while ($registro = $conexion->siguienteRegistro()) {
      $eventoZona = new EventoZona(
        $registro[0],  // valor
        $registro[1],  // aforo
        $registro[2],  // nombre del evento
        $registro[3],  // zona
        $registro[4]   // disponibles (nuevo campo)
    );
        array_push($eventos, $eventoZona);
    }

    $conexion->cerrarConexion();
    return $eventos;
}


}
?>