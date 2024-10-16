<?php
require('../logica/Evento.php');
require('../logica/Persona.php');
require('../logica/Proveedor.php');
require('../logica/Ciudad.php');
require("../logica/Categoria.php");

include('../componentes/encabezado.php');
include('../componentes/Ticket.php');
?>
</style>

<body>
  <?php include('../componentes/navcliente.php');?>
  <br>
  <section class="container">
    <h1>Proximos Eventos</h1>
    <div class="row">
      <?php
            // Verificar si se ha pasado un idCategoria como parámetro en la URL
            if (isset($_GET['idCategoria'])) {
                $idCategoria = $_GET['idCategoria'];

                // Instanciar la clase Categoria y llamar al método para consultar eventos por categoría
                $categoria = new Categoria($idCategoria);
                $evento = new Evento(null,null,null,null,null,null,null,null,null,null,$categoria);
                $eventos = $evento->consultarPorCategoria();

                // Echo para ver los datos



                if (!empty($eventos)) {
                    foreach ($eventos as $eventoActual) {
                        // Asegúrate de que 'fechaEvento' no esté vacío
                        $fechaEvento = $eventoActual->getFechaEvento();
                        $fecha = !empty($fechaEvento) ? new DateTime($fechaEvento) : null;

                        // Extraer día, mes y año
                        $dia = $fecha ? $fecha->format("d") : "";
                        $mes = $fecha ? $fecha->format("M") : ""; // Mes en formato abreviado
                        $anio = $fecha ? $fecha->format("Y") : "";

            ?>
      <article class="card fl-left">
        <section class="date">
          <time datetime="<?php echo htmlspecialchars($eventoActual->getFechaEvento()); ?>">
            <?php
                // Obtener el día
                $fechaEvento = $eventoActual->getFechaEvento();
                $fecha = new DateTime($fechaEvento);
                $dia = $fecha->format("d");
            ?>
            <span><?php echo $dia; ?></span> <!-- Día -->
          </time>
        </section>
        <section class="card-cont">
          <small><?php echo htmlspecialchars($eventoActual->getNombre()); ?></small>
          <h3><?php echo htmlspecialchars($eventoActual->getNombre()); ?> en
            <?php echo htmlspecialchars($eventoActual->getCiudad()->getNombre()); ?></h3>
          <div class="even-date">
            <i class="fa fa-calendar"></i>
            <time>
              <span><?php echo date("l, d F Y", strtotime($eventoActual->getFechaEvento())); ?></span>
              <span><?php echo htmlspecialchars($eventoActual->getHoraEvento()); ?></span>
            </time>
          </div>
          <div class="even-info">
            <i class="fa fa-map-marker"></i>
            <p>Proveedor: <?php echo $eventoActual->getProveedor()->getNombre(); ?></p>
            <p>Ciudad: <?php echo $eventoActual->getCiudad()->getNombre(); ?></p>
            <p>
            <a href="eventoInfo.php?idEvento=<?php echo $eventoActual->getIdEvento();?>">
            <span class="material-symbols-rounded">
                more_horiz
            </span>
            </a>
            </p>
          </div>
        </section>
      </article>

      <?php
              }
          } else {
              echo "<p>No se encontraron eventos en esta categoría.</p>";
          }
      } else {
          echo "<p>No se ha seleccionado ninguna categoría.</p>";
      }
      ?>
    </div>
  </section>
  <?php include("../componentes/footer.php")?>
</body>
</html>