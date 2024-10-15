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
require ("../logica/EventoZona.php");
require ("../logica/Zona.php");
require ("../logica/Asiento.php");
$id = $_SESSION["id"];
$proveedor = new Proveedor($id);
$proveedor -> consultar();
$zona = new Zona();
if(!isset($_GET["id"]) || $_GET["id"] < 1){
  header("Location: sesionProveedor.php"); 
}
$idEvento= $_GET["id"];
$evento = new Evento($idEvento, null, null, null, null, null, null, null, $proveedor);
if(!$evento->consultaPorId()){
  header("Location: sesionProveedor.php");
}
if(isset($_POST["refresh"])){
  $zona->setIdZona($_POST["zona"]);
  $zona->consultarPorID();
  $asiento = new Asiento(null,null,null,null,$zona);
  $filaAsientos = $asiento->consultarFilasZona();
  $columnasAsientos = $asiento->consultarColumnasZona();
}

if(isset($_POST["agregar"])){
  $zona->setIdZona($_POST["zona"]);
  echo $zona->getIdZona();
  $zona->consultarPorID();
  $aforo= $_POST["aforo"];
  $valor= $_POST["valor"];
  $eventoZona = new EventoZona($valor,$aforo,$evento,$zona);
  $eventoZona->insertar();
}
if(isset($_POST["guardar"])){
  $evento->setNombre($_POST["nombre"]);
  $evento->setEdadMinima($_POST["edadMinima"]);
  $evento->setFechaEvento($_POST["fechaEvento"]);
  $evento->setHoraEvento($_POST["horaEvento"]);
  $ciudad = new Ciudad($_POST["ciudad"]);
  $evento->setCiudad($ciudad);
  $categoria = new Categoria($_POST["sitio"]);
  $evento->setCategoria($categoria);
  if($evento->actualizar()){
    header("Location: editEvento.php?id=".$evento->getIdEvento()."");
  }
}

include "../componentes/encabezado.php";
?>
.full-height-sidebar {
height: 100%;
}
</style>

<body>

  <div class="row">
    <div class="col-2">
      <?php include "../componentes/navProveedor.php"; ?>
    </div>
    <div class="col-10">
      <div class="container">
        <div class="container mt-4">
          <div class="container-fluid">
            <h2>Evento #<?php echo $evento->getIdEvento()?></h2>
          </div>
          <!--info del evento-->
          <div class="card">
            <div class="card-header text-white bg-dark">
              Información General
            </div>
            <div class="card-body">
              <div class="row">
                <form action="editEvento.php?id=<?php echo $evento->getIdEvento()?>" method="post">
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
                    <input type="date" class="form-control" name="fechaEvento" id="fechaEvento" aria-label="fechaEvento"
                      aria-describedby="basic-addon1" value="<?php
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
                  <!-- boton para guardar los cambios-->
                  <button type="submit" class="btn btn-primary" name="guardar">Guardar Cambios</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="container mt-4">
            <!--Zonas y tabla de zonas-->
            <div class="row mt-5">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header text-white bg-dark">
                    Zonas
                  </div>
                  <div class="card-body">
                    <!--zonas-->
                    <div id="dynamicForm" class="hidden mt-3">
                      <form id="moduleForm" method="post" action="editEvento.php?id=<?php echo $evento->getIdEvento()?>">
                        <div class="mb-3">
                          <label for="selectField" class="form-label">Select Field</label>
                          <select id="selectField" class="form-select" name="zona">
                            >
                            <?php
                                $zonat = new Zona();
                                $zonas = $zonat->consultarTodos();
                                foreach ($zonas as $zonaActual) {
                                  $selected = ($zonaActual->getIdZona() == $zona->getIdZona()) ? 'selected' : '';
                                  echo '<option value="' . $zonaActual->getIdZona() . '" ' . $selected . '>' . $zonaActual->getNombre() . '</option>';
                                }
                              ?>
                          </select>
                        </div>
                        <!--columna del asiento-->
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="input1" name="columna"
                            value="<?php echo  (isset($columnasAsientos))? $columnasAsientos : '1-10'?>" readonly>
                          <label for="input1" class="form-label">Cantidad de columnas</label>
                        </div>
                        <!--fila del asiento-->
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="input2" name="fila"
                            value="<?php echo (isset($filaAsientos))? $filaAsientos: '1-26'?>" readonly>
                          <label for="input2" class="form-label">Cantidad de filas</label>
                        </div>
                        <!--precio de la zona-->
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="input2" name="valor" placeholder="Enter text">
                          <label for="input2" name="precio" class="form-label">Precio de la zona</label>
                        </div>
                        <!--aforo-->
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" id="input3" name="aforo" placeholder="Enter text"
                            value="<?php echo (isset($filaAsientos) && isset($columnasAsientos))? ($filaAsientos*$columnasAsientos): '' ?>"
                            readonly>
                          <label for="input3" class="form-label">Aforo</label>
                        </div>
                        <button type="submit" name="refresh" class="btn btn-secondary">refrescar</button>
                        <button type="submit" name="agregar" class="btn btn-success">Agregar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header text-white bg-dark">
                    Tabla de Zonas
                  </div>
                  <div class="card-body">
                    <?php include "../componentes/tablaEventosZona.php"?>
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