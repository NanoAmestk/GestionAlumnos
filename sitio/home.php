<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
</head>
<body>
	<?php
    	session_start();
		
		if(!isset($_SESSION['IDUsu'])){
			echo '<script>window.location.replace("index.php");</script>';
		}
	?>
    Home
    <br />
    <ul>
    	<li><a href="home.php">Home</a></li>
        <li><a href="perfil.php">Mi Perfil</a></li>
        <li><a href="usuarios.php">Usuarios</a></li>
        <li><a href="cursos.php">Cursos</a></li>
        <li><a href="noticias.php">Noticias</a></li>
        <li><a href="controladores/logout.php">Cerrar Sesión</a></li>
    </ul>
</body>
</html>