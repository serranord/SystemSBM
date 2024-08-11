<?php 

	$servidor 	= 	'localhost';
	$user		=	'root';	
	$passowrd	=	'';
	$db			=	'factura';

	$conn = new mysqli($servidor, $user, $passowrd, $db);
	
	if (!$conn) {
		echo "Error en la conexion";
	}
?>