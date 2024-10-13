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

    public function consultaIndividual($idCategoria) {
        return "SELECT 
                e.idEvento, e.sitio, e.flayer, e.logo, e.edadMinima, e.nombre AS artista, e.fechaEvento, e.horaEvento, 
                p.usuario AS proveedor,  -- Aquí el nombre del proveedor, si lo necesitas
                c.nombre AS ciudad, 
                ca.nombre AS categoria
            FROM evento e 
            INNER JOIN proveedor p ON e.Proveedor = p.idProveedor 
            INNER JOIN ciudad c ON e.ciudad_idciudad = c.idciudad 
            INNER JOIN categoria ca ON e.categoria_idCategoria = ca.idCategoria
            WHERE ca.idCategoria = $idCategoria ORDER BY e.fechaEvento";
        }
    
}

?>