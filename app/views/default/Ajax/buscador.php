<?php
include_once("dbconn.model.php");
include_once("buscador.class.php");



if(isset($_REQUEST['op'])){
	$busqueda = Buscador_Midas::ReadbyId($_REQUEST['id']);
	echo $busqueda['prod_valor'];
}else{
	$ident = $_REQUEST['ident'];
	if($_REQUEST['txt'] != ""){
		$busqueda = Buscador_Midas::SearchAll($_REQUEST['txt']);
		$datos = "";
		$size=1;
	
	   foreach($busqueda as $found){
		   $datos.="<option onclick='colocar(".$ident.",this)' value=".$found[0].">".$found[1]."</option>";
		   $size++;
		}
		if($size==1){
			$datos.="<option> No se encontraron resultados</option>";
			$size ++;
		}
		$datos.="<option style='color:rgba(126,186,0,0.7);cursor:pointer;'>Agregar nuevo item</option>";
		echo $datos."<??>".$size;
	}else{
		echo "";
	}

}

?>