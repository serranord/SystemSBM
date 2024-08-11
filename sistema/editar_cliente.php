<?php 
	session_start();
	if (!isset($_SESSION['active'])) {
		session_destroy();
		header("location: ../");
	} 
   
    include('../conexion.php');

    if (!empty($_POST)) {    
    
        if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion']))            
             {
                $alert = "<p class='msg_error'>Todos los campos son obligatorios!</p>";
              }  

             else {

                $idCliente  =   $_POST['idCliente'];
                $nit        =   $_POST['nit'];
                $nombre     =   $_POST['nombre'];
                $telefono   =   $_POST['telefono'];
                $direccion  =   $_POST['direccion'];                                

                $cliente_update = mysqli_query($conn, "UPDATE cliente SET nit = '$nit', nombre = '$nombre', telefono = '$telefono', direccion = '$direccion' WHERE idcliente = '$idCliente'");

                //mysqli_close($conn);  

                  if ($cliente_update) {
                        $alert = "<p class='msg_save'>El cliente ha sido actualizado!</p>";                
                    }  else{
                        $alert = "<p class='msg_error'>Error al actualizar el cliente!</p>";
                    } 
                
             }
        }          
        
    //Mostrar los datos:
    if (empty($_GET['id'])) {
        header('location: lista_cliente.php');
    }
    
    $idCliente= $_GET['id'];
    include('../conexion.php');
    $sql = mysqli_query($conn,"SELECT * FROM cliente WHERE idcliente = $idCliente");
    mysqli_close($conn); 
    $result_sql = mysqli_num_rows($sql);

    if ($result_sql==0) {
        header('location: lista_cliente.php');
    } else {   
        
        while ( $dataCliente = mysqli_fetch_array($sql)) {             
            $nit        = $dataCliente['nit'];            
            $nombre     = $dataCliente['nombre'];            
            $telefono   = $dataCliente['telefono'];            
            $direccion  = $dataCliente['direccion'];      
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4 text-primary">Actualizar Cliente</h3></div>
                                    <div class="card-body">
                                    <div class="alert"><?php echo isset($alert) ? $alert : '';  ?></div>
                                        <form action="" method="post">
                                            <div class="row mb-3">
                                            <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input name="idCliente" id="idCliente" value="<?php echo $idCliente; ?>>" type="hidden"/>
                                                        <input class="form-control" name="nit" id="nit" value="<?php echo $nit ?>" type="text" placeholder="Cédula / Pasaporte" />
                                                        <label for="nombre">Cédula / Pasaporte</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="nombre" id="nombre" value="<?php echo $nombre ?>" type="text" placeholder="Nombre completo" />
                                                        <label for="nombre">Nombre completo</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <input class="form-control" name="telefono" id="telefono" value="<?php echo $telefono ?>"type="text" placeholder="Telefono" />
                                                    <label for="telefono">Telefono</label>       
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                    <input class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>"type="text" placeholder="direccion" />
                                                    <label for="direccion">direccion</label>       
                                                    </div>
                                                </div>
                                            </div>      
                                            <div class="mt-4 mb-0">                                            
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-block">Actualizar Cliente</button>
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