<?php
session_start();
require ("../logica/Persona.php");
require ("../logica/Proveedor.php");
require ("../logica/Cliente.php");
$error = false;

if(isset($_POST["autenticar"])){
  $correo = $_POST["email"];
  $clave = md5($_POST["password"]);
    $proveedor = new Proveedor(null, null, null, $correo, null,$clave);
    if($proveedor -> autenticar()){
			session_start();

        $_SESSION["id"] = $proveedor -> getIdPersona();
        header("Location: sesionProveedor.php");     
    }else{
			$cliente = new Cliente(null,null,null, $correo, null, $clave);
			if($cliente -> autenticar()){
				session_start();

				$_SESSION["id"] = $cliente -> getIdPersona();
        header("Location: ../index.php");
			}else{
				$error = true;
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
							<h1 class="fs-4 card-title fw-bold mb-4">Inicio Sesion</h1>
							<form method="post" action="iniciarSesion.php" class="needs-validation" novalidate="" autocomplete="off">
              <?php if($error){ ?>
                <div class="alert alert-danger mt-3" role="alert">
                Error de correo o clave
							  </div>    
							<?php } ?>
								<div class="mb-3">
									<label class="mb-3 text-muted" for="email">Correo Electrónico</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
								</div>

								<div class="mb-4">
									<div class="mb-2 w-100">
										<label class="text-muted" for="password">Contraseña</label>
									</div>
									<input id="password" type="password" class="form-control" name="password" required>
                  <button class="btn bg-white text-muted">
                    <span class="material-symbols-rounded">visibility</span>
                  </button>
								</div>

								<div class="d-grid gap-2">
									<button type="submit" name="autenticar" class="btn btn-primary max-width">
										Iniciar Sesion
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								No tienes una cuenta? <a href="crearSesion.php" class="text-dark">Crea una</a>
							</div>
						</div>
					</div>
					<?php include("../componentes/footer.php") ?>
				</div>
			</div>
		</div>
	</section>
</body>
</html>