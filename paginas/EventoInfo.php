<?php
require("../logica/Categoria.php");
require("../logica/Ciudad.php");
require("../logica/Evento.php");
require("../logica/Persona.php");
require("../logica/Proveedor.php");
include("../componentes/encabezado.php");

// Verificar si se ha pasado el idEvento en la URL
if (isset($_GET['idEvento'])) {
    $idEvento = $_GET['idEvento'];

    // Crear una instancia de Evento con el idEvento y obtener los detalles del evento
    $evento = new Evento($idEvento);
    $evento = $evento->consultaIndividual(); // Esto debería cargar todos los datos del evento

    // Verificar si el evento fue encontrado
    if ($evento !== null) {
        // El evento fue encontrado, continúa con la lógica para mostrar los detalles
    } else {
        echo "<p>Evento no encontrado</p>";
        exit;
    }
} else {
    echo "<p>Evento no especificado.</p>";
    exit;
}
?>


    <style>
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

        /* Table and form styling to match the mockup */
        .container {
            max-width: 1200px;
            margin: auto;
        }

        .seat-reservation table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .seat-reservation th, .seat-reservation td {
            padding: 10px;
            text-align: left;
        }

        .seat-reservation th {
            background-color: #f4f4f4;
        }

        .payment {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .payment h3 {
            font-size: 24px;
        }

        .payment p {
            font-size: 24px;
        }

        .payment button {
            background-color: #f39c12;
            border: none;
            padding: 10px 20px;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
    </head>

    <body>

    <!-- Include the navigation bar component -->
    <?php include("../componentes/navcliente.php")?>
    <br>

    <!-- Event details section -->
    <main class="container">
        <section class="event-details">
        <h1><?php echo $evento->getNombre(); ?></h1>
        <p><?php echo "Fecha: " . $evento->getFechaEvento() . ", Hora: " . $evento->getHoraEvento() . ", Lugar: " . $evento->getSitio() . ", Ciudad: " . $evento->getCiudad()->getNombre(); ?></p>
        <p>Promotor: <?php echo $evento->getProveedor()->getNombre(); ?></p>
        </section>

        <!-- Seat reservation table -->
        <section class="seat-reservation">
        <h2>Reserva de asientos automáticos</h2>
        <table border="1">
            <thead>
            <tr>
                <th>Categoría de asiento</th>
                <th>Preferencia (*)</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><span style="color: green;">● TRIBUNA FAN SUR</span> - Agotado</td>
                <td>Automático</td>
                <td>0</td>
                <td>$287,500</td>
                <td>$0</td>
                <td><button>Inscribirme en la lista de espera</button></td>
            </tr>
            <tr>
                <td><span style="color: blue;">● PLATEA</span></td>
                <td>
                <select>
                    <option>Automático</option>
                    <option>Manual</option>
                </select>
                </td>
                <td>
                <input type="number" min="0" max="10" value="0">
                </td>
                <td>$345,000</td>
                <td>$0</td>
                <td><button>Inscribirme en la lista de espera</button></td>
            </tr>
            <!-- Additional seat categories -->
            </tbody>
        </table>
        </section>

        <!-- Payment section -->
        <section class="payment">
        <h3>Total</h3>
        <p>$0</p>
        <button>Pagar</button>
        </section>
    </main>

    <!-- Include the footer component -->
    <?php include("../componentes/footer.php"); ?>
    </body>
    </html>
