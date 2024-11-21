<?php
require_once("../logica/Factura.php");
require_once("../logica/Persona.php");
require_once("../logica/Cliente.php");
require_once("../logica/Ticket.php");

if (!isset($_GET['idFactura'])) {
    die("ID de factura no proporcionado.");
}

$idFactura = $_GET['idFactura'];
$factura = new Factura($idFactura);

if (!$factura->consultarFacturaPorId()) {
    die("Factura no encontrada.");
}

$idFactura = $factura->getIdFactura();
$precioTotal = number_format($factura->getPrecioTotal(), 2);
$cantidadTotal = $factura->getCantidadTotal();
$iva = $factura->getIva() * 100;
$cliente = $factura->getCliente();

// Obtenemos el id_cliente de la factura
$idCliente = $factura->getCliente()->getIdPersona();

// Crear el objeto Ticket
$ticket = new Ticket(null, null, null, $cliente, $factura, null);

// Consultar el ticket relacionado con el cliente
if ($ticket->consultarTicket()) {
    // Si se encuentra un ticket, obtenemos el valor de eventoZona desde el ticket
    $eventoZona = $ticket->getEventoZona();

    // Ahora, puedes usar $eventoZona en tu lógica si es necesario
    $idTicket = $ticket->getIdTicket();
    $valor = $ticket->getValor();
    $facturaId = $ticket->getFactura();
    $asientoId = $ticket->getAsiento();
} else {
    $ticketError = "No se encontró un ticket relacionado con esta factura.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura #<?php echo htmlspecialchars($idFactura); ?></title>
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

        <div class="ticket-info">
            <h2>Información del Ticket</h2>
            <?php if (isset($ticketError)): ?>
                <p><?php echo htmlspecialchars($ticketError); ?></p>
            <?php else: ?>
                <p><strong>ID del Ticket:</strong> <?php echo htmlspecialchars($idTicket); ?></p>
                <p><strong>Valor:</strong> $<?php echo htmlspecialchars($valor); ?></p>
                <p><strong>ID del Asiento:</strong> <?php echo htmlspecialchars($asientoId); ?></p>
                <p><strong>Evento y Zona:</strong> <?php echo htmlspecialchars($eventoZona); ?></p>
            <?php endif; ?>
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
</body>
</html>