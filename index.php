<?php
session_start();
if (isset($_GET["cerrarSesion"])) {
  session_destroy();
}


require("logica/Categoria.php");
require("logica/Ciudad.php");
require("logica/Evento.php");
require("logica/Persona.php");
require("logica/Proveedor.php");
require("logica/Cliente.php");
require("logica/EventoZona.php");
require("logica/Zona.php");
require("logica/Ticket.php");
require("logica/Asiento.php");
require("logica/Factura.php");

$paginasSinSesion = array(
  "paginas/home.php",
  "paginas/categoriaEvento.php",
  "paginas/ciudadEvento.php",
  "paginas/eventoInfo.php",
  "paginas/Evento.php",
  "paginas/iniciarSesion.php"
);

$paginasConSesion = array(
  "paginas/comprarTicket.php",
  "paginas/crearEvento.php",
  "paginas/editEvento.php",
  "paginas/eventos.php",
  "paginas/sesionProveedor.php",
  "paginas/Factura.php"
);

$paginasPDF = array(
  "presentacion/producto/reporteProducto.php",
);

if (isset($_GET['pid']) && in_array($_GET['pid'], $paginasPDF)) {
  include($_GET['pid']);
} else {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
      .material-symbols-rounded {
        font-variation-settings:
          'FILL' 1,
          'wght' 400,
          'GRAD' 0,
          'opsz' 24
      }

      .centered-form {
        width: 50%;
        margin: 0 auto;
      }

      .full-page {
        background-color: #8A0808;
        padding: 30px;
        width: 100vw;
      }

      .nav-item a {
        color: white;
      }

      .footer {
        background-color: #8A0808;
        padding: 20px;
        color: white;
        text-align: center;
        font-size: 14px;
        margin-top: auto;

      }

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

      .col-lg-4 .p-3 {
        margin: 5px;
        width: 25vw;
        height: 31vw;
      }

      .card-custom {
        margin-top: 20px;
      }

      .card .row {
        padding: 10px;
      }

      .square {
        width: 19vw;
        height: 19vw;
      }
    </style>
  </head>

  <body>
    <?php
    if (!isset($_GET["pid"])) {
      include("paginas/home.php");
    } else {
      $pid = base64_decode($_GET['pid']);
      if (in_array($pid, $paginasSinSesion)) {
        include($pid);
      } else if (in_array($pid, $paginasConSesion)) {
        if (isset($_SESSION["id"])) {
          $idCliente = $_SESSION["id"];
          $cliente = new Cliente($idCliente);
          $cliente->consultar();
          include($pid);
        } else {
          include("paginas/iniciarSesion.php");
        }
      } else {
        echo "<h1>Error 404</h1>";
      }
    }
    ?>
  </body>

  </html>
<?php
}
?>