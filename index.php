<?php
session_start();
if(isset($_GET["cerrarSesion"])){
  session_destroy();
}
require("logica/Categoria.php");
require("logica/Ciudad.php");
require("logica/Evento.php");
require("logica/Persona.php");
require("logica/Proveedor.php");
require("logica/Cliente.php");
if(isset($_SESSION["id"])){
  $idCliente=$_SESSION["id"];
  $cliente = new Cliente($idCliente);
  $cliente->consultar();
}
include("componentes/encabezado.php");
?>
.p-3 {
display: flex;
justify-content: center;
align-items: center;
margin: 6px;
}
.col-md-4 {
justify-content: center;
align-items: center;
}

.col-lg-4 .p-3{
margin: 5px;
width: 25vw;
height: 31vw;
}
.card-custom {
margin-top: 20px;
}

.card .row{
padding: 10px;
}

.square {
width: 19vw; 
height: 19vw; 
}
</style>
</head>

<body>
  <?php include("componentes/navcliente.php")?>
  <br>
  <?php
    $evento = new Evento();
    $eventos = $evento->consultaGeneral(null, 0, 15);
    $hoy = date('y-m-d');
    $evento = $evento->eventoCercano($hoy);
  ?>
  <div class="container mt-4">
    <div class="row">
      <!-- Columna izquierda -->
      <div class="col-md-5">
        <div class="card">
          <img src="https://via.placeholder.com/750" class="card-img-top" alt="Imagen de ejemplo">
          <div class="card-body">
            <h5 class="card-title"><?=$evento->getNombre()?></h5>
            <p class="card-text">Sitio: <?=$evento->getCiudad()->getNombre()." ".$evento->getSitio()?></p>
            <p class="card-text">Fecha: <?=$evento->getFechaEvento()." / ".$evento->getHoraEvento()?></p>
            <p class="card-text">EdadMinima: <?=$evento->getEdadMinima()?></p>
            <p class="card-text">Categoria: <?=$evento->getCategoria()->getNombre()?></p>
            <a href="paginas/eventoInfo.php?idEvento=<?=$evento->getIdEvento()?>" class="btn btn-primary">Ver más</a>
          </div>
        </div>
      </div>
      <!-- Columna derecha -->
      <div class="col-md-7">
        <div class="row">
          <?php
          $counter = 0;
          foreach($eventos as $eventoActual){
              if ($counter >= 6) break;
              if ($counter % 3 === 0 && $counter > 0) echo '</div><div class="row">';
              if($eventoActual->getIdEvento() == $evento->getIdEvento()){
        ?>

          <?php
              }else{
        ?>
          <div class="col-md-4 card-custom">
            <div class="card">
              <img src="https://via.placeholder.com/150" class="card-img-top" alt="Imagen de ejemplo">
              <div class="card-body">
                <h6 class="card-title"><?= $eventoActual->getNombre()?></h6>
                <p class="card-text">Sitio: <?=$evento->getSitio()?></p>
                <p class="card-text">Fecha: <?=$eventoActual->getFechaEvento()." / ".$evento->getHoraEvento()?></p>
                <a href='paginas/eventoInfo.php?idEvento=<?=$eventoActual->getIdEvento()?>'>Ver más</a>
              </div>
            </div>
          </div>
          <?php
              $counter++;
              }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Events -->
  <div class="container">
    <div class="row mb-3">

    </div>
  </div>
  <!-- Cities -->
  <div class="container">
    <div class="row mb-3">
      <div class="col">
        <h4>Ciudades</h4>
        <div class="container">
          <div id="carouselCiudades" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php
                        $ciudad = new Ciudad();
                        $ciudades = $ciudad->consultarTodos();
                        $totalCiudades = count($ciudades);
                        $ciudadesPorSlide = 4;
                        $slideIndex = 0;    

                        // Loop through the cities and divide them into slides of 4
                        foreach ($ciudades as $index => $ciudadActual) {
                            // Open a new slide if needed
                            if ($index % $ciudadesPorSlide == 0) {
                                $activeClass = ($slideIndex == 0) ? 'active' : '';
                                echo "<div class='carousel-item $activeClass'>";
                                echo "<div class='container'><div class='row'>";
                                $slideIndex++;
                            }
                            // Output the city as a square element
                            echo "<div class='col-3'>";
                            echo "<a href='paginas/ciudadEvento.php?idCiudad=".$ciudadActual->getIdCiudad()."'><div class='p-3 border bg-light square'>";
                            echo $ciudadActual->getNombre();
                            echo "</div></a>";
                            echo "</div>";
                            // Close the slide if we've added 4 cities
                            if (($index + 1) % $ciudadesPorSlide == 0 || ($index + 1) == $totalCiudades) {
                                echo "</div></div></div>";
                            }
                        }
                        
                        ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row mb-3">
      <div class="col">
        <h4>Categorías</h4>
        <div class="container">
          <div class="row">
            <?php
                    $categoria = new Categoria();
                    $categorias = $categoria->consultarCategorias(); // Obtén todas las categorías
                    $totalCategorias = count($categorias);
                    $categoriasPorColumna = 4; // Cuatro categorías por fila

                    foreach ($categorias as $index => $categoriaActual) {
                        echo "<div class='col-3'>";
                        echo "<a href='paginas/CategoriaEvento.php?idCategoria=" . $categoriaActual->getIdCategoria() . "'><div class='p-3 border bg-light square'>";
                        echo htmlspecialchars($categoriaActual->getNombre()); // Muestra el nombre de la categoría
                        echo "</div></a>";
                        echo "</div>";

                        // Cierra la fila después de cuatro categorías
                        if (($index + 1) % $categoriasPorColumna == 0) {
                            echo "</div><div class='row'>"; // Cierra la fila actual y abre una nueva
                        }
                    }
                    ?>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>
<?php include("componentes/footer.php")?>

</html>