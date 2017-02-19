<input type="hidden" id="nuevoingreso" value="<?php echo $_acc_tour; ?>">
<input type="hidden" id="demotour" value="<?php echo $_acc_primeravez; ?>">

<div id="dd"></div>
<?php

if($_acc_primeravez == 0){

?>

 <div class="modal fade modal-welcome" id="saludo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    HOLA, <?php echo $once_name[0]; ?><BR> TE DAMOS LA BIENVENIDA A MIDAS. <br>
    <div style="font-family:'Arial Narrow'; font-size:15px;">
    <p>Para hacer uso correcto de la aplicación necesitamos que nos colabores terminando de configurar los datos necesarios de al menos uno de los laboratorios que tiene tu franquicia, de igual modo, completar algunos datos de la empresa, del usuario y del laboratorio. </p>
    <p>No te preocupes esta configuración solo se aplica una vez. </p>
  </div>
    <div class="btns">
      <button id="no-take-tour" class="btn btn-primary">LO ENTIENDO.</button>
    </div>
</div>



<?php
}
?>
