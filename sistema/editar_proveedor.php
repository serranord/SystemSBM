<?php 
	session_start();
	if (!isset($_SESSION['active'])) {
		session_destroy();
		header("location: ../");
	} 
   
    include('../conexion.php');

    if (!empty($_POST)) {    
    
        if (empty($_POST['rnc']) || empty($_POST['proveedor']) || empty($_POST['contacto']))            
             {
                $alert = "<p class='msg_error'>Todos los campos son obligatorios!</p>" .  $_POST['contacto'];   
            } 

             else {

                $idProveedor    =   $_POST['idProveedor'];
                $rnc            =   $_POST['rnc'];
                $proveedor      =   $_POST['proveedor'];
                $contacto       =   $_POST['contacto'];
                $telefono       =   $_POST['telefono'];
                $direccion      =   $_POST['direccion'];  
                             

                $cliente_update = mysqli_query($conn, "UPDATE proveedor SET rnc = '$rnc', proveedor = '$proveedor', contacto = '$contacto', telefono = '$telefono', direccion = '$direccion' WHERE codproveedor = '$idProveedor'");

                //mysqli_close($conn);  

                  if ($cliente_update) {
                        $alert = "<p class='msg_save'>El proveedor ha sido actualizado!</p>";                
                    }  else {
                        $alert = "<p class='msg_error'>Error al actualizar el proveedor!</p>";
                    } 
                
             }
        }          
        
    //Mostrar los datos:
    if (empty($_GET['id'])) {
        header('location: lista_proveedor.php');
    }
    
    $idProveedor = $_GET['id'];
    include('../conexion.php');
    $sql = mysqli_query($conn,"SELECT * FROM proveedor WHERE codproveedor = $idProveedor");
    
    mysqli_close($conn); 
    $result_sql = mysqli_num_rows($sql);
    
    if ($result_sql==0) {
        header('location: lista_proveedor.php');
    } else {   
        
        while ( $dataProveedor = mysqli_fetch_array($sql)) {             
            $rnc        = $dataProveedor['rnc'];            
            $proveedor  = $dataProveedor['proveedor'];            
            $contacto   = $dataProveedor['contacto'];  
            $telefono   = $dataProveedor['telefono'];           
            $direccion  = $dataProveedor['direccion'];      
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4 text-primary">Actualizar Proveedor</h3></div>
                                    <div class="card-body">
                                    <div class="alert"><?php echo isset($alert) ? $alert : '';  ?></div>
                                        <form action="" method="post">

                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input name="idProveedor" id="idProveedor" value="<?php echo $idProveedor; ?>" type="hidden"/>
                                                        <input class="form-control" name="rnc" id="rnc" value="<?php echo $rnc; ?>" type="text" placeholder="Rnc Proveedor" />
                                                        <label for="contacto">RNC Proveedor</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-floating">
                                                    <input class="form-control" name="proveedor" id="proveedor" value="<?php echo $proveedor; ?>" type="text" placeholder="Nombre del Proveedor" />
                                                     <label for="proveedor">Proveedor</label>       
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="row mb-3">                                         
                                                <div class="col-md-7">
                                                        <input class="form-control" name="contacto" id="contacto" value="<?php echo $contacto; ?>" type="text" placeholder="Nombre completo del contacto" />
                                                </div>
                                                <div class="col-md-5">
                                                        <input class="form-control" name="telefono" value="<?php echo $telefono; ?>" id="telefono" type="text" placeholder="Telefono" />
                                                </div>
                                            </div>
                                               
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                     <input class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>" type="text" placeholder="Direccion completa" />
                                                 </div>
                                            </div>                                
                                            <div class="mt-4 mb-0">                                            
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-block">Actualizar Proveedor</button>
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