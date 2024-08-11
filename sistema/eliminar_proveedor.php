<?php
    include('../conexion.php');

    if(isset($_POST['delete'])){
        $idProveedor = $_POST['id']; 
        $sql = "UPDATE proveedor SET estatus = 0 WHERE  codproveedor = '$idProveedor'";        
        
        if($conn->query($sql)){   
            $filas_afectadas = mysqli_affected_rows($conn); 
            if($filas_afectadas > 0) {
                mysqli_close($conn);                
                header('location: lista_proveedor.php?alert=successful');    
            } else {
                header('location: lista_proveedor.php?alert=error');            
            }
        } else { 
            mysqli_close($conn);           
            header('location: lista_proveedor.php?alert=error');                
        }
    }   
?>
