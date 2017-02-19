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
 
# --> Class: breadcrumbs
# --> Method(s): breadcrumbs()
# --> Author(s): @guille_valen
# --> Date Create: 9/3/2015
# --> Description: Configura los elementos de la paginas
  

class Gestionar_Breadcrumbs{
 
  function breadcrumbs($pag_codigo){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT men_migapan, men_urlmigapan, men_nombre FROM ges_menu WHERE ges_paginas_pag_codigo = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($pag_codigo));
    
    $breadcrumbs = $query->fetch(PDO::FETCH_BOTH);
    
    MIDAS_DataBase::Disconnect();
    
   $page_bread = explode(",",$breadcrumbs[0]);
   $href_bread = explode(",",$breadcrumbs[1]);
   
   $countbread = count($page_bread)-1;
   
   echo '<ol class="breadcrumb">';
   for($i=0;$i<=$countbread;$i++){
     echo "<li><a href='dashboard.php?m=".base64_encode($href_bread[$i])."'>".$page_bread[$i]."</a></li> ";
   }
     echo "<li class='active'>".$breadcrumbs[2]."</li>";
   echo '</ol>';
     
    return $breadcrumbs;
  }
}

?> 