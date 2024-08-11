<?php 
	include('../conexion.php');	

	if(isset($_POST['id'])){
		$idProveedor = $_POST['id'];
		$sql = "SELECT * FROM proveedor WHERE codproveedor = '$idProveedor'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();	

		//echo '<p>El proveedor es: </p> ' . $row['proveedor'];

        echo json_encode($row);
        
	}
?>
