<?php
	function validRut($Rut){
		$RutFrm=preg_replace('/[^k0-9]/i','',$Rut);
		$dv=substr($RutFrm,-1);
		$numero=substr($RutFrm,0,strlen($RutFrm)-1);
		$i=2;
		$suma=0;
		foreach(array_reverse(str_split($numero)) as $v){
			if($i==8)
				$i = 2;
			$suma+=$v*$i;
			++$i;
		}
		$dvr=11-($suma%11);
		
		if($dvr==11)
			$dvr=0;
		if($dvr==10)
			$dvr='K';
		if($dvr==strtoupper($dv))
			return $RutFrm;
		else
			return '-1';
	}
?>