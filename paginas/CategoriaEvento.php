
<?php
include("../componentes/encabezado.php");
include("../componentes/navcliente.php");
?>

<style>

.material-symbols-rounded {
  font-variation-settings:
  'FILL' 1,
  'wght' 400,
  'GRAD' 0,
  'opsz' 24;
}

* {
    margin: 0;
    padding: 0;
    border: 0;
    box-sizing: border-box
}

body {
    background-color: #dadde6;
    font-family: arial
}

.fl-left {
    float: left
}

.fl-right {
    float: right
}

h1 {
    text-transform: uppercase;
    font-weight: 900;
    border-left: 10px solid #fec500;
    padding-left: 10px;
    margin-bottom: 30px
}

.row {
    overflow: hidden
}

.card {
    display: table-row;
    width: 49%;
    background-color: #fff;
    color: #989898;
    margin-bottom: 10px;
    font-family: 'Oswald', sans-serif;
    text-transform: uppercase;
    border-radius: 4px;
    position: relative
}

.card+.card {
    margin-left: 2%
}

.date {
    display: table-cell;
    width: 25%;
    position: relative;
    text-align: center;
    border-right: 2px dashed #dadde6
}

.date:before,
.date:after {
    content: "";
    display: block;
    width: 30px;
    height: 30px;
    background-color: #DADDE6;
    position: absolute;
    top: -15px;
    right: -15px;
    z-index: 1;
    border-radius: 50%
}

.date:after {
    top: auto;
    bottom: -15px
}

.date time {
    display: block;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%)
}

.date time span {
    display: block
}

.date time span:first-child {
    color: #2b2b2b;
    font-weight: 600;
    font-size: 250%
}

.date time span:last-child {
    text-transform: uppercase;
    font-weight: 600;
    margin-top: -10px
}

.card-cont {
    display: table-cell;
    width: 75%;
    font-size: 85%;
    padding: 10px 10px 30px 50px
}

.card-cont h3 {
    color: #3C3C3C;
    font-size: 130%
}

.row:last-child .card:last-of-type .card-cont h3 {
    text-decoration: line-through
}

.card-cont>div {
    display: table-row
}

.card-cont .even-date i,
.card-cont .even-info i,
.card-cont .even-date time,
.card-cont .even-info p {
    display: table-cell
}

.card-cont .even-date i,
.card-cont .even-info i {
    padding: 5% 5% 0 0
}

.card-cont .even-info p {
    padding: 30px 50px 0 0
}

.card-cont .even-date time span {
    display: block
}

.card-cont a {
    display: block;
    text-decoration: none;
    width: 80px;
    height: 30px;
    background-color: #D8DDE0;
    color: #fff;
    text-align: center;
    line-height: 30px;
    border-radius: 2px;
    position: absolute;
    right: 10px;
    bottom: 10px
}

.row:last-child .card:first-child .card-cont a {
    background-color: #037FDD
}

.row:last-child .card:last-child .card-cont a {
    background-color: #F8504C
}

@media screen and (max-width: 860px) {
    .card {
        display: block;
        float: none;
        width: 100%;
        margin-bottom: 10px
    }
    .card+.card {
        margin-left: 0
    }
    .card-cont .even-date,
    .card-cont .even-info {
        font-size: 75%
    }
}

</style>

<body>

<br>

<section class="container">
  <h1>Eventos</h1>
  <div class="row">
    <?php
    require_once("../logica/Categoria.php");

    // Verificar si se ha pasado un idCategoria como parámetro en la URL
    if (isset($_GET['idCategoria'])) {
        $idCategoria = $_GET['idCategoria'];

        // Instanciar la clase Categoria y llamar al método para consultar eventos por categoría
        $categoria = new Categoria();
        $eventos = $categoria->consultarPorCategoria($idCategoria);

        // Echo para ver los datos
        echo "<pre>";
        print_r($eventos); // Muestra la estructura de la variable $eventos
        echo "</pre>";

        
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
                  <time datetime="<?php echo htmlspecialchars($fechaEvento); ?>">
                    <span><?php echo $dia; ?></span> <!-- Día -->
                  </time>
                </section>
                <section class="card-cont">
                  <small><?php echo htmlspecialchars($eventoActual->getNombre()); ?></small>
                  <h3><?php echo htmlspecialchars($eventoActual->getNombre()); ?> en <?php echo htmlspecialchars($eventoActual->getCategoria()); ?></h3>
                  <div class="even-date">
                    <i class="fa fa-calendar"></i>
                    <time>
                      <span><?php echo date("l, d F Y", strtotime($fechaEvento)); ?></span>
                      <span><?php echo htmlspecialchars($eventoActual->getHoraEvento()); ?></span>
                    </time>
                  </div>
                  <div class="even-info">
                    <i class="fa fa-map-marker"></i>
                    <p>Proveedor: <?php echo htmlspecialchars($eventoActual->getProveedor()); ?></p>
                  </div>
                  <a href="#">Comprar</a>
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



</body>