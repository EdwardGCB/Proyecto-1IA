<?php
session_start();
if(!isset($_SESSION["id"])){
  header("Location: ../index.php");    
}
require ("../logica/Persona.php");
require ("../logica/Proveedor.php");
require ("../logica/Ciudad.php");
require ("../logica/Categoria.php");
require ("../logica/Evento.php");
$id = $_SESSION["id"];
$proveedor = new Proveedor($id);
$proveedor -> consultar();
$evento = new Evento(null, null, null, null, null, null, null, null, $proveedor);
$cantidadDatos = $evento -> numeroEventosProveedor();
$cantidadDatosMostrar = 10;
$paginas = ceil($cantidadDatos / $cantidadDatosMostrar);
if(!isset($_GET["pagina"])){
  header("Location: eventos.php?pagina=1");
}
$paginaActual = $_GET["pagina"];
if($paginaActual > $paginas){
  header("Location: eventos.php?pagina=1");
}else if($paginaActual < 1){
  header("Location: eventos.php?pagina=1");
}
if(isset($_POST["buscar"])){
  $eventos = $evento -> consultarPorProveedor($_POST["inputBuscar"]);
}else{
  $eventos = $evento -> consultarPorProveedor();
}
if (isset($_POST["agregarEvento"])) {
  $nombre = $_POST["nombreEvento"];
  $edadMinima = $_POST["edadMinima"];
  $fecha = htmlspecialchars($_POST["fechaEvento"]);
  $hora = htmlspecialchars($_POST["horaEvento"]);
  $ubicacion = $_POST["ubicacionEvento"];
  $ciudad = new Ciudad($_POST["ciudad"]);
  $categoria = new Categoria($_POST["categoria"]);
  $evento = new Evento(null,"defaultSitio.png", "defaultFlayer.png", "defaultLogo.png", $edadMinima, $nombre, $fecha, $hora, $proveedor, $ciudad, $categoria);
  if($evento -> agregar()){
    echo "<p>evento agregado</p>";
  }
}
include "../componentes/encabezado.php";
?>
.full-height-sidebar {
height: 100vh;
}
</style>

<body>

  <div class="row">
    <div class="col-2">
      <?php include "../componentes/navProveedor.php"; ?>
    </div>
    <div class="col-10">
      <div class="container">
        <nav class="navbar navbar-light bg-light">
          <div class="container-fluid">
            <h2>Mis eventos</h2>
          </div>
        </nav>
        <div class="container mt-3">
          <form class="d-flex" role="search" method="post" action="eventos.php?pagina=<?php echo $paginaActual?>">
            <input class="form-control me-2" type="search" name="inputBuscar" placeholder="Buscar" aria-label="Buscar">
            <button class="btn btn-outline-success me-2" name="buscar" type="submit">
              <span class="material-symbols-rounded">search</span>
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <span class="material-symbols-rounded">add</span>
            </button>
          </form>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha Evento</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Categoria</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($eventos as $eventoActual) {
                  echo "<tr>";
                  echo "<th scope='row'>" . $eventoActual->getIdEvento() . "</th>";
                  echo "<td>" . $eventoActual->getNombre() . "</td>";
                  echo "<td>" . $eventoActual->getFechaEvento() . "<br>" . $eventoActual->getHoraEvento() . "</td>";
                  echo "<td>" . $eventoActual->getCiudad()->getNombre() . "</td>";
                  echo "<td>" . $eventoActual->getCategoria()->getNombre() . "</td>";
                  echo "<td><a href='editEvento.php?id=" . $eventoActual->getIdEvento() . "' class='btn btn-success' style='color: white;'>
                    <span class='material-symbols-rounded'>
                      edit
                    </span>
                  </a></td>";
                  echo "</tr>";
              }
            ?>
            </tbody>
          </table>
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
              <li class="page-item">
                <a class="page-link <?php echo ($paginaActual-1 < 1)?  "disabled" : "" ?>"
                  href="eventos.php?pagina=<?php echo ($paginaActual-1 != 0)?$paginaActual-1:"" ?>"
                  aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <?php for($i=0;$i<$paginas;$i++){
              echo "<li class='page-item'><a class='page-link' href='eventos.php?pagina=".($i+1)."'>".($i+1)."</a></li>";
            }
            ?>
              <li class="page-item">
                <a class="page-link <?php echo ($paginaActual+1 > $paginas)?  "disabled" : "" ?>"
                  href="eventos.php?pagina=<?php echo ($paginaActual+1 < $paginas)?"": $paginaActual+1 ?>"
                  aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <?php include "../componentes/agregarEvento.php"; ?>
</body>

</html>