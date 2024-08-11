<?php 
	session_start();
	if (!isset($_SESSION['active'])) {
		session_destroy();
        header("location: ../");
	} 
   
    include('../conexion.php');

    if (!empty($_POST)) {
    
        if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol'])            
            ){             

            $alert = "<p class='msg_error'>Todos los campos son obligatorios!</p>";              
            } else {            

                $nombre  = $_POST['nombre'];
                $email   = $_POST['correo'];
                $user    = $_POST['usuario'];
                $clave   = md5($_POST['clave']);
                $rol     = $_POST['rol'];          

                $query = mysqli_query($conn, "SELECT * FROM usuario WHERE correo = '$email' or usuario = '$user'");            
                $result = mysqli_fetch_array($query);

                if ($result>0) {
                        $alert = "<p class='msg_error'>El usuario o correo ya existe!</p>";
                } else {

                    $query_insert = mysqli_query($conn, "INSERT INTO usuario(nombre, correo, usuario, clave,rol) VALUES ('$nombre', '$email', '$user', '$clave', '$rol')");
                    mysqli_close($conn);
                    if ($query_insert) {
                            $alert = "<p class='msg_save'>El usuario ha sido crado!</p>";
                        }  else{
                            $alert = "<p class='msg_error'>Eror al crear el usuario!</p>";
                        } 
                }
            }  
        }        
    ?>
<!DOCTYPE html>
<html lang="en">
<?php include('includes/header.php') ?>
    <body class="sb-nav-fixed">
     <?php include('includes/nabvar.php') ?>   
        <div id="layoutSidenav">
            <?php include('includes/sidebar.php') ?> 
            <!--Content.php--> 
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4"><!--contenido....--> 
                        <div class="row justify-content-center">
                            <div class="col-lg-6" style="margin-bottom: 25px;">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4 text-primary">Crear Usuario</h3></div>
                                    <div class="card-body">
                                    <div class="alert"><?php echo isset($alert) ? $alert : '';  ?></div>
                                        <form action="" method="post">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="nombre" id="nombre" type="text" placeholder="Nombre completo" />
                                                        <label for="nombre">Nombre completo</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <input class="form-control" name="correo" id="correo" type="email" placeholder="name@example.com" />
                                                    <label for="correo">Email address</label>       
                                                    </div>
                                                </div>
                                            </div>
                                               
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <input class="form-control" name="usuario" id="usuario" type="text" placeholder="Usuario" />
                                                </div>

                                                <div class="col-md-6">
                                                     <input class="form-control" name="clave" id="clave" type="password" placeholder="Crear password" />
                                                 </div>
                                            </div>
                                            <div class="mb-7" style="margin-bottom: 10px;">
                                                <label>Tipo de usuario</label>                                                            
                                            </div>                                  
                                                    <?php 
                                                        include('../conexion.php');
                                                        $query_rol = mysqli_query($conn, "SELECT * FROM rol");
                                                        $result_rol = mysqli_num_rows($query_rol);
                                                    ?>
                                                    <select name="rol" id="rol" class="form-control">
                                                    <?php
                                                    
                                                        if ($result_rol > 0) 
                                                        {                                                            
                                                            while ($rol = mysqli_fetch_array($query_rol)) { 
                                                        ?>                                                            
                                                            <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?></option>
                                                        <?php }
                                                        }
                                                        mysqli_close($conn);
                                                    ?> 
                                                    </select>
                                            <div class="mt-4 mb-0">
                                            
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-block">Crear Usuario</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.html">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>                    

                    </div>
                </main>
                <?php include('includes/footer.php')?>
            </div>
        </div>           
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
