<?php
if(isset($_POST["txt_usu_documento"]) or isset($_POST["txt_acc_clave"])){
		sleep(1);
		if($_POST["txt_usu_codigo"]=="besmart" and $_POST["txt_acc_clave"]=="besmart"){ 
			$return_arr["status"]=1;		
		}else{
			$return_arr["status"]=0;	
		}  //end else
		echo json_encode($return_arr); // return value 
exit();
}
?>