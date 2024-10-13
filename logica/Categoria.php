<?php

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
        $eventos = array();    
        $conexion = new Conexion();
        $conexion->abrirConexion();
        $categoriaDAO = new CategoriaDAO();
    
        // Ejecutar consulta para obtener eventos por categoría
        $conexion->ejecutarConsulta($categoriaDAO->consultaIndividual($idCategoria));
    
        while ($registro = $conexion->siguienteRegistro()) {
    

    
            // Crear el objeto Evento
            $evento = new Evento(
                $registro[0],  // idEvento
                $registro[1],  // sitio
                $registro[2],  // flayer
                $registro[3],  // logo
                $registro[4],  // edadMinima
                $registro[5],  // nombre del evento
                $registro[6],  // fechaEvento
                $registro[7],  // horaEvento
                $registro[8],  
                $registro[9],
            );
            array_push($eventos, $evento);
        }
    
        $conexion->cerrarConexion();
        return $eventos;
    }
    
}
?>
