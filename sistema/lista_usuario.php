    <?php 
    	session_start();
    	if (!isset($_SESSION['active'])) {
    		session_destroy();
    		header("location: ../");       
        } 
        
        if ($_SESSION['rol'] != 1) {
            header("location: ./");  
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
                        <?php include('modal_usuarios.php')?>
                        
                        <?php  successful_usuarios() ?>                    
                               
                       <div class="card mb-4"><!--tablat dinamica....--> 
                            <div class="card-header">
                                <h5 class="btn btn-primary"> <a href="registro_usuario.php" class="text-white text-decoration-none">Registrar Nuevo Usuario</a> </h5>
                                <i class="fas fa-table me-1"></i>
                                 Lista de Usuarios 
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr style="width:15px">                                    
                                            <th style="width:10px"><i class="fa-solid fa-id-badge"></i> ID</th>
                                            <th><i class="fa-solid fa-user-tie"></i> Nombre</th>
                                            <th><i class="fa-solid fa-envelope"></i> Correo</th>
                                            <th><i class="fa-solid fa-user"></i> Usuario</th>
                                            <th><i class="fa-solid fa-people-roof"></i> Rol</th>
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
                                        $query = mysqli_query($conn, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol;
                                        ");
                                        $result = mysqli_num_rows($query);

                                        if ($result > 0) {
                                            
                                            while($data = mysqli_fetch_array($query)) { ?>
                                                    <tr>
                                                        <td><?php echo $data['idusuario']?></td>
                                                        <td><?php echo $data['nombre']?></td>
                                                        <td><?php echo $data['correo']?></td>
                                                        <td><?php echo $data['usuario']?></td>
                                                        <td><?php echo $data['rol']?></td>                                              
                                                        <td>
                                                            <a class="link_edit" href="editar_usuario.php?id=<?php echo $data['idusuario']?>"><i class="fa-solid fa-pen-to-square" style="width: 50px;"></i></a>
                                                            
                                                            <a class="link_delete" href="#" data-id='<?php echo $data['idusuario']?>'><i class="fa-solid fa-trash"></i></a>                                
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
                url: 'consultar_usuario.php',
                data: {id:id},
                dataType: 'json',
                success: function(response){                
               // $('#nombre').val(response.nombre); 
                $('input[name="nombre"]').val(response.nombre); 
                $('input[name="id"]').val(response.idusuario);                              
                }
            });
        }        
    </script>
    </body>
</html>
