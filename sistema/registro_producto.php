<?php 
	session_start();
	if (!isset($_SESSION['active'])) {
		session_destroy();
        header("location: ../");
	}

    include('../conexion.php');

    if (!empty($_POST)) {       
    
        if (empty($_POST['proveedor']) || empty($_POST['producto']) || empty($_POST['precio']) || empty($_POST['cantidad'])) 
            {
                $alert = "<p class='msg_error'>Todos los campos son obligatorios!</p>";              
            } else {                           
                                              
                $proveedor      = $_POST['proveedor'];
                $producto       = $_POST['producto'];
                $precio         = $_POST['precio'];
                $cantidad       = $_POST['cantidad'];   
                $usuario_id     = $_SESSION['idUser'];   
                
                $foto           = $_FILES['foto'];
                $nombre_foto    = $foto['name'];

                $type           = $foto['type'];
                $url_temp       = $foto['tmp_name'];
                $img_producto   = 'img_producto.png';               
                
                if ($nombre_foto != '') {
                    $destino         = 'img/uploads/'; //save deteny with off name photo
                    $img_nombre      = 'img_' .  md5(date('d-m-Y H:m:s')); //save name 
                    $img_producto    = $img_nombre . '.jpg'; //name and extension 
                    $src             = $destino . $img_producto; //ruta and name
                    }          
               
                $query_insert = mysqli_query($conn, "INSERT INTO producto (descripcion, proveedor, precio, existencia, usuario_id, foto) 
                                                VALUES ('$producto', '$proveedor', '$precio', '$cantidad', '$usuario_id', '$img_producto')");
                
                if ($query_insert) {

                    if ($nombre_foto != '') {
                        move_uploaded_file($url_temp,$src);
                    }
                    $alert = "<p class='msg_save'>El producto ha sido creado!</p>";
                }   else {

                    $alert = "<p class='msg_error'>Eror al crear el producto!</p>";
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
                    <div class="container-fluid px-6"><!--contenido....--> 
                        <div class="row justify-content-center">
                            <div class="col-lg-7" style="margin-bottom: 25px;">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4 text-primary">Registro Producto</h3></div>
                                    <div class="card-body">
                                    <div class="alert"><?php echo isset($alert) ? $alert : '';  ?></div>

                                        <form action="" method="post" enctype="multipart/form-data">
                                            
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                <label for="proveedor" class="mb-2">Proveedor</label>
                                                <?php selectProveedor(); ?>
                                                </div>                                 
                                            <div class="col-md-6 mb-3">
                                                <label for="producto" class="mb-2">Producto</label>
                                                <input class="form-control" name="producto" id="producto" type="text" placeholder="Nombre del Producto" />
                                                </div>
                                            </div>
                                                                                   

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <input class="form-control" name="precio" id="precio" type="number" placeholder="Precio del producto" />
                                                </div>                            
                                            
                                                <div class="col-md-6 mb-3">
                                                    <input class="form-control" name="cantidad" id="cantidad" type="number" placeholder="Cantidad del Producto" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 mb-3">
                                                <label for="foto" class="form-label">Selecciona una foto:</label>
                                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                            </div>
                                                                               
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-block">Registrar Producto</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="./">Regresar <--</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>                    

                    </div>
                </main>
                <?php include('includes/footer.php')?>
            </div>
        </div>           
       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>