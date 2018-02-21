<?php
	if(isset($_GET['action'])){
		require('conexionBD.php');
		
		if($_GET['action']=='loadCboGen'){
			$dats=array();
			
			$res=$mysqli->query("call sp_Generos_Cbo");
			while($row=$res->fetch_assoc()){
				$dats[]=array(
					"ID"=>$row['ID'],
					"Gen"=>$row['Genero']
				);
			}
			
			echo json_encode($dats);
		}
		
		if($_GET['action']=='loadCboTipUsu'){
			$dats=array();
			
			$res=$mysqli->query("call sp_Tipos_Usuario_Cbo");
			while($row=$res->fetch_assoc()){
				$dats[]=array(
					"ID"=>$row['ID'],
					"TipUsu"=>$row['Tipo_Usuario']
				);
			}
			
			echo json_encode($dats);
		}
		
		if($_GET['action']=='loadDatUsu'){
			$ID='';
			if(isset($_POST['hidIDUsu'])){
				$ID=$_POST['hidIDUsu'];
			}
			
			$Rut='';
			if(isset($_POST['Rut'])){
				$Rut=$_POST['Rut'];
			}
			
			$Nom='';
			if(isset($_POST['Nom'])){
				$Nom=$_POST['Nom'];
			}
			
			$ApePat='';
			if(isset($_POST['ApePat'])){
				$ApePat=$_POST['ApePat'];
			}
			
			$ApeMat='';
			if(isset($_POST['ApeMat'])){
				$ApeMat=$_POST['ApeMat'];
			}
			
			$Gen='';
			if(isset($_POST['Gen'])){
				$Gen=$_POST['Gen'];
			}
			
			$Tip='';
			if(isset($_POST['Tip'])){
				$Tip=$_POST['Tip'];
			}
			
			$dats=array();
			
			$res=$mysqli->query("call sp_Usuarios_Buscar('".$ID."','".$Rut."','".$Nom."','".$ApePat."','".$ApeMat."','".$Gen."','".$Tip."')");
			while($row=$res->fetch_assoc()){
				$dats[]=array(
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
			
			echo json_encode($dats);
		}
		
		
	}
?>