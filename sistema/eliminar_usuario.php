<?php
    include('../conexion.php');

    if(isset($_POST['delete'])){
        $id = $_POST['id']; 
        $sql = "DELETE FROM usuario WHERE idusuario = '$id'";        
        
        if($conn->query($sql)){   
            $filas_afectadas = mysqli_affected_rows($conn); 
            if($filas_afectadas > 0) {
                mysqli_close($conn);                
                header('location: lista_usuario.php?alert=successful');    
            } else {
                header('location: lista_usuario.php?alert=error');            
            }
        } else { 
            mysqli_close($conn);           
            header('location: lista_usuario.php?alert=error');                
        }
    }   
?>
