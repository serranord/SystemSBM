<?php 
	include('../conexion.php');	

    if($_POST['action'] == 'infoProduct'){
		$producto_id = $_POST['producto'];
		$sql = "SELECT codproducto, descripcion FROM producto WHERE codproducto = $producto_id AND estatus = 1";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();		

        echo json_encode($row);
        
	}
    
?>
