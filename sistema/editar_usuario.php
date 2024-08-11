<?php 
	session_start();
	if (!isset($_SESSION['active'])) {
		session_destroy();
		header("location: ../");
	} 
   
    include('../conexion.php');

    if (!empty($_POST)) {    
    
        if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol'])            
            ) {

                $alert = "<p class='msg_error'>Todos los campos son obligatorios!</p>";
              }  

             else {

                $idUsuario  =   $_POST['idUsuario'];
                $nombre     =   $_POST['nombre'];
                $email      =   $_POST['correo'];
                $user       =   $_POST['usuario'];            
                $rol        =   $_POST['rol'];                  

                $usuario_update = mysqli_query($conn, "UPDATE usuario SET nombre = '$nombre', correo = '$email', usuario = '$user', rol = $rol WHERE idusuario = '$idUsuario'");

                mysqli_close($conn);  

                  if ($usuario_update) {
                        $alert = "<p class='msg_save'>El usuario ha sido actualizado!</p>";
                        //header('location: lista_usuario.php');
                    }  else{
                        $alert = "<p class='msg_error'>Eror al actualizar el usuario!</p>";
                    } 
                
             }
        }            
    
    
    //Mostrar los datos:
    if (empty($_GET['id'])) {
        header('location: lista_usuario.php');
    }

    $idUser = $_GET['id'];
    include('../conexion.php');
    $sql = mysqli_query($conn,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, (u.rol) as idrol, (r.rol) as rol
                             FROM usuario u
                             INNER JOIN rol r on u.rol = r.idrol 
                             WHERE idusuario = $idUser");
    mysqli_close($conn); 
    $result_sql = mysqli_num_rows($sql);

    if ($result_sql==0) {
        header('location: lista_usuario.php');
    } else {

        $option = '';
        while ( $data = mysqli_fetch_array($sql)) {

            $idUser     = $data['idusuario'];
            $nombre     = $data['nombre'];
            $correo     = $data['correo'];
            $usuario    = $data['usuario'];
            $idrol      = $data['idrol'];
            $rol        = $data['rol'];

            if ($idrol == 1) {
                 $option =   '<option value="' . $idrol . '" select>' . $rol . '</option>';                
            } else if ( $idrol == 2) {
                 $option =   '<option value="' . $idrol . '" select>' . $rol . '</option>';  
            } else if ( $idrol == 3) {
                 $option =   '<option value="' . $idrol . '" select>' . $rol . '</option>'; 
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4 text-primary">Actualizar Usuario</h3></div>
                                    <div class="card-body">
                                    <div class="alert"><?php echo isset($alert) ? $alert : '';  ?></div>
                                        <form action="" method="post">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input name="idUsuario" id="idUsuario" value="<?php echo $idUser; ?>>" type="hidden"/>
                                                        <input class="form-control" name="nombre" id="nombre" value="<?php echo $nombre ?>" type="text" placeholder="Nombre completo" />
                                                        <label for="nombre">Nombre completo</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <input class="form-control" name="correo" id="correo" value="<?php echo $correo ?>"type="email" placeholder="name@example.com" />
                                                    <label for="correo">Email address</label>       
                                                    </div>
                                                </div>
                                            </div>
                                               
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <input class="form-control" name="usuario" id="usuario" value="<?php echo $usuario ?>" type="text" placeholder="Usuario" />
                                                </div>

                                                <div class="col-md-6">
                                                     <input class="form-control" name="clave" id="clave" type="password" placeholder="Crear password" disabled />
                                                 </div>
                                            </div>
                                            <div class="mb-7" style="margin-bottom: 10px;">
                                                <label>Tipo de usuario</label>                                                            
                                            </div>                                  
                                                    <?php 
                                                    include('../conexion.php');
                                                        $query_rol = mysqli_query($conn, "SELECT * FROM rol");
                                                        $result_rol = mysqli_num_rows($query_rol);
                                                    mysqli_close($conn); 
                                                    ?>
                                                    <select name="rol" id="rol" class="form-control notItemOne">
                                                    <?php
                                                        echo $option; 
                                                    
                                                        if ($result_rol > 0) 
                                                        {                                                            
                                                            while ($rol = mysqli_fetch_array($query_rol)) { 
                                                        ?>                                                            
                                                            <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?></option>
                                                        <?php }
                                                        }
                                                    ?> 
                                                    </select>
                                            <div class="mt-4 mb-0">
                                            
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-block">Actualizar Usuario</button>
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