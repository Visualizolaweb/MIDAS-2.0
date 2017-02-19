<ul class="tooltip-area">

  <?php
    if(!isset($_REQUEST["m"])){
       $class = "class='menu_activo'";
    }
  ?>
  <li <?php echo @$class ?>>
	<a href='dashboard.php' data-toggle='tooltip' title='REGRESAR AL INICIO' data-container='body'  data-placement='right'>
	<span>
	  <i class='icon fa fa-home' ></i>
	  Inicio
	</span>
	</a>
  </li>
  <?php Gestion_Menu::View_menu("menu",$_usu_per_codigo) ?>
</ul>
