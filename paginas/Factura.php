<?php
require_once("../logica/Factura.php");
require_once("../logica/Persona.php");
require_once("../logica/Cliente.php");
require_once("../logica/Ticket.php");
require_once("../logica/Evento.php");
require_once("../logica/Proveedor.php");
require_once("../logica/Ciudad.php");
require_once("../logica/Categoria.php");
require_once("../logica/Asiento.php");
require_once("../logica/Zona.php");

include('../componentes/encabezado.php');
include('../componentes/Ticket.php');
?>


<?php
if (isset($_GET['idFactura'])) {
    $idFactura = $_GET['idFactura'];

    $factura = new Factura($idFactura, null, null, null, null);
    $facturas = $factura->consultarFacturaPorId();


$idFactura = $factura->getIdFactura();
$precioTotal = number_format($factura->getPrecioTotal(), 2);
$cantidadTotal = $factura->getCantidadTotal();
$iva = $factura->getIva() * 100;
$cliente = $factura->getCliente();

$ticket = new Ticket(null, null, null, $cliente, $factura, null);
$tickets = $ticket->consultarTicketsPorFactura(); // Obtener todos los tickets asociados a la factura

}


?>

<head>
    <title>Factura #    <?php echo htmlspecialchars($idFactura); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .invoice-info, .total, .client-info, .ticket-info {
            margin-bottom: 20px;
        }
        .invoice-info p, .client-info p, .ticket-info p {
            margin: 5px 0;
        }
        .total {
            font-size: 1.2em;
            font-weight: bold;
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #666;
        }
        .print-btn {
            display: block;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Factura #<?php echo htmlspecialchars($idFactura); ?></h1>
        </div>
        <div class="invoice-info">
            <p><strong>ID de Factura:</strong> <?php echo htmlspecialchars($idFactura); ?></p>
            <p><strong>Precio Total:</strong> $<?php echo htmlspecialchars($precioTotal); ?></p>
            <p><strong>Cantidad Total:</strong> <?php echo htmlspecialchars($cantidadTotal); ?></p>
            <p><strong>IVA:</strong> <?php echo htmlspecialchars($iva); ?>%</p>
        </div>
        <div class="client-info">
            <h2>Información del Cliente</h2>
            <p><strong>Cliente:</strong> 
                <?php echo isset($cliente) ? htmlspecialchars($cliente->getNombre() . ' ' . $cliente->getApellido()) : 'No disponible'; ?>
            </p>
            <p><strong>Contacto:</strong> 
                <?php echo isset($cliente) ? htmlspecialchars($cliente->getTelefono()) : 'No disponible'; ?>
            </p>
            <p><strong>Correo:</strong> 
                <?php echo isset($cliente) ? htmlspecialchars($cliente->getCorreo()) : 'No disponible'; ?>
            </p>
        </div>
        <div class="total">
            <p>Total a Pagar: $<?php echo htmlspecialchars($precioTotal); ?></p>
        </div>
        
        <div class="print-btn">
            <button onclick="window.print()">Imprimir Factura</button>
        </div>

        <div class="footer">
            <p>Gracias por su compra</p>
            <p>Si tiene preguntas, contáctenos al soporte@example.com</p>
        </div>
    </div>
    <br><br><br><br><br>
    <div class="container">
    <div class="ticket-info">
            <?php if (!empty($tickets)): ?>
                <?php foreach ($tickets as $ticket):
                    ?>
                    <article class="card fl-left">
                        <section class="date">
                            <time datetime="<?php echo htmlspecialchars($ticket->getIdTicket()); ?>">
                                <span><?php echo htmlspecialchars($ticket->getIdTicket()); ?></span> <!-- ID del Ticket -->
                            </time>
                        </section>
                        <section class="card-cont">
                            <h3>Propietario:</strong> <?php echo htmlspecialchars($ticket->getCliente()->getNombre()." ".$ticket->getCliente()->getApellido()); ?></p></h3>
                                
                            <div class="even-date">
                                <i class="fa fa-calendar"></i>
                                <time>
                                    <span><?php echo date(" d F Y", strtotime($ticket->getEventoZona()->getFechaEvento())); ?></span>
                                    <span><?php echo htmlspecialchars($ticket->getEventoZona()->getHoraEvento()); ?></span>
                                </time>
                            </div>
                            <div class="even-info">
                                <i class="fa fa-ticket"></i>
                                <p><strong>Asiento:</strong> <?php echo htmlspecialchars($ticket->getAsiento()->getFila() . "-" . $ticket->getAsiento()->getColumna()); ?></p>
                                <p><strong>Sitio:</strong> <?php echo htmlspecialchars($ticket->getEventoZona()->getSitio()); ?></p>
                                <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($ticket->getEventoZona()->getCiudad()->getNombre()); ?></p>
                            </div>
                            <br>
                            <p>Evento: <?php echo htmlspecialchars($ticket->getEventoZona()->getNombre()); ?></p>

                        </section>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se encontraron tickets relacionados con esta factura.</p>
            <?php endif; ?>
        </div>
    </div>
    
</body>
</html>
<script src='../componentes/Ticket.php'></script>
