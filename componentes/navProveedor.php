<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark full-height-sidebar" style="width: 280px;">
  <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-light text-decoration-none">
    <span class="fs-4">Logo</span>
  </a>
  <hr>
  <?php $paginaAct = basename($_SERVER['PHP_SELF'])?>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="../paginas/sesionProveedor.php"
        class="nav-link <?= $paginaAct == 'sesionProveedor.php' ? 'active' : 'link-light' ?>" aria-current="page">
        <span class="material-symbols-rounded">home</span>
        Inicio
      </a>
    </li>
    <li>
      <a href="../paginas/eventos.php" class="nav-link <?= $paginaAct == 'eventos.php' ? 'active' : 'link-light' ?>">
        <span class="material-symbols-rounded">local_activity</span>
        Eventos
      </a>
    </li>
  </ul>
  <hr>
  <div class="dropdown">
    <a href="#" class="d-flex align-items-center link-light text-decoration-none dropdown-toggle" id="dropdownUser2"
      data-bs-toggle="dropdown" aria-expanded="false">
      <strong>
        <?php echo $proveedor->getNombre(); ?>
      </strong>
    </a>
    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
      <li><a class="dropdown-item" href="#">Profile</a></li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li><a class="dropdown-item" href="/xampp/Proyecto-1IA/index.php?cerrarSesion=true">Cerrar Sesion</a></li>
    </ul>
  </div>
</div>
