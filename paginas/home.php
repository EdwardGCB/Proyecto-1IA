<body>
  
  <?php include("componentes/navcliente.php"); ?>
  <br>
  
  <div class="container mt-4" id="home">
    <div class="container" id="events">
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
                  echo "<div class='col-md-3'>";
                  echo "<a href='?pid=".base64_encode("paginas/ciudadEvento.php")."&idCiudad=". $ciudadActual->getIdCiudad() . "' class='text-decoration-none'>";
                  echo "  <div class='card shadow-sm border-0 rounded'>";
                  echo "    <div class='card-body text-center'>";
                  echo "      <h5 class='card-title mb-0'>" . $ciudadActual->getNombre() . "</h5>";
                  echo "    </div>";
                  echo "  </div>";
                  echo "</a>";
                  echo "</div>";
  
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
                echo "<div class='col-md-3'>";
                  echo "<a href='?pid=".base64_encode("paginas/categoriaEvento.php")."&idCategoria=" . $categoriaActual->getIdCategoria() . "' class='text-decoration-none'>";
                  echo "  <div class='card shadow-sm border-0 rounded'>";
                  echo "    <div class='card-body text-center'>";
                  echo "      <h5 class='card-title mb-0'>" . $categoriaActual->getNombre() . "</h5>";
                  echo "    </div>";
                  echo "  </div>";
                  echo "</a>";
                  echo "</div>";
                // Cierra la fila después de cuatro categorías
                if (($index + 1) % $categoriasPorColumna == 0) {
                  echo "</div><div class='row mt-3'>"; // Cierra la fila actual y abre una nueva
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      url = "indexAjax.php?pid=<?php echo base64_encode("ajax/buscarTicketAjax.php") ?>";
      $("#events").load(url);
      $("#search").keyup(function() {
        if ($("#search").val().length >= 3) {
          url = "indexAjax.php?pid=<?php echo base64_encode("ajax/buscarTicketAjax.php") . "&name=" ?>" + $("#search").val();
          $("#events").load(url);
        }
      });
  
      $(".categoria").on("click", function() {
        let idCategoria = $(this).data("id")
        console.log("ID de la categoría:", idCategoria);
  
        // Cargar contenido según la categoría seleccionada
        let url = "indexAjax.php?pid=<?php echo base64_encode("ajax/categoriaAjax.php") . "&id=" ?>" + idCategoria;
        $("#home").load(url);
      });
    });
  </script>
  <?php include("componentes/footer.php") ?>
</body>