<?php
class CategoriaDAO{
    private $idCategoria;
    private $nombre;
    
    public function __construct($idCategoria=0, $nombre=""){
        $this -> idCategoria = $idCategoria;
        $this -> nombre = $nombre;
    }
    
    public function consultarCategorias(){
        return "select idCategoria, nombre
                from Categoria
                order by nombre asc";
    } 

    public function consultarPorId(){
        return "select nombre
                from Categoria
                where idCategoria = '" . $this -> idCategoria . "'";
      }

}

?>