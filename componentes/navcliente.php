<style>
  .categoria {
    background: transparent;
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
    padding: 8px 15px;
    transition: color 0.3s ease-in-out;
  }

  .categoria:hover {
    color: #f0f0f0; 
  }

  .navbar .btn-transparent {
    background: transparent;
    border: none;
    color: inherit;
    font-size: 16px;
    padding: 8px 15px;
    transition: color 0.3s ease-in-out;
  }

  .navbar .btn-transparent:hover {
    color: #f0f0f0;
  }
</style>

<?php
$categoria = new Categoria();
$categorias = $categoria->consultarCategorias();
?>
<div class="container-fluid full-page">
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="img/logo2.png" alt="Logo" width="80"
          class="d-inline-block align-text-top">
        Ticketera.co
      </a>
      <div class="collapse navbar-collapse position-absolute top-50 start-50 translate-middle" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Inicio</a>
          </li>

          <?php
          foreach ($categorias as $categoriaActual) {
            $nombre = $categoriaActual->getNombre();
            $pos = strpos($nombre, ' ');
            if ($pos !== false) {
              $substring = substr($nombre, 0, $pos);
            } else {
              $substring = $nombre; // In case there's no space, show the whole string
            }
            echo "
            <li class='nav-item'>
              <button class='categoria' data-id=" . $categoriaActual->getIdCategoria() . ">" . $substring . "</button>
            </li>";
          } ?>
        </ul>
      </div>
      <?php
      if (isset($_SESSION['id'])) {
        $cliente = new Cliente($_SESSION['id']);
        $cliente->consultar();
      ?>
        <ul class="navbar-nav">
          <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"><?php echo $cliente->getNombre() . " " . $cliente->getApellido() ?></a>
            <ul class="dropdown-menu">
              <li><a class='dropdown-item' href='/xampp/Proyecto-1IA/index.php?cerrarSesion=true'>Cerrar Sesion</a></li>
            </ul>
          </li>
        </ul>
      <?php
      } else {
      ?>
        <a href="/xampp/Proyecto-1IA/?pid=<?= base64_encode("paginas/iniciarSesion.php") ?>" class="btn bg-white text-muted ">
          <span class="material-symbols-rounded">person</span>
          <span>Iniciar Sesion</span>
        </a>
      <?php
      }
      ?>

    </div>
  </nav>
  <?php
  if (!isset($_GET["pid"])) {
  ?>
    <div class="container-fluid">
      <div class="centered-form">
        <form class="d-flex" role="search">
          <input id="search" class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
        </form>
      </div>
    </div>
  <?php
  }
  ?>

</div>