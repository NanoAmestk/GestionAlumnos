<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Perfil</title>
</head>
<body>
	<?php
		session_start();
		
		if(!isset($_SESSION['IDUsu'])){
			echo '<script>window.location.replace("index.php");</script>';
		}
		
		require('controladores/usuarios.php');
	?>
    Perfiles
    <br />
    <ul>
    	<li><a href="home.php">Home</a></li>
        <li><a href="perfil.php">Mi Perfil</a></li>
        <li><a href="usuarios.php">Usuarios</a></li>
        <li><a href="cursos.php">Cursos</a></li>
        <li><a href="noticias.php">Noticias</a></li>
        <li><a href="controladores/logout.php">Cerrar Sesión</a></li>
    </ul>
    <br />
    
    <?php
		$IDUsu=$_SESSION['IDUsu'];
		$datUsu=buscarUsuario($IDUsu,'','','','','','');
		if($datUsu[0]['Err']=='2'){
			echo '<script>alert("Ocurrio un error al buscar los datos de perfil.");window.location.replace("index.php");</script>';
		}elseif($datUsu[0]['Err']=='1'){
			echo '<script>alert("No se encontraron los datos de perfil.");window.location.replace("index.php");</script>';
		}
	?>
    <form method="post" action="controladores/usuarios.php">
    <table>
    	<tr>
        	<td>Foto</td>
            <td>:</td>
            <td><img src="img/perfiles/<?php echo $datUsu[0]['PathPic']; ?>"</td>
        </tr>
        <tr hidden="hidden">
        	<td>Path</td>
            <td>:</td>
            <td><input type="text" id="pathPic" name="pathPic" value="<?php echo $datUsu[0]['PathPic']; ?>" /></td>
        </tr>
        <tr>
        	<td>Nueva Foto</td>
            <td>:</td>
            <td><input type="file" id="filFot" name="filFot" /></td>
        </tr>
        <tr hidden="hidden">
        	<td>ID</td>
            <td>:</td>
            <td><input type="text" id="txtIDUsu" name="txtIDUsu" value="<?php echo $datUsu[0]['ID']; ?>" /></td>
        </tr>
        <tr hidden="hidden">
        	<td>Rut</td>
            <td>:</td>
            <td><input type="text" id="txtRut" name="txtRut" value="<?php echo $datUsu[0]['Rut']; ?>" /></td>
        </tr>
        <tr>
        	<td>Rut</td>
            <td>:</td>
            <td><?php echo $datUsu[0]['Rut']; ?></td>
        </tr>
        <tr>
        	<td>Nombre</td>
            <td>:</td>
            <td><input type="text" id="txtNom" name="txtNom" value="<?php echo $datUsu[0]['Nom']; ?>" /></td>
        </tr>
        <tr>
        	<td>Apellido Paterno</td>
            <td>:</td>
            <td><input type="text" id="txtApePat" name="txtApePat" value="<?php echo $datUsu[0]['ApePat']; ?>" /></td>
        </tr>
        <tr>
        	<td>Apellido Materno</td>
            <td>:</td>
            <td><input type="text" id="txtApeMat" name="txtApeMat" value="<?php echo $datUsu[0]['ApeMat']; ?>" /></td>
        </tr>
        <?php
			$datGen=llenarCboGen();
			if($datGen[0]['Err']=='2'){
				echo '<script>alert("Ocurrio un error al buscar los Generos.");window.location.replace("index.php");</script>';
			}elseif($datGen[0]['Err']=='1'){
				echo '<script>alert("No se encontraron los Generos para mostrar.");window.location.replace("index.php");</script>';
			}
		?>
        <tr hidden="hidden">
        	<td>IDGenero</td>
            <td>:</td>
            <td><?php echo $datUsu[0]['IDGen']; ?></td>
        </tr>
        <tr>
        	<td>Genero</td>
            <td>:</td>
            <td>
            	<select id="cboGen" name="cboGen">
                	<?php
						for($i=0;$i<count($datGen);$i++){
							$ID=$datGen[$i]['ID'];
							$Gen=$datGen[$i]['Gen'];
							
							if($datUsu[0]['IDGen']==$ID){
								echo '<option value="'.$datGen[$i]['ID'].'" selected="selected">'.$datGen[$i]['Gen'].'</option>';
							}else{
								echo '<option value="'.$datGen[$i]['ID'].'">'.$datGen[$i]['Gen'].'</option>';
							}
						}
					?>
                </select>
            </td>
        </tr>
        <tr>
        	<td>Fecha Nacimiento</td>
            <td>:</td>
            <td><input type="text" id="txtFecNac" name="txtFecNac" value="<?php echo $datUsu[0]['FecNac']; ?>" /></td>
        </tr>
        <tr>
        	<td>Email</td>
            <td>:</td>
            <td><input type="text" id="txtEma" name="txtEma" value="<?php echo $datUsu[0]['Ema']; ?>" /></td>
        </tr>
        <tr>
        	<td>Telefono 1</td>
            <td>:</td>
            <td><input type="text" id="txtTel1" name="txtTel1" value="<?php echo $datUsu[0]['Tel1']; ?>" /></td>
        </tr>
        <tr>
        	<td>Telefono 2</td>
            <td>:</td>
            <td><input type="text" id="txtTel2" name="txtTel2" value="<?php echo $datUsu[0]['Tel2']; ?>" /></td>
        </tr>
        <tr>
        	<td>Dirección</td>
            <td>:</td>
            <td><input type="text" id="txtDir" name="txtDir" value="<?php echo $datUsu[0]['Dir']; ?>" /></td>
        </tr>
        <?php
			$datTipUsu=llenarCboTipUsu();
			if($datTipUsu[0]['Err']=='2'){
				echo '<script>alert("Ocurrio un error al buscar los Tipos de Usuario.");window.location.replace("index.php");</script>';
			}elseif($datTipUsu[0]['Err']=='1'){
				echo '<script>alert("No se encontraron los Tipos de Usuario para mostrar.");window.location.replace("index.php");</script>';
			}
		?>
        <tr hidden="hidden">
        	<td>IDTipUsu</td>
            <td>:</td>
            <td><?php echo $datUsu[0]['IDTipUsu']; ?></td>
        </tr>
        <tr>
        	<td>Tipo Usuario</td>
            <td>:</td>
            <td>
				<?php
					if($_SESSION['TipUsu']=='Administrador'){
                        echo '<select id="cboTipUsu" name="cboTipUsu">';
                            for($i=0;$i<count($datTipUsu);$i++){
                                $ID=$datTipUsu[$i]['ID'];
                                $TipUsu=$datTipUsu[$i]['TipUsu'];
                                
                                if($datUsu[0]['IDTipUsu']==$ID){
                                    echo '<option value="'.$datTipUsu[$i]['ID'].'" selected="selected">'.$datTipUsu[$i]['TipUsu'].'</option>';
                                }else{
                                    echo '<option value="'.$datTipUsu[$i]['ID'].'">'.$datTipUsu[$i]['TipUsu'].'</option>';
                                }
                            }
                        echo '</select>';
                    }else{
                        echo $datUsu[0]['TipUsu'];
                    }
                ?>
            </td>
        </tr>
        <tr hidden="hidden">
        	<td>IDEst</td>
            <td>:</td>
            <td><input type="text" id="cboEst" name="cboEst" value="<?php echo $datUsu[0]['IDEst']; ?>"  /></td>
        </tr>
        <tr hidden="hidden">
        	<td>Comentarios</td>
            <td>:</td>
            <td><textarea id="txtCom" name="txtCom"><?php echo $datUsu[0]['Comentarios']; ?></textarea></td>
        </tr>
    </table>
    <br />
    	<input type="submit" id="btnEnv" name="btnEnv" />
    </form>
</body>
</html>