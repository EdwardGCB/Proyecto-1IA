<?php
require_once (dirname(__DIR__) . '/persistencia/Conexion.php');
require_once (dirname(__DIR__) . '/persistencia/CategoriaDAO.php');

class Categoria{
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

    public function __construct($idCategoria=0, $nombre=""){
        $this -> idCategoria = $idCategoria;
        $this -> nombre = $nombre;
    }
    
    public function consultarCategorias(){
        $categorias = array();
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $categoriaDAO = new CategoriaDAO();
        $conexion -> ejecutarConsulta($categoriaDAO -> consultarCategorias());
        while($registro = $conexion -> siguienteRegistro()){
            $categoria = new Categoria($registro[0], $registro[1]);
            array_push($categorias, $categoria);
        }
        $conexion -> cerrarConexion();
        return $categorias;        
    }
    public function consultaCategoria(){
        $conexion = new Conexion();
        $conexion -> abrirConexion();
        $ciudadDAO = new CiudadDAO($this -> idCategoria);
        $conexion -> ejecutarConsulta($ciudadDAO -> consultaIndividual());
        $registro = $conexion -> siguienteRegistro();
        $this -> nombre = $registro[0];
        $conexion -> cerrarConexion();
      }
}

?>