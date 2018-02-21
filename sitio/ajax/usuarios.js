$(document).ready(function(e) {
    loadCboGen();
	loadCboTipUsu();
	loadLisUsu();
	loadDatUsu();
	$("#btnLim").click(limFrm);
	$("#btnEli").click(eliUsu);
	//$("#frm").submit(grabarUsuario);
});

function loadCboGen(){
	$.ajax({
		type:		"GET",
		url:		"util/usuarios.php?action=loadCboGen",
		dataType:	"json",
		success:	function(res){
						for(var i=0;i<res.length;i++){
							$("#cboGen").append('<option value="'+res[i].ID+'">'+res[i].Gen+'</option>');
						}
					},
		error:		function(err){
						alert('Ocurrio un error al cargar los generos.');
					}
	});
}

function loadCboTipUsu(){
	$.ajax({
		type:		"GET",
		url:		"util/usuarios.php?action=loadCboTipUsu",
		dataType:	"json",
		success:	function(res){
						for(var i=0;i<res.length;i++){
							$("#cboTipUsu").append('<option value="'+res[i].ID+'">'+res[i].TipUsu+'</option>');
						}
					},
		error:		function(err){
						alert('Ocurrio un error al cargar los tipos de usuarios.');
					}
	});
}

function loadDatUsu(){
	var data=$("#frm").serializeArray();
	
	$.ajax({
		type:		"POST",
		url:		"util/usuarios.php?action=loadDatUsu",
		dataType:	"json",
		data:		data,
		success:	function(res){
						for(var i=0;i<res.length;i++){
							$("#imgUsu").attr('src','img/perfiles/'+res[i].PathPic);
							$("#txtRut").attr('value',res[i].Rut);
							$("#txtNom").attr('value',res[i].Nom);
							$("#txtApePat").attr('value',res[i].ApePat);
							$("#txtApeMat").attr('value',res[i].ApeMat);
							$("#hidIDGen").attr('value',res[i].IDGen);
							$("#cboGen option[value='"+res[i].IDGen+"']").attr('selected','selected');
							
							var fecNac=res[i].FecNac;
							var fecAux=fecNac.split("/");
							var fecFrm=fecAux[2]+'-'+fecAux[1]+'-'+fecAux[0];
							$("#txtFecNac").attr('value',fecFrm);
							
							$("#txtEma").attr('value',res[i].Ema);
							$("#txtTel1").attr('value',res[i].Tel1);
							$("#txtTel2").attr('value',res[i].Tel2);
							$("#txtDir").attr('value',res[i].Dir);
							$("#txtCom").attr('value',res[i].Com);
							$("#tdTipUsu").html(res[i].TipUsu);
							$("#cboTipUsu option[value='"+res[i].IDTipUsu+"']").attr('selected','selected');
							if(res[i].TipUsu=='Administrador'){
								$("#tdTipUsu").attr('hidden','hidden');
								$("#tdCboTipUsu").removeAttr('hidden');
							}else{
								$("#tdTipUsu").removeAttr('hidden');
								$("#tdCboTipUsu").attr('hidden','hidden');
							}
							$("#hidIDTipUsu").attr('value',res[i].IDTipUsu);
							$("#hidIDEst").attr('value',res[i].IDEst);
						}
					},
		error:		function(err){
						alert('Ocurrio un error al cargar los datos del usuario.');
					}
	});
}

function loadLisUsu(){
	$.ajax({
		type:		"GET",
		url:		"util/usuarios.php?action=loadDatUsu",
		dataType:	"json",
		success:	function(res){
						for(var i=0;i<res.length;i++){
							var html='<td><a href="?IDUsu='+res[i].ID+'">'+res[i].Rut+'</a></td><td>'+res[i].Nom+'</td><td>'+res[i].ApePat+'</td><td>'+res[i].Gen+'</td><td>'+res[i].FecNac+'</td>';
							$("#tabLisUsu tbody").append(html);
						}
					},
		error:		function(err){
						alert('Ocurrio un error al listar los usuarios.');
					}
	});
}

function grabarUsuario(event){
	event.preventDefault();
	
	var data=$("#frm").serializeArray();
	
	$.ajax({
		type:		"POST",
		url:		"util/listarUsuarios.php?action=grabarUsuario",
		dataType:	"json",
		data:		data,
		success:	function(res){
						/*for(var i=0;i<res.length;i++){
							$("#imgUsu").attr('src','img/perfiles/'+res[i].PathPic);
							$("#txtRut").attr('value',res[i].Rut);
							$("#txtNom").attr('value',res[i].Nom);
							$("#txtApePat").attr('value',res[i].ApePat);
							$("#txtApeMat").attr('value',res[i].ApeMat);
							$("#hidIDGen").attr('value',res[i].IDGen);
							$("#cboGen option[value='"+res[i].IDGen+"']").attr('selected','selected');
							
							var fecNac=res[i].FecNac;
							var fecFrm=str.substring(6,4)+'-'+str.substring(3,2)+'-'+str.substring(0,2);
							
							
							$("#txtFecNac").attr('value',fecFrm);
							$("#txtEma").attr('value',res[i].Ema);
							$("#txtTel1").attr('value',res[i].Tel1);
							$("#txtTel2").attr('value',res[i].Tel2);
							$("#txtDir").attr('value',res[i].Dir);
							$("#txtCom").attr('value',res[i].Com);
							$("#tdTipUsu").html(res[i].TipUsu);
							$("#cboTipUsu option[value='"+res[i].IDTipUsu+"']").attr('selected','selected');
							if(res[i].TipUsu=='Administrador'){
								$("#tdTipUsu").attr('hidden','hidden');
								$("#tdCboTipUsu").removeAttr('hidden');
							}else{
								$("#tdTipUsu").removeAttr('hidden');
								$("#tdCboTipUsu").attr('hidden','hidden');
							}
							$("#hidIDTipUsu").attr('value',res[i].IDTipUsu);
							$("#hidIDEst").attr('value',res[i].IDEst);
						}*/
					},
		error:		function(err){
						alert('Ocurrio un error al grabar los datos del usuario.');
					}
	});
}

function limFrm(){
	alert('Si!');
}

function eliUsu(){
	alert('Si!');
}