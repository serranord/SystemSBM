<?php 
	include('../conexion.php');	

	if(isset($_POST['id'])){
		$idCliente = $_POST['id'];
		$sql = "SELECT * FROM cliente WHERE idcliente = '$idCliente'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();	

        echo json_encode($row);
        
	}
?>
