<?php
session_start();
if(!isset($_SESSION["id"])){
  header("Location: ../index.php");    
}
require ("../logica/Persona.php");
require ("../logica/Proveedor.php");
require_once ("../logica/Ciudad.php");
require_once ("../logica/Categoria.php");
require ("../logica/Evento.php");
require ("../logica/EventoZona.php");
require ("../logica/Zona.php");
require_once ("../logica/Categoria.php");
require ("../logica/Asiento.php");
$id = $_SESSION["id"];
$proveedor = new Proveedor($id);
$asiento = new Asiento();
$asientos = $asiento -> crearAsientos();
$proveedor -> consultar();
if(!isset($_GET["id"]) || $_GET["id"] < 1){
  header("Location: sesionProveedor.php"); 
}
$idEvento= $_GET["id"];
$evento = new Evento($idEvento, null, null, null, null, null, null, null, $proveedor);
if(!$evento->consultaPorId()){
  header("Location: sesionProveedor.php");
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
            <h2>Evento #<?php echo $evento->getIdEvento()?></h2>
          </div>
        </nav>
        <div class="container mt-4">
          <!--info del evento-->
          <div class="card">
            <div class="card-header">
              Información General
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="../paginas/eventos.php" method="post">
                    <!-- Nombre del evento -->
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control rounded-4" name="nombreEvento" id="nombreEvento"
                        value="<?php echo $evento->getNombre(); ?>">
                      <label for="nombreEvento">Nombre evento</label>
                    </div>
                    <!-- Edad Minima del evento -->
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="edadMinima" id="edadMinima"
                        aria-describedby="basic-addon1" value="<?php
                         echo $evento->getEdadMinima(); 
                         ?>">
                      <label for="edadMinima">Edad Minima</label>
                    </div>
                    <!-- Fecha del evento -->
                    <!-- Fecha del evento -->
                    <div class="form-floating mb-3">
                      <input type="date" class="form-control" name="fechaEvento" id="fechaEvento"
                        aria-label="fechaEvento" aria-describedby="basic-addon1" value="<?php
                        echo $evento->getFechaEvento();
                         ?>">
                      <label for="fechaEvento">Fecha Evento</label>
                    </div>

                    <!-- hora del evento -->
                    <div class="form-floating mb-3">
                      <input type="time" class="form-control" name="horaEvento" id="horaEvento" aria-label="horaEvento"
                        aria-describedby="basic-addon1" value="<?php echo $evento->getHoraEvento(); ?>">
                      <label for="horaEvento">Hora Evento</label>
                    </div>
                    <!-- direccion del evento -->
                  </form>
                </div>
                <div class="col-md-6">
                  <!-- Lugar del evento -->
                  <select class="form-select mb-3" name="ciudad" id="ciudad" aria-label="Default select example">
                    <option value="" disabled>Ciudad</option>
                    <?php
                      $ciudad = new Ciudad();
                      $ciudades = $ciudad->consultarTodos();
                      foreach ($ciudades as $ciudadActual) {
                          $selected = ($ciudadActual->getIdCiudad() == $evento->getCiudad()->getIdCiudad()) ? 'selected' : '';
                          echo '<option value="' . $ciudadActual->getIdCiudad() . '" ' . $selected . '>' . $ciudadActual->getNombre() . '</option>';
                      }
                    ?>
                  </select>

                  <!-- Tipo de evento -->
                  <select class="form-select mb-3" name="categoria" id="categoria" aria-label="Default select example">
                    <option selected>Categoria</option>
                    <?php
                      $categoria = new Categoria();
                      $categorias = $categoria->consultarTodos();
                      foreach ($categorias as $categoriaActual) {
                        $selected = ($categoriaActual->getIdCategoria() == $evento->getCategoria()->getIdCategoria()) ? 'selected' : '';
                        echo '<option value="' . $categoriaActual->getIdCategoria() . '" ' . $selected . '>' . $categoriaActual->getNombre() . '</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>

            </div>
            <!--Zonas y tabla de zonas-->
            <div class="row mt-5">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    Zonas
                  </div>
                  <div class="card-body">
                    <!--zonas-->
                    <div id="dynamicForm" class="hidden mt-3">
                      <form id="moduleForm" method="post" action="process_form.php">
                        <div class="mb-3">
                          <label for="selectField" class="form-label">Select Field</label>
                          <select id="selectField" class="form-select" name="selectField">
                          <option selected>Seleccion Zona</option>
                            <?php
                              $zona = new Zona();
                              $zonas = $zona->consultarTodos();
                              foreach ($zonas as $zonaActual) {
                                  echo '<option value="' . $zonaActual->getIdZona() . '">' . $zonaActual->getNombre() . '</option>';
                              }
                            ?>
                          </select>
                        </div>
                        <!--columna del asiento-->
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="input1" name="input1" value="1-100">
                          <label for="input1" class="form-label">Cantidad de columnas</label>
                        </div>
                        <!--fila del asiento-->
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="input2" name="input2" value="A-Z">
                          <label for="input2" class="form-label">Cantidad de filas</label>
                        </div>
                        <!--precio de la zona-->
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="input2" name="input2" placeholder="Enter text">
                          <label for="input2" class="form-label">Precio de la zona</label>
                        </div>
                        <!--aforo-->
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="input3" name="input3" placeholder="Enter text">
                          <label for="input3" class="form-label">Aforo</label>
                        </div>
                        <button type="submit" class="btn btn-success">Agregar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    Tabla de Zonas
                  </div>
                  <div class="card-body">
                    <!--tabla de zonas-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include("../componentes/footer.php")?>
</body>

</html>