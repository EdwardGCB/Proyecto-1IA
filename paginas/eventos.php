<?php
$id = $_SESSION["id"];
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["agregarEvento"])) {

  $nombre = trim($_POST["nombreEvento"]);
  $edadMinima = trim($_POST["edadMinima"]);
  $fecha = trim($_POST["fechaEvento"]);
  $hora = trim($_POST["horaEvento"]);
  $ubicacion = trim($_POST["ubicacionEvento"]);
  $ciudad = $_POST["ciudad"];
  $categoria = $_POST["categoria"];

  // Validar que los campos no estén vacíos
  if (empty($nombre) || empty($edadMinima) || empty($fecha) || empty($hora) || empty($ubicacion) || empty($ciudad) || empty($categoria)) {
    echo "Error al guardar, todos los campos deben estar llenos";
      exit();
  }

  // Guardar en la base de datos
  $evento = new Evento(null, $nombre, $edadMinima, $fecha, $hora, $ubicacion, $ciudad, $categoria);
  if($evento->agregar()){
    echo "Evento agregado con exito";
  }

}
include("componentes/estiloMenu.php");
?>

<body id="body-pd">
  <?php
  include("componentes/navProveedor.php");
  ?>
  <div class="container-sm">
    <div class="container mt-3">
      <div class="container-fluid">
        <h2>Mis eventos</h2>
      </div>
      <div class="event-container" id="eventContainer">
        <div class="d-flex">
          <input class="form-control me-2" id="search" name="inputBuscar" placeholder="Buscar" aria-label="Buscar">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="modal">
            <span class="material-symbols-rounded">add</span>
          </button>
        </div>
        <br>
        <div class="container" id="datatable">
        </div>
      </div>
    </div>
  </div>

  <?php include "componentes/agregarEvento.php"; ?>
  <script>
    function cargarEventos(pagina = 1, filtro = '') {
      $.ajax({
        url: 'indexAjax.php',
        type: 'GET',
        data: {
          pid: '<?= base64_encode("ajax/tablaAjax.php") ?>',
          pagina: pagina,
          filtro: filtro,
          id: <?= $id ?>
        },
        success: function(response) {
          $('#datatable').html(response);
        }
      });
    }
    $(document).ready(function() {

      cargarEventos(1, '<?php echo $_GET['filtro'] ?? ""; ?>');
      $("#modal").on('click', function() {
        console.log("clickable");
      });
      $("#search").keyup(function() {
        const filtro = $('#search').val();
        if (filtro.length >= 3 || filtro.length == 0) {
          let pagina = $(this).data('pagina');
          cargarEventos(pagina, filtro);
        }
      });
      $('#modal').on("click", function() {
        url = "indexAjax.php?pid=<?= base64_encode("ajax/crearEvento.php"); ?>";
        console.log(url);
        $("#eventContainer").load(url);
      });
    });
    $(document).on('click', '.page-link', function(e) {
      e.preventDefault(); // Evita que el enlace recargue la página

      let pagina = $(this).data('pagina'); // Obtiene la página desde el atributo data
      const filtro = $('#search').val();

      if (!$(this).parent().hasClass('disabled')) {
        cargarEventos(pagina, filtro);
      }
    });
  </script>
</body>