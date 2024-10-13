<?php
require_once('Evento.php');
require_once (dirname(__DIR__) . '/persistencia/Conexion.php');
require_once (dirname(__DIR__) . '/persistencia/CategoriaDAO.php');

class Categoria {
    private $idCategoria;
    private $nombre;

    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function __construct($idCategoria = 0, $nombre = ""){
        $this->idCategoria = $idCategoria;
        $this->nombre = $nombre;
    }

    // Método para consultar todas las categorías
    public function consultarCategorias(){
        $categorias = array();
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $categoriaDAO = new CategoriaDAO();
        $conexion->ejecutarConsulta($categoriaDAO->consultarCategorias());
        while ($registro = $conexion->siguienteRegistro()) {
            $categoria = new Categoria($registro[0], $registro[1]);
            array_push($categorias, $categoria);
        }
        $conexion->cerrarConexion();
        return $categorias;        
    }

    public function consultarPorCategoria($idCategoria) {
        $eventos = array(); // Inicializa correctamente la variable $eventos
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $categoriaDAO = new CategoriaDAO();
        $conexion->ejecutarConsulta($categoriaDAO->consultaIndividual($idCategoria));
        
        while ($registro = $conexion->siguienteRegistro()) {
            $evento = new Evento($registro[0],$registro[1],$registro[2], $registro[3], $registro[4], $registro[5], $registro[6], $registro[7]);
            array_push($eventos, $evento);
        }
    
        $conexion->cerrarConexion();
        return $eventos;
    }
    
}
?>
