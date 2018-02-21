<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
<?php
	require('conexionBD.php');
	require('validaciones.php');
	
	if(isset($_REQUEST['txtRut']) && isset($_REQUEST['txtPas'])){
		$RutFrm=validRut($_REQUEST['txtRut']);
		if($RutFrm=='-1'){
			echo '<script>alert("El Rut ingresado no es valido.");window.history.back();</script>';
		}else{
			$Pas=$_REQUEST['txtPas'];
			
			if($res=$mysqli->query("call sp_Iniciar_Sesion('".$RutFrm."')")){
				if($res->num_rows>0){
					while($row=$res->fetch_assoc()){
						if(password_verify($Pas,$row['Pass'])){
							session_start();
							
							$_SESSION['IDUsu']=$row['ID'];
							$_SESSION['Rut']=$row['Rut'];
							$_SESSION['NomUsu']=$row['Nombre'];
							$_SESSION['ApePat']=$row['Apellido_Paterno'];
							$_SESSION['Gen']=$row['Genero'];
							$_SESSION['TipUsu']=$row['Tipo_Usuario'];
							
							echo '<script>window.location.replace("../home.php");</script>';
						}else{
							echo '<script>alert("La clave ingresada no es la correcta.");window.history.back();</script>';
						}
					}
				}else{
					echo '<script>alert("No existen coincidencias para el Rut ingresado.");window.location.replace("../index.php");</script>';
				}
			}else{
				echo '<script>alert("Ocurrio un error al validar el Usuario.");window.history.back();</script>';
			}
		}
	}else{
		echo '<script>window.location.replace("../index.php");</script>';
	}
?>