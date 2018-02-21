<?php
	$host='localhost';
	$User='root';
	$Pass='';
	$BD='doremi_db';
	$mysqli=new mysqli($host,$User,$Pass,$BD);
	if($mysqli->connect_errno){
		echo '<script>alert("Fallo la conexion con la Base de Datos.");</script>';
	}
?>