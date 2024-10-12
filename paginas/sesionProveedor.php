<?php
session_start();
if(!isset($_SESSION["id"])){

}
$id = $_SESSION["id"];
require ("../logica/Persona.php");
require ("../logica/Proveedor.php");
$proveedor = new Proveedor($id);
$proveedor -> consultar();
include "../componentes/encabezado.php";
?>
    .full-height-sidebar {
      height: 100vh;
    }
  </style>
<body>
  <?php
    include "../componentes/navProveedor.php";
  ?>
</body>
</html>
