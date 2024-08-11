<?php
	$servidor 	= 	'localhost';
	$user		=	'phpmyadmin';	
	$passowrd	=	'junior0303';
	$db			=	'factura';

	$conn = new mysqli($servidor, $user, $passowrd, $db);
	
	if (!$conn) {
		echo "Error en la conexion";
	}
?>