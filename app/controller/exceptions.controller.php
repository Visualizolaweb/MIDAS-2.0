<?php 

$cod_error = $e->getCode();
$pag_error = $e->getFile();
$pag_linea = $e->getLine();
$exception_e = base64_encode("Oops! Error N°: $cod_error. No se pudo realizar la acción correctamente, favor notificarle al administrador del Sistema. ");
 

?>