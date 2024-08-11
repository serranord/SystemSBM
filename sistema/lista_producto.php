    <?php 
    	session_start();
    	if (!isset($_SESSION['active'])) {
    		session_destroy();
    		header("location: ../");       
        } 

        include('../conexion.php');        
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
                        <br> 
                        <!-- Modal -->                                                                        
                        <?php include('modal_clientes.php')?>
                        
                        <?php  successful_clientes()?>                    

                       <div class="card mb-4"><!--tablat dinamica....--> 
                            <div class="card-header">
                                <h5 class="btn btn-primary"> <a href="registro_producto.php" class="text-white text-decoration-none">Registrar Nuevo Producto</a> </h5>
                                <i class="fas fa-table me-1"></i>
                                Lista de Productos 
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>                                    
                                            <th><i class="fa-brands fa-codepen"></i> ID</th>
                                            <th><i class="fa-solid fa-audio-description"></i> Descripcion</th>
                                            <th><i class="fa-solid fa-dollar-sign"></i> Precio</th>
                                            <th><i class="fa-solid fa-bars"></i> Existencia</th>
                                            <th><i class="fa-solid fa-square-nfi"></i> Proveedor</th>
                                            <th><i class="fa-solid fa-image"></i> Foto</th>
                                            <th><i class="fa-solid fa-sliders"></i> Acciones</th>                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $query = mysqli_query($conn, "SELECT p.codproducto, p.descripcion, p.precio, p.existencia, pr.proveedor, p.foto FROM producto p INNER JOIN proveedor pr ON p.proveedor = pr.codproveedor WHERE p.estatus = 1");
                                        $result = mysqli_num_rows($query);

                                        if ($result > 0) {
                                            
                                            while($dataproducto = mysqli_fetch_array($query)) { 
                                            
                                                if ($dataproducto['foto'] != 'img_producto.png') {
                                                $foto = 'img/uploads/' . $dataproducto['foto'];

                                            }    else {
                                                $foto = 'img/uploads/' . $dataproducto['foto'];
                                            }

                                            ?>                                            
                                                    <tr>
                                                        <td><?php echo $dataproducto['codproducto']?></td>
                                                        <td><?php echo $dataproducto['descripcion']?></td>
                                                        <td><?php echo $dataproducto['precio']?></td>
                                                        <td><?php echo $dataproducto['existencia']?></td>
                                                        <td><?php echo $dataproducto['proveedor']?></td>                                                                                              
                                                        <td> <img src="<?php echo $foto ?>" alt="<?php echo $dataproducto['descripcion'] ?>" width="50" height="50"><td>
                                                            <a class="add_product"  product="<?php echo $dataproducto['codproducto']?>" href="#"><i class="fa-solid fa-plus"></i></a>                                  
                                                            <a class="link_edit"    href="editar_producto.php?id=<?php echo $dataproducto['codproducto'] ?>"><i class="fa-solid fa-pen-to-square" style="width: 50px;"></i></a>
                                                            <a class="link_delete"  href="#" data-id='<?php echo $dataproducto['codproducto'] ?>'><i class="fa-solid fa-trash"></i></a>                                                                                            
                                                        </td>
                                                    </tr>
                                        <?php } mysqli_close($conn); } ?>
                                    </tbody>
                                </table>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>  
        
        $(document).on('click', '.add_product', function(e){
           e.preventDefault(); 
           var producto = $(this).attr('product');           
           var action = 'infoProduct';           

           $.ajax({
                url: 'consultar_producto.php',
                type: 'POST',
                async: true,
                data: {action:action, producto:producto},
                
                success: function(response){  
                console.log(response);              
                //$('#nombre').val(response.nombre); 
                $('input[name="precio"]').val(response.nombre); 
                //$('input[name="id"]').val(response.idcliente);                              
                }
            });

           $('.ModalProducto').fadeIn();  

        }); 
                
        function closeModalProduct(){
            $('.ModalProducto').fadeOut();  
        }  
                
        $(document).on('click', '.link_delete', function(e){
            e.preventDefault();
            $('#delete').modal('show');
            var id = $(this).data('id');
            loadDoc(id);
        });          
 
        function loadDoc(id) { 
            $.ajax({
                type: 'POST',
                url: 'consultar_cliente.php',
                data: {id:id},
                dataType: 'json',
                success: function(response){                
               // $('#nombre').val(response.nombre); 
                $('input[name="nombre"]').val(response.nombre); 
                $('input[name="id"]').val(response.idcliente);                              
                }
            });
        }        
    </script>
    </body>
</html>
