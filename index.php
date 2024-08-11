<?php 	    
    require('conexion.php');
	session_start();
	if (!empty($_SESSION['active'])) {
		header("location: sistema/");
	} else {
		if($_SERVER['REQUEST_METHOD'] == "POST") {

			if (empty($_POST['usuario']) || empty($_POST['clave'])) {
				$alert = "Todos los campos son obligatorios!";
			} else {
				$user = $_POST['usuario'];
				$pass = md5($_POST['clave']);                       
               
				$query = mysqli_query($conn, "SELECT *  from usuario where usuario = '$user' and clave = '$pass'");
                mysqli_close($conn);
				$consult = mysqli_num_rows($query);
	
				if($consult>0) {
					$data = mysqli_fetch_assoc($query);
					$_SESSION['active'] 	= true;
					$_SESSION['idUser']	    = $data['idusuario'];
					$_SESSION['nombre'] 	= $data['nombre'];
					$_SESSION['correo'] 	= $data['correo'];
					$_SESSION['usuario'] 	= $data['usuario'];
					$_SESSION['clave'] 		= $data['clave'];
					$_SESSION['rol'] 		= $data['rol'];	
					
					header("location: sistema/");
	
				} else {
					$alert = "Usuario o contraseña incorrectos!";
					session_destroy();
				}
			}	
		} // End REQUEST_METHOD.
	  }		
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="sistema/css/styles.css" rel="stylesheet" />       
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="usuario" id="usuario" type="text" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address o Usuario</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="clave" id="clave" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <input type="submit" value="Login" class="btn btn-primary">                                                
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
