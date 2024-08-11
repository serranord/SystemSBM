<?php
    include('../conexion.php');

    if(isset($_POST['delete'])){
        $idCliente = $_POST['id']; 
        $sql = "UPDATE cliente SET estatus = 0 WHERE  idcliente = '$idCliente'";        
        
        if($conn->query($sql)){   
            $filas_afectadas = mysqli_affected_rows($conn); 
            if($filas_afectadas > 0) {
                mysqli_close($conn);                
                header('location: lista_cliente.php?alert=successful');    
            } else {
                header('location: lista_cliente.php?alert=error');            
            }
        } else { 
            mysqli_close($conn);           
            header('location: lista_cliente.php?alert=error');                
        }
    }   
?>
