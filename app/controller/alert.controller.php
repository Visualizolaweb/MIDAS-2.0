<?php

$title_alert = "";

if(isset($_REQUEST["men"])){

?>
<script>
$(document).ready(function() {
	swal({
		title: "Error!",
		text: "Debes iniciar sesión primero para poder ingresar",
		type: "error",
		confirmButtonText: "Entendido" });
});
		</script>
<?php
}
 

?>
