<?php
// require ("logica/Producto.php");
require("logica/Categoria.php");
// require ("logica/Marca.php");
?>
<html>

<head>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    <style>
        .header-container {
            background-color: #922b21;
            padding: 20px;
            width: 100vw;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #922b21;
            padding: 20px;
            color: white;
            text-align: center;
            font-size: 14px;
            margin-top: auto;
            
        }
    </style>

</head>

<body>
    <div class="container header-container">
        <div class="row">
            <div class="col text-center mt-2">
                <img src="img/logo.png" height="150" />
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="img/logo2.png" width="50" /></a>
            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
                            href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Marca</a>
                        <ul class="dropdown-menu">
                            <?php
                            // $marca = new Marca();
                            // $marcas = $marca -> consultarTodos();
                            // foreach ($marcas as $marcaActual) {
                            //     echo "<li><a class='dropdown-item' href='#'>" . $marcaActual -> getNombre() . "</a></li>"; 
                            // }
                            ?>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
                            href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Categoria</a>
                        <ul class="dropdown-menu">
                            <?php
                            // $categoria = new Categoria();
                            // $categorias = $categoria -> consultarTodos();
                            // foreach ($categorias as $categoriaActual) {
                            //     echo "<li><a class='dropdown-item' href='#'>" . $categoriaActual -> getNombre() . "</a></li>"; 
                            // }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <div class="card border-primary">
                    <div class="card-header text-bg-info">Tienda Anonima</div>
                    <div class="card-body">
                        <?php
                        // $i=0;
                        // $producto = new Producto();
                        // $productos = $producto->consultarTodos();
                        // foreach ($productos as $productoActual) {
                        //     if($i%4 == 0){
                        //         echo "<div class='row mb-3'>";
                        //     }
                        //     echo "<div class='col-lg-3 col-md-4 col-sm-6' >";
                        //     echo "<div class='card text-bg-light'>";
                        //     echo "<div class='card-body'>";
                        //     echo "<div class='text-center'><img src='https://icons.iconarchive.com/icons/custom-icon-design/mono-general-1/256/faq-icon.png' width='70%' /></div>";
                        //     echo "<a href='#'>" . $productoActual->getNombre() . "</a><br>";
                        //     echo "Cantidad: " . $productoActual->getCantidad() . "<br>";
                        //     echo "Valor: $" . $productoActual->getPrecioVenta();
                        //     echo "</div>";
                        //     echo "</div>";
                        //     echo "</div>";

                        //     if($i%4 == 3){
                        //         echo "</div>";
                        //     }
                        //     $i++;
                        // }
                        // if($i%4 != 0){
                        //     echo "</div>";
                        // }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1>Contenido</h1>
        <p>Esto es el contenido de la página...</p>
        <p>Esto es el contenido de la página...</p>
        <p>Esto es el contenido de la página...</p>
        <p>Esto es el contenido de la página...</p>
        <p>Esto es el contenido de la página...</p>
        <p>Esto es el contenido de la página...</p>

    </div>
    </div>
    </div>
</body>
<footer class="footer">
    <div class="container">
        <p>Todos los derechos reservados &copy; 2023</p>
    </div>
</footer>



</html>