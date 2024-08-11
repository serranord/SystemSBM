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
                                <h5 class="btn btn-primary"> <a href="registro_cliente.php" class="text-white text-decoration-none">Registrar Nuevo Cliente</a> </h5>
                                <i class="fas fa-table me-1"></i>
                                Lista de Clientes 
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr style="width:15px">                                    
                                            <th style="width:10px"><i class="fa-solid fa-id-badge"></i> ID</th>
                                            <th><i class="fa-solid fa-user-tie"></i> Cédula/Pasaporte</th>
                                            <th><i class="fa-solid fa-user-tie"></i> Nombre</th>
                                            <th><i class="fa-solid fa-envelope"></i> Telefono</th>
                                            <th><i class="fa-solid fa-user"></i> Direccion</th>
                                           <th><i class="fa-solid fa-sliders"></i> Acciones</th>                                    
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                        $query = mysqli_query($conn, "SELECT * FROM cliente WHERE estatus = 1");
                                        $result = mysqli_num_rows($query);

                                        if ($result > 0) {
                                            
                                            while($datacliente = mysqli_fetch_array($query)) { ?>
                                                    <tr>
                                                        <td><?php echo $datacliente['idcliente']?></td>
                                                        <td><?php echo $datacliente['nit']?></td>
                                                        <td><?php echo $datacliente['nombre']?></td>
                                                        <td><?php echo $datacliente['telefono']?></td>
                                                        <td><?php echo $datacliente['direccion']?></td>                                                                                                
                                                        <td>
                                                            <a class="link_edit" href="editar_cliente.php?id=<?php echo $datacliente['idcliente']?>"><i class="fa-solid fa-pen-to-square" style="width: 50px;"></i></a>
                                                            <a class="link_delete" href="#" data-id='<?php echo $datacliente['idcliente']?>'><i class="fa-solid fa-trash"></i></a>                                
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
        $(document).on('click', '.link_delete', function(e){
            e.preventDefault();
            $('#delete').modal('show');
            var id = $(this).data('id');
            loadDoc(id);
        });    

        $(document).on('click', '.agregar', function(e){
            e.preventDefault();
            $('#agregar').modal('show');
            var id = $(this).data('id');
            loadDoc(id);
        });   
        
        $(document).on('click', '.edit', function(e){
            e.preventDefault();
            $('#edit').modal('show');
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
