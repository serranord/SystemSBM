
<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/styles.css" rel="stylesheet"/>
</head>
<body>

</body>
</html>

<?php
    

    //Devolver mensajes de error:
    function successful_usuarios() {
        if (isset($_GET['alert']) && $_GET['alert'] == 'successful') {

            echo "  
                <div style='background-color:#00a65a; display: flex;
                align-items: center;justify-content: center;'>
                        <p style='color:#fff; font-size:20px; padding-top:10px;'><i class='fa-solid fa-delete-left'></i> !Usuario eliminado satisfactoriamente!...</p>
                    <br>      	
                </div>     		
                ";
            } else {
                if (isset($_GET['alert']) && $_GET['alert'] == 'error') {
            
                    echo "  
                        <div style='background-color:red; display: flex;
                        align-items: center;justify-content: center;'>
                                <p style='color:#fff; font-size:20px; padding-top:10px;'><i class='fa-solid fa-triangle-exclamation'></i> Error al eliminar el usuario...</p>
                            <br>      	
                        </div>     		
                        ";
            }
        }
    }

    function successful_clientes() {
        if (isset($_GET['alert']) && $_GET['alert'] == 'successful') {

            echo "  
                <div style='background-color:#00a65a; display: flex;
                align-items: center;justify-content: center;'>
                        <p style='color:#fff; font-size:20px; padding-top:10px;'><i class='fa-solid fa-delete-left'></i> !Cliente eliminado satisfactoriamente!...</p>
                    <br>      	
                </div>     		
                ";
            } else {
                if (isset($_GET['alert']) && $_GET['alert'] == 'error') {
            
                    echo "  
                        <div style='background-color:red; display: flex;
                        align-items: center;justify-content: center;'>
                                <p style='color:#fff; font-size:20px; padding-top:10px;'><i class='fa-solid fa-triangle-exclamation'></i> Error al eliminar el cliente...</p>
                            <br>      	
                        </div>     		
                        ";
            }
        }
    }

    function successful_proveedor() {
        if (isset($_GET['alert']) && $_GET['alert'] == 'successful') {

            echo "  
                <div style='background-color:#00a65a; display: flex;
                align-items: center;justify-content: center;'>
                        <p style='color:#fff; font-size:20px; padding-top:10px;'><i class='fa-solid fa-delete-left'></i> !Proveedor eliminado satisfactoriamente!...</p>
                    <br>      	
                </div>     		
                ";
            } else {
                if (isset($_GET['alert']) && $_GET['alert'] == 'error') {
            
                    echo "  
                        <div style='background-color:red; display: flex;
                        align-items: center;justify-content: center;'>
                                <p style='color:#fff; font-size:20px; padding-top:10px;'><i class='fa-solid fa-triangle-exclamation'></i> Error al eliminar el proveedor...</p>
                            <br>      	
                        </div>     		
                        ";
            }
        }
    }

    //Mostrar paginas según roles de usuarios:
    function mostrarListaUsuarios() {
        if ($_SESSION['rol'] == 1) {
            echo '<a class="nav-link" href="lista_usuario.php">Lista de Usuarios</a>';                              
        }
    }


    //Mostrar lista de proveedores en el select; 
    function selectProveedor() {
        include('../conexion.php');
 
    $query_proveedor = mysqli_query($conn, "SELECT codproveedor, proveedor FROM proveedor WHERE estatus = 1 ORDER BY proveedor ASC");
    $result_proveedor = mysqli_num_rows($query_proveedor);

        echo "<select name='proveedor' class='form-control'>";
    
            if ($result_proveedor > 0) {
                while ($row_proveedor = mysqli_fetch_array($query_proveedor)) {

            echo "<option value='" . $row_proveedor['codproveedor'] . "'>" . $row_proveedor['proveedor'] . "</option>";
            }
        }    
        echo "</select>";
    }  


    function uploadImage() {
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
    }
?>