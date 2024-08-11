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
            <div id="layoutSidenav_content" style="background:#ededed;">
                <main>
                    <div class="container-fluid px-4"><!--contenido....--> 
                        <h2 class="mt-4" style="text-align: center; margin-bottom:25px;">Registro usuario</h2>
                        
                        <div id="content-form" style="width: 55%; border: 2px solid #d1d1d1; margin:auto; padding: 20px;">                           
                                                                                   
                           <form action="" method="post">
                                    <div class="alert"><?php echo isset($alert) ? $alert : '';  ?></div>
                                    <div class="form-group col-md-12" style="margin-bottom: 20px;">
                                        <label for="nombre">Nombre Completo</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre Completo">
                                    </div>
                                    <div class="form-group col-md-12" style="margin-bottom: 20px;">
                                        <label for="inputEmail4">Email</label>
                                        <input type="email" class="form-control" name="correo" id="correo" placeholder="Email">
                                    </div>                               
                                    
                                    <div class="row">                                       
                                        <div class="form-group col-md-6" style="margin-bottom: 20px;">
                                            <label for="usuario">Usuario1</label>
                                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario1">
                                        </div>
                                    
                                        <div class="form-group col-md-6" style="margin-bottom: 20px;">
                                            <label for="clave">Password</label>
                                            <input type="text" class="form-control" name="clave" id="clave" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputState">Tipo de Usuario</label>
                                        <?php 
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
                                        ?> 
                                        </select>
                                    </div>                               

                                <button type="submit" class="btn btn-primary">Crear Usuario</button>
                            </form>
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
