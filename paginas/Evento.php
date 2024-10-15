<?php
require_once(dirname(__DIR__) . '/componentes/navcliente.php');
require_once(dirname(__DIR__) . '/componentes/encabezado.php');
require_once(dirname(__DIR__) . '/logica/Evento.php');
require_once(dirname(__DIR__) . '/logica/EventoZona.php');
require_once(dirname(__DIR__) . '/logica/Zona.php');
require_once(dirname(__DIR__) . '/persistencia/Conexion.php');
require_once(dirname(__DIR__) . '/persistencia/EventoDAO.php');
require_once(dirname(__DIR__) . '/persistencia/EventoZonaDAO.php');
?>

<style>
    /* Fondo para la tabla */
    .table-reservas {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Personalizar el encabezado de la tabla */
    #reservaAsientosTable thead th {
        background-color: #343a40;
        color: #fff;
        text-align: center;
    }

    /* Estilos para las celdas de la tabla */
    #reservaAsientosTable tbody td {
        vertical-align: middle;
        text-align: center;
    }

    /* Estilo para el botón de emitir ticket */
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    /* Efecto hover en las filas */
    #reservaAsientosTable tbody tr:hover {
        background-color: #e9ecef;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
        }

        /* Header (navcliente) */
        header {
            background-color: #800000;
            padding: 10px 0;
        }
        .navbar-brand {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
        .navbar-nav .nav-link {
            color: white;
        }
        .navbar-nav .nav-link:hover {
            color: #ddd;
        }
        .btn-login {
            background-color: white;
            color: #800000;
            border: 1px solid #800000;
        }
        .btn-login:hover {
            background-color: #800000;
            color: white;
        }

        /* Contenedor del evento */
        .evento-container {
            padding: 40px;
            background-color: #f5f5f5;
        }

        .evento-title {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .evento-info {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .evento-descripcion {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
        }

        .evento-imagen {
            width: 100%;
            max-width: 750px;
            height: auto;
            background-color: #ccc;
            margin-bottom: 30px;
        }

        /* Estilo de las tablas para reserva de asientos */
        .table-reservas {
            width: 100%;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        .agotado {
            color: red;
            font-weight: bold;
        }

        .disponible {
            color: green;
            font-weight: bold;
        }

        /* Footer */
        footer {
            background-color: #555;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>

<?php

if (isset($_GET['idEvento'])) {
    $idEvento = $_GET['idEvento'];

    $eventoDAO = new Evento(); 
    $evento = $eventoDAO->consultarEvento($idEvento);

    if ($evento) {
        $eventoZona = new EventoZona();
        $zonas = $eventoZona->consultarPorZona($idEvento);
    } else {
        echo "<p>No se encontró el evento.</p>";
        exit;
    }
} else {
    echo "<p>No se ha proporcionado un ID de evento.</p>";
    exit;
}
?>

<body>

    <!-- Contenido principal -->
    <div class="evento-container container">
        <div class="row">
            <!-- Información del evento -->
            <div class="col-md-8">
                <h1 class="evento-title"><?php echo htmlspecialchars($evento->getNombre()); ?></h1>
                <p class="evento-info">
                    <?php
                    // Formatear fecha y hora del evento
                    $fechaEvento = new DateTime($evento->getFechaEvento());
                    echo htmlspecialchars($fechaEvento->format('l, d F Y')) . " a las " . htmlspecialchars($evento->getHoraEvento());
                    ?>
                    <br>
                    <strong>Lugar:</strong> <?php echo htmlspecialchars($evento->getSitio()); ?><br>
                    <strong>Ciudad:</strong> <?php echo htmlspecialchars($evento->getCiudad()); ?><br>
                    <strong>Edad Mínima:</strong> <?php echo htmlspecialchars($evento->getEdadMinima()); ?> años<br>
                    <strong>Promotor:</strong> <?php echo htmlspecialchars($evento->getProveedor()); ?>
                </p>    
            </div>
            <!-- Imagen del evento -->
            <div class="col-md-4">
                <?php
                // Verificar si existe un logo o flayer para mostrar
                if (!empty($evento->getFlayer())) {
                    echo '<img src="' . htmlspecialchars($evento->getFlayer()) . '" class="evento-imagen" alt="Imagen del evento">';
                } else {
                    echo '<img src="default_event_image.jpg" class="evento-imagen" alt="Imagen predeterminada del evento">';
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="emitir_ticket.php" method="POST">
                    <div class="table-reservas">
                        <h3 class="text-center mb-4">Reserva de Asientos</h3>
                        <table id="reservaAsientosTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Zona</th>
                                    <th>Evento</th>
                                    <th>Aforo</th>
                                    <th>Valor</th>
                                    <th>Disponibilidad</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($zonas as $zona): ?>
                                    <tr>
                                        <td><?php echo $zona->getZona(); // Nombre de la zona ?></td>
                                        <td><?php echo $zona->getEvento(); // Nombre del evento ?></td>
                                        <td><?php echo $zona->getAforo(); // Aforo ?></td>
                                        <td>$<?php echo number_format($zona->getValor(), 2); // Valor del asiento ?></td>
                                        <td><?php echo $zona->getDisponibles(); // Asientos disponibles ?></td>
                                        <td>
                                            <!-- Botón para reservar o emitir ticket -->
                                            <button type="submit" class="btn btn-primary" name="emitirTicket" value="<?php echo $zona->getZona(); ?>">Emitir Ticket</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>

    </div>

</body>

<?php require_once(dirname(__DIR__) . '/componentes/footer.php');?>

