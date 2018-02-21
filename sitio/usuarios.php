<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Usuarios</title>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="ajax/usuarios.js"></script>
</head>
<body>
	<?php
		session_start();
		
		if(!isset($_SESSION['IDUsu'])){
			echo '<script>window.location.replace("index.php");</script>';
		}
	?>
    Usuarios
    <br />
    <ul>
    	<li><a href="home.php">Home</a></li>
        <li><a href="perfil.php">Mi Perfil</a></li>
        <li><a href="usuarios.php">Usuarios</a></li>
        <li><a href="cursos.php">Cursos</a></li>
        <li><a href="noticias.php">Noticias</a></li>
        <li><a href="util/logout.php">Cerrar Sesión</a></li>
    </ul>
    <br />
	<form id="frm" name="frm">
        <?php
			$IDUsu='-1';
			
			if(isset($_GET['IDUsu'])){
				$IDUsu=$_GET['IDUsu'];
			}
		?>
        
        <input type="hidden" id="hidIDUsu" name="hidIDUsu" value="<?php echo $IDUsu; ?>" />
        <input type="hidden" id="hidIDGen" name="hidIDGen" />
        <input type="hidden" id="hidIDTipUsu" name="hidIDTipUsu" />
        <input type="hidden" id="hidIDEst" name="hidIDEst" />
        
        <table>
            <tr>
                <td></td>
                <td>Foto</td>
                <td>:</td>
                <td><img id="imgUsu" name="imgUsu" width="50" /></td>
            </tr>
            <tr>
                <td></td>
                <td>Nueva Foto</td>
                <td>:</td>
                <td><input type="file" id="filFot" name="filFot" /></td>
            </tr>
            <tr>
                <td>*</td>
                <td>Rut</td>
                <td>:</td>
                <td><input type="text" id="txtRut" name="txtRut" required="required" /></td>
            </tr>
            <tr>
                <td>*</td>
                <td>Nombre</td>
                <td>:</td>
                <td><input type="text" id="txtNom" name="txtNom" required="required" /></td>
            </tr>
            <tr>
                <td>*</td>
                <td>Apellido Paterno</td>
                <td>:</td>
                <td><input type="text" id="txtApePat" name="txtApePat" required="required" /></td>
            </tr>
            <tr>
                <td></td>
                <td>Apellido Materno</td>
                <td>:</td>
                <td><input type="text" id="txtApeMat" name="txtApeMat" /></td>
            </tr>
            <tr>
                <td>*</td>
                <td>Genero</td>
                <td>:</td>
                <td>
                    <select id="cboGen" name="cboGen"></select>
                </td>
            </tr>
            <tr>
                <td>*</td>
                <td>Fecha Nacimiento</td>
                <td>:</td>
                <td><input type="date" id="txtFecNac" name="txtFecNac" required="required" /></td>
            </tr>
            <tr>
                <td></td>
                <td>Email</td>
                <td>:</td>
                <td><input type="text" id="txtEma" name="txtEma" /></td>
            </tr>
            <tr>
                <td>*</td>
                <td>Telefono 1</td>
                <td>:</td>
                <td><input type="tel" id="txtTel1" name="txtTel1" required="required" /></td>
            </tr>
            <tr>
                <td></td>
                <td>Telefono 2</td>
                <td>:</td>
                <td><input type="tel" id="txtTel2" name="txtTel2" /></td>
            </tr>
            <tr>
                <td></td>
                <td>Dirección</td>
                <td>:</td>
                <td><input type="text" id="txtDir" name="txtDir" /></td>
            </tr>
            <tr>
            	<td></td>
                <td>Comentarios</td>
                <td>:</td>
                <td><textarea id="txtCom" name="txtCom" readonly="readonly"></textarea></td>

            </tr>
            <tr>
            	<td></td>
                <td>Tipo_Usuario</td>
                <td>:</td>
                <td id="tdCboTipUsu"><select id="cboTipUsu" name="cboTipUsu"></select></td>
                <td id="tdTipUsu"></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">* Datos Obligatorios</td>
            </tr>
        </table>
        <input type="submit" id="busUsu" name="busUsu" value="Grabar" />
        <input type="button" id="btnLim" name="btnLim" value="Limpiar" />
        <input type="button" id="btnEli" name="btnEli" value="Eliminar" />
        <br />
        <table id="tabLisUsu">
        	<thead>
            	<tr>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Genero</th>
                    <th>Fecha Nacimiento</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </form>
</body>
</html>