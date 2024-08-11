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
            } else {            

                if ($_POST['nit'] == '') {$nit = 'C/F';} else {$nit = $_POST['nit'];}
                $nombre         = $_POST['nombre'];
                $telefono       = $_POST['telefono'];
                $direccion      = $_POST['direccion'];   
                $usuario_id     = $_SESSION['idUser'];    

                 $query = mysqli_query($conn, "SELECT * FROM cliente WHERE nit = '$nit'");            
                $result = mysqli_fetch_array($query);

                if ($result > 0) {
                        $alert = "<p class='msg_error'>El cliente ya existe!</p>";
                } else {

                    $query_insert = mysqli_query($conn, "INSERT INTO cliente (nit, nombre, telefono, direccion, usuario_id) VALUES ('$nit', '$nombre', '$telefono', '$direccion', '$usuario_id')");

                    mysqli_close($conn);

                    if ($query_insert) {
                            $alert = "<p class='msg_save'>El cliente ha sido crado!</p>";
                        }  else {
                            $alert = "<p class='msg_error'>Eror al crear el cliente!</p>";
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4 text-primary">Crear Cliente</h3></div>
                                    <div class="card-body">
                                    <div class="alert"><?php echo isset($alert) ? $alert : '';  ?></div>

                                    <form action="" method="post">
                                        
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating">
                                                    <input class="form-control" name="nit" id="nit" type="text" placeholder="Número de Identificación" />
                                                     <label for="nit"># ID</label>       
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="nombre" id="nombre" type="text" placeholder="Nombre completo" />
                                                        <label for="nombre">Nombre completo</label>
                                                    </div>
                                                </div>
                                            </div>
                                               
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <input class="form-control" name="telefono" id="telefono" type="text" placeholder="Telefono" />
                                                </div>

                                                <div class="col-md-8">
                                                     <input class="form-control" name="direccion" id="direccion" type="text" placeholder="Direccion completa" />
                                                 </div>
                                            </div>                                
                                            <div class="mt-4 mb-0">                                            
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-block">Crear Cliente</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="lista_clientes.php">! Regresar a la pagina anterior !</a></div>
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