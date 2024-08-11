<?php 
	include('../conexion.php');	

	if(isset($_POST['id'])){
		$idUsuario = $_POST['id'];
		$sql = "SELECT * FROM usuario WHERE idusuario = '$idUsuario'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();	

        echo json_encode($row);
        
	}
?>
