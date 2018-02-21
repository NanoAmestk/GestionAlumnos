<?php
	if(isset($_POST['btnEnv'])){
		require('conexionBD.php');
		
		$ID=$_POST['txtIDUsu'];
		$Rut=$_POST['txtRut'];
		$Pas=password_hash('cambiar',PASSWORD_BCRYPT,array('cost'=>12));
		$Nom=$_POST['txtNom'];
		$ApePat=$_POST['txtApePat'];
		$ApeMat=$_POST['txtApeMat'];
		$Gen=$_POST['cboGen'];
		$FecNac=$_POST['txtFecNac'];
		$FecNacFrm=substr($FecNac,-4,4).substr($FecNac,-7,2).substr($FecNac,-10,2);
		$Ema=$_POST['txtEma'];
		$Tel1=$_POST['txtTel1'];
		$Tel2=$_POST['txtTel2'];
		$Dir=$_POST['txtDir'];
		$TipUsu=$_POST['cboTipUsu'];
		$Com=$_POST['txtCom'];
		$Est=$_POST['cboEst'];
		$Path=$_POST['filFot'];
		$PathAnt=$_POST['pathPic'];
		if($Path==''){
			$Path=$PathAnt;
		}
		session_start();
		$IDUsu=$_SESSION['IDUsu'];
		
		
		$sqlstr='';
		
		echo '<script>alert("'.$sqlstr.'");</script>';
		
		/*$sqlstr="call sp_Usuarios_Grabar('".$ID."','".$Rut."','".$Pas."','".$Nom."','".$ApePat."','".$ApeMat."','".$Gen."','".$FecNacFrm."','".$Ema."','".$Tel1."','".$Tel2."','".$Dir."','".$TipUsu."','".$Com."','".$Est."','".$Path."','".$IDUsu."')";*/
		$sqlstr="".$Pas."";
		
		echo '<script>alert("'.$sqlstr.'");</script>';
		
		/*if($res=$mysqli->query($sqlstr)){
			if($res->num_rows>0){
				while($row=$res->fetch_assoc()){
					$resp=$res['Resp'];
				}
			}else{
				$resp='-1';
			}
			
			echo '<script>alert("'.$resp.'");</script>';
		
			if($resp<>'-1'){
				echo '<script>alert("Se han grabado los datos del usuario exitosamente.");</script>';
			}else{
				echo '<script>alert("Ocurrio un error al guardar los datos del usuario.");</script>';
			}
		}else{
			echo '<script>alert("Ocurrio un error al conectar a la Base de Datos.");</script>';
		}*/
		
		/*echo '<script>window.location.replace("../perfil.php");</script>';*/
	}
	
	function llenarCboGen(){
		require('conexionBD.php');
		
		if($res=$mysqli->query("call sp_Generos_Cbo")){
			$dats=array();
			
			if($res->num_rows>0){
				while($row=$res->fetch_assoc()){
					$dats[]=array(
						"Err"=>'0',
						"ID"=>$row['ID'],
						"Gen"=>$row['Genero']
					);
				}
			}else{
				$dats[]=array(
					"Err"=>'1'
				);
			}
		}else{
			$dats[]=array(
				"Err"=>'2'
			);
		}
		
		return $dats;
	}
	
	function llenarCboTipUsu(){
		require('conexionBD.php');
		
		if($res=$mysqli->query("call sp_Tipos_Usuario_Cbo")){
			$dats=array();
			
			if($res->num_rows>0){
				while($row=$res->fetch_assoc()){
					$dats[]=array(
						"Err"=>'0',
						"ID"=>$row['ID'],
						"TipUsu"=>$row['Tipo_Usuario']
					);
				}
			}else{
				$dats[]=array(
					"Err"=>'1'
				);
			}
		}else{
			$dats[]=array(
				"Err"=>'2'
			);
		}
		
		return $dats;
	}
	
	function llenarCboEst(){
		require('conexionBD.php');
		
		if($res=$mysqli->query("call sp_Estados_Cbo")){
			$dats=array();
			
			if($res->num_rows>0){
				while($row=$res->fetch_assoc()){
					$dats[]=array(
						"Err"=>'0',
						"ID"=>$row['ID'],
						"TipUsu"=>$row['Estado']
					);
				}
			}else{
				$dats[]=array(
					"Err"=>'1'
				);
			}
		}else{
			$dats[]=array(
				"Err"=>'2'
			);
		}
		
		return $dats;
	}
	
	function buscarUsuario($ID,$Rut,$Nom,$ApePat,$ApeMat,$Gen,$Tip){
		require('conexionBD.php');
		
		if($res=$mysqli->query("call sp_Usuarios_Buscar('".$ID."','','','','','','')")){
			$dats=array();
			
			if($res->num_rows>0){
				while($row=$res->fetch_assoc()){
					$dats[]=array(
						"Err"=>'0',
						"ID"=>$row['ID'],
						"Rut"=>$row['Rut'],
						"Nom"=>$row['Nombre'],
						"ApePat"=>$row['Apellido_Paterno'],
						"ApeMat"=>$row['Apellido_Materno'],
						"IDGen"=>$row['IDGen'],
						"Gen"=>$row['Genero'],
						"FecNac"=>$row['Fecha_Nacimiento'],
						"Ema"=>$row['Email'],
						"Tel1"=>$row['Telefono_1'],
						"Tel2"=>$row['Telefono_2'],
						"Dir"=>$row['Direccion'],
						"IDTipUsu"=>$row['IDTipUsu'],
						"TipUsu"=>$row['Tipo_Usuario'],
						"Com"=>$row['Comentarios'],
						"IDEst"=>$row['IDEst'],
						"Est"=>$row['Estado'],
						"PathPic"=>$row['Path']
					);
				}
			}else{
				$dats[]=array(
					"Err"=>'1'
				);
			}
		}else{
			$dats[]=array(
				"Err"=>'2'
			);
		}
		
		return $dats;
	}
?>