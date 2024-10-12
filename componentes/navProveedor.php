<div class="d-flex flex-column flex-shrink-0 p-3 bg-light full-height-sidebar" style="width: 280px;">
    <span class="fs-4">Logo</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="../paginas/sesionProveedor.php" class="nav-link active" aria-current="page">
        <span class="material-symbols-rounded">
          home
        </span>
        Inicio
      </a>
    </li>
    <li>
      <a href="../paginas/eventos.php" class="nav-link link-dark">
        <span class="material-symbols-rounded">
          local_activity
        </span>
        Eventos
      </a>
    </li>
  </ul>
  <hr>
  <div class="dropdown">
    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
      <strong>
        <?php
          echo $proveedor->getNombre();
        ?>
      </strong>
    </a>
    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
      <li><a class="dropdown-item" href="#">Profile</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="../index.php?cerrarSesion=1">Cerrar Sesion</a></li>
    </ul>
  </div>
  <?php include("footer.php")?>
</div>