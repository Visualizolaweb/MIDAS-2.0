<?php
session_start();
require_once("../conf.ini.php");
require_once("../model/class/bancos.class.php");


    $codigo_banco = "BAN-".date('Hms');
    $banco_nombre = $_POST['suggest'];
    $ban_fecha_creacion = date('Y-m-d');

		$autor = $_SESSION["usu_nombre"].' '.$_SESSION["usu_apellido_1"];
    $bancos = Gestion_Bancos::Create($codigo_banco, $banco_nombre, $ban_fecha_creacion, $autor );

    $bancos = Gestion_Bancos::ReadAll();
?>

<div class="row">
	<div class="col-md-12">
	  <div class="form-group">
	    <label class="control-label">Banco</label>
	    <select name="banco_nombre" parsley-required="true"  class="selectpicker form-control"    title="Seleccionar un Banco"  data-header="Seleccionar un Banco">
	      <?php
	        foreach ($bancos as $row) {
	        	if ($row['ban_codigo'] != $codigo_banco) {
	        		echo "<option  value='".$row['ban_codigo']."'>".$row['ban_banco']."</option>";
	        	} else {
	        		echo "<option selected='selected' value='".$row['ban_codigo']."'>".$row['ban_banco']."</option>";
	        	}
	        }
	      ?>
	    </select>

	  </div>
	</div>
</div>
