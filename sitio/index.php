<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Do Re Mi - Inicio</title>
</head>
<body>
	<?php
		session_start();
		session_destroy();
	?>
	<form id="frmLogIn" name="frmLogIn" method="post" action="controladores/login.php">
    	<input type="text" id="txtRut" name="txtRut" />
        <br />
        <input type="password" id="txtPas" name="txtPas" />
        <br />
        <input type="submit" />
    </form>
</body>
</html>