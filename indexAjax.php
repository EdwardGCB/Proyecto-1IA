<?php
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

$pid = base64_decode($_GET["pid"]);
include($pid);
?>