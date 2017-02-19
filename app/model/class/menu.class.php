<?php

/*  ███╗   ███╗██╗██████╗  █████╗ ███████╗ Versión
    ████╗ ████║██║██╔══██╗██╔══██╗██╔════╝   1.0
    ██╔████╔██║██║██║  ██║███████║███████╗
    ██║╚██╔╝██║██║██║  ██║██╔══██║╚════██║
    ██║ ╚═╝ ██║██║██████╔╝██║  ██║███████║
    ╚═╝     ╚═╝╚═╝╚═════╝ ╚═╝  ╚═╝╚══════╝
          Development by SINAPPSIS Lab
    Released under the Free Software License
-------------------------------------------------- */

# --> Class: Gestion_Menu
# --> Method(s): Load_menubyUID(seccion,perfil)
# --> Author(s): @guille_valen
# --> Date Create: 9/3/2015
# --> Description: La clase permite gestionar el menu de MIDAS

class Gestion_Menu{

  function Load_menu($per_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_perfiles
            INNER JOIN ges_permisos ON ges_perfiles_per_codigo = per_codigo
            INNER JOIN ges_menu ON ges_menu_men_codigo = men_codigo
            INNER JOIN ges_paginas ON ges_paginas_pag_codigo = pag_codigo
            WHERE per_codigo = ? AND (men_visible = 'SI' OR men_visible = 'si') AND per_estado = 'Activo' ORDER BY men_orden";

    $query = $pdo->prepare($sql);
    $query->execute(array($per_codigo));

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function Load_icon($codigo_pagina){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT men_icono FROM ges_menu WHERE ges_paginas_pag_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($codigo_pagina));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  function Load_menu_subpage($seccion, $per_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_perfiles
            INNER JOIN ges_permisos ON ges_perfiles_per_codigo = per_codigo
            INNER JOIN ges_menu ON ges_menu_men_codigo = men_codigo
            INNER JOIN ges_paginas ON ges_paginas_pag_codigo = pag_codigo
            WHERE men_seccion = ? AND per_codigo = ? AND (men_visible = 'SI' OR men_visible = 'si') AND per_estado = 'Activo' ORDER BY men_orden";

    $query = $pdo->prepare($sql);
    $query->execute(array($seccion, $per_codigo));

    $result = $query->fetchALL(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }


  function View_menu($seccion, $per_codigo){
    $result = Gestion_Menu::Load_menu($per_codigo);

    if($seccion == "menu"){
      $toggle = "data-toggle='tooltip'";
      }else{
        $toggle = "";
      }

		foreach($result as $row){
		  if($row["men_seccion"]==$seccion){
			  if($row["men_seccion"] == "menu"){
          if(!isset($_REQUEST["m"])){
               $class = "";
          }else{
              if(base64_decode($_REQUEST["m"]) == $row["pag_archivo"]){
                $class = "class='menu_activo'";
              }else{
                $class = "";
              }
          }



					echo "<li $class>
							<a href='dashboard.php?m=".base64_encode($row["pag_archivo"])."&pagid=".base64_encode($row["ges_paginas_pag_codigo"])."' $toggle title='".$row["men_nombre"]."' data-container='body'  data-placement='right'>
							<span>
							  <i class='icon ".$row["men_icono"]."' ></i>
							  ".$row["men_nombre"]."
							</span>
							</a>
						  </li>";
        }elseif($row["men_seccion"] == "header"){
            echo '<li><a href="dashboard.php?m='.base64_encode($row["pag_archivo"]).'&pagid='.base64_encode($row["ges_paginas_pag_codigo"]).'">
                  <i class="'.$row["men_icono"].'"></i> '.$row["men_nombre"].'</a></li>';
				  }else{

					 echo '<div class="col-lg-3 thum" >
						   <a href="dashboard.php?m='.base64_encode($row["pag_archivo"]).'&pagid='.base64_encode($row["ges_paginas_pag_codigo"]).'">

							 <section class="panel corner-flip">
							  <span class="'.$row["men_icono"].'"></span>
							  <h4>'.$row["men_nombre"].'</h4>
							  <p>'.$row["men_descripcion"].'</p>
							 </section>
						   </a>
						  </div>';
				  }
		}
	}
    return $result;
  }

  function View_submenu($seccion, $per_codigo, $pagina){
    $result = Gestion_Menu::Load_menu_subpage($seccion,$per_codigo);
    echo '<nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <h3 class="navbar-header" >
          <a class="navbar-brand" href="#" >'.$seccion.'</a>
        </h3>
        <div>
          <ul class="nav navbar-nav">';

          foreach($result as $row){
              if($pagina == $row["ges_paginas_pag_codigo"]){
                $clase = "active";
              }else{
                $clase = "";
              }
              echo '<li class='.$clase.'><a href="dashboard.php?m='.base64_encode($row["pag_archivo"]).'&pagid='.base64_encode($row["ges_paginas_pag_codigo"]).'">'.$row["men_nombre"].'</a></li>';
          }

    echo      '</ul>
        </div>
      </div>
    </nav>';
  }

  function Load_permits($pag_codigo){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_perfiles
            INNER JOIN ges_permisos ON ges_perfiles_per_codigo = per_codigo
            INNER JOIN ges_menu ON ges_menu_men_codigo = men_codigo
            INNER JOIN ges_paginas ON ges_paginas_pag_codigo = pag_codigo
            WHERE pag_codigo = ? AND (men_visible = 'SI' OR men_visible = 'si') AND per_estado = 'Activo'";

    $query = $pdo->prepare($sql);
    $query->execute(array($pag_codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

}
?>
