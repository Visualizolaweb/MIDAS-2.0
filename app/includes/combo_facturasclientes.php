  <?php
 include("../model/dbconn.php");
 	$fetch = mysql_query ("SELECT * FROM ges_factura WHERE ges_clientes_cli_codigo = '".$_REQUEST['clicod']."' AND fac_porpagar>0");
 	while ($row = mysql_fetch_array($fetch)) {
        echo "<option>Seleccione Factura</option>";
        echo "<option  value='".$row["fac_numero"]."'>".$row["fac_numero"]."</option>";
   }
 ?>
