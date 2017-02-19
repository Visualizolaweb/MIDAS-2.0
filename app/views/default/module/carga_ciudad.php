<?php
require_once("../../../conf.ini.php");
require_once("../../../model/class/localizacion.class.php");

$ciudades = Gestion_Localidad::Read_City_byState($_REQUEST["municipio"]);
if(count($ciudades) < 1){
?>
<input  class="form-control" type="text"  id="txt-ciudad" name="txt_cli_ciudad" >
<?php
}else{
?>

<select class="form-control" id="txt-ciudad" name="txt_cli_ciudad" >
  <?php
    foreach($ciudades as $ciudad){
      echo "<option value='".$ciudad[1]."'>$ciudad[2]</option>";
    }
  ?>
</select>
<?php } ?>
