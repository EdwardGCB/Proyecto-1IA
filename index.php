<?php
//require ("logica/Producto.php");
require("logica/Categoria.php");
// require ("logica/Marca.php");
include("componentes/encabezado.php");
?>
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

        .col-lg-4 .p-3{
            margin: 5px;
            width: 25vw;
            height: 31vw;
        }

        .square {
            margin: 10px
            width: 15vw;
            height: 15vw;
        }

        .card .row{
           padding: 10px; 
        }
    </style>
</head>

<body>
    <?php include("componentes/navcliente.php")?>
    <br>
    <div class="container">
        <div class="row mb-3">
            <div class="col">
            <h4>Destacados</h4>
                <div class="container">
                    <div class="row">
                        <!-- columna izquierda -->
                        <div class="col-md-4">
                            <div class="col-lg-4">
                                <div class="p-3 border bg-light ">Principal Element</div>
                            </div>
                        </div>
                        <!-- columna derecha -->
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-4">
                                    <div class="p-3 border bg-light square">1</div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 border bg-light square">2</div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 border bg-light square">3</div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 border bg-light square">4</div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 border bg-light square">5</div>
                                </div>
                                <div class="col-4">
                                    <div class="p-3 border bg-light square">6</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Events -->
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h4>Eventos</h4>
                <div class="container">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <!-- First slide -->
                            <div class="carousel-item active">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-3">
                                            <a href="#"><div class="p-3 border bg-light square">Element 1</div></a>
                                        </div>
                                        <div class="col-3">
                                            <a href="#"><div class="p-3 border bg-light square">Element 2</div></a>
                                        </div>
                                        <div class="col-3">
                                            <a href="#"><div class="p-3 border bg-light square">Element 3</div></a>
                                        </div>
                                        <div class="col-3">
                                            <a href="#"><div class="p-3 border bg-light square">Element 4</div></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Second slide -->
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-3">
                                            <a href="#"><div class="p-3 border bg-light square">Element 5</div></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cities -->
    <div class="container">
    <div class="row mb-3">
        <div class="col">
            <h4>Ciudades</h4>
            <div class="container">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $ciudad = new Ciudad();
                        $ciudades = $ciudad->consultarTodos();
                        $totalCiudades = count($ciudades);
                        $ciudadesPorSlide = 4;
                        $slideIndex = 0;

                        // Loop through the cities and divide them into slides of 4
                        foreach ($ciudades as $index => $ciudadActual) {
                            // Open a new slide if needed
                            if ($index % $ciudadesPorSlide == 0) {
                                $activeClass = ($slideIndex == 0) ? 'active' : '';
                                echo "<div class='carousel-item $activeClass'>";
                                echo "<div class='container'><div class='row'>";
                                $slideIndex++;
                            }

                            // Output the city as a square element
                            echo "<div class='col-3'>";
                            echo "<a href='#'><div class='p-3 border bg-light square'>";
                            echo $ciudadActual->getNombre();
                            echo "</div></a>";
                            echo "</div>";

                            // Close the slide if we've added 4 cities
                            if (($index + 1) % $ciudadesPorSlide == 0 || ($index + 1) == $totalCiudades) {
                                echo "</div></div></div>";
                            }
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mb-3">
        <div class="col">
            <h4>Categorías</h4>
            <div class="container">
                <div class="row">
                    <?php
                    $categoria = new Categoria();
                    $categorias = $categoria->consultarCategorias(); // Obtén todas las categorías
                    $totalCategorias = count($categorias);
                    $categoriasPorColumna = 4; // Cuatro categorías por fila

                    foreach ($categorias as $index => $categoriaActual) {
                        echo "<div class='col-3'>";
                        echo "<a href='paginas/CategoriaEvento.php?idCategoria=" . $categoriaActual->getIdCategoria() . "'><div class='p-3 border bg-light square'>";
                        echo htmlspecialchars($categoriaActual->getNombre()); // Muestra el nombre de la categoría
                        echo "</div></a>";
                        echo "</div>";

                        // Cierra la fila después de cuatro categorías
                        if (($index + 1) % $categoriasPorColumna == 0) {
                            echo "</div><div class='row'>"; // Cierra la fila actual y abre una nueva
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
    <?php include("componentes/footer.php")?>
</html>