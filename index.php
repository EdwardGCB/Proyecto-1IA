<?php
//require ("logica/Producto.php");
// require_once("logica/Categoria.php");
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
    <!-- Categories -->
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h4>Categorias</h4>
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
        </div>
    </div>
</body>
    <?php include("componentes/footer.php")?>
</html>