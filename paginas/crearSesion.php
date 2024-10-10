<?php
session_start();
require('../logica/Persona.php');
require('../logica/Cliente.php');

$error=null;
if(isset($_POST["insertar"])){
  if(empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["cc"]) || empty($_POST["correo"]) || empty($_POST["telefono"]) || empty($_POST["clave0"]) || empty($_POST["clave1"])){
    $error = "Todos los campos son obligatorios";
  }else{
    $nombre = $_POST["nombre"]; 
    $apellido = $_POST["apellido"];
    $cc_nit = $_POST["cc"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $clave = md5($_POST["clave0"]);
    $clave2 = md5($_POST["clave1"]);
    echo "Telefono: ".$telefono;
    echo "Clave1: ".$clave;
    echo "Clave2: ".$clave2;
    $cliente = new Cliente(0, $nombre, $apellido,$correo, $telefono, $clave, $cc_nit);
    if( hash_equals($clave,$clave2 )){
      if($cliente -> autenticarCorreo()){
        $cliente -> insertar();
        $_SESSION["id"] = $cliente -> getIdPersona();
        echo $_SESSION["id"];
        //header("Location: index.php");
      }else{
        $error = "El correo digitado ya existe";
      }
    }else{
      $error = "Las contraseñas no coinciden";
    }
  }
}

include("../componentes/encabezado.php");
?>
<style>

.material-symbols-rounded {
  font-variation-settings:
  'FILL' 1,
  'wght' 400,
  'GRAD' 0,
  'opsz' 24;
}

</style>
</head>
<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Crear Sesion</h1>
							<form method="post" action="crearSesion.php" class="needs-validation" novalidate="" autocomplete="off">
                <?php if(isset($error)){ ?>
                  <div class="alert alert-danger mt-3" role="alert">
                    <?php echo $error?>
							    </div> 
							  <?php } ?>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="mb-2 text-muted" for="nombre">Nombre</label>
                      <input name="nombre" type="text" class="form-control" value="" required autofocus>
                    </div>
                  </div>
                  <div class="col">
                    <div class="mb-3">
                      <label class="mb-2 text-muted" for="email">Apellido</label>
                      <input name="apellido" type="text" class="form-control" value="" required autofocus>
                    </div>
                  </div>
                </div>
                <div class="mb-4">
									<label class="mb-2 text-muted" for="cc">Cedula Ciudadania</label>
									<input name="cc" type="text" class="form-control" value="" required autofocus>
								</div>
								<div class="mb-4">
									<label class="mb-2 text-muted" for="correo">Correo Electrónico</label>
									<input name="correo" type="email" class="form-control" value="" required autofocus>
								</div>
                <div class="mb-3">
                  <label class="mb-2 text-muted" for="telefono">Numero Telefonico</label>
                  <input name="telefono" type="text" class="form-control" value="" required autofocus>
                </div>
            
                <?php for ($i=0; $i < 2; $i++): ?>
                  <div class="mb-3">
                    <div class="mb-2 w-100">
                      <label class="text-muted" for="clave<?php echo $i?>">
                        <?php echo $i==0? "Contraseña": "Confirmar Contraseña";?>
                      </label>
                    </div>
                    <input name="clave<?php echo $i?>" type="password" class="form-control" required>
                    <button class="btn bg-white text-muted">
                      <span class="material-symbols-rounded">visibility</span>
                    </button>
                  </div>
                <?php endfor?>
                <div class="d-grid gap-2 mb-3">
                  <button name="insertar" type="submit" class="btn btn-primary max-width">
                    Crear Usuario
                  </button>
                </div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								ya tienes una cuenta? <a href="iniciarSesion.php" class="text-dark">Ingrear</a>
							</div>
						</div>
					</div>
					<div class="text-center mt-5 text-muted">
						Copyright &copy; 2024 &mdash; Ticketera.co 
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>