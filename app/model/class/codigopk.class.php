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
 
# --> Class: Gestion_Perfiles
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @guille_valen
# --> Date Create: 6 Julio 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_perfiles

@include_once("../../conf.ini.php");

class Codigo_PK{
  
  
  function GenerarCodigo($campo, $tabla, $pfx){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $range = '0123456789';
    $code = '';
    $characters = mt_rand(3,7);
    $i = 0;

    while($i < $characters){ 
        $code .= substr($range, mt_rand(  0, strlen($range)-1), 1);
        $i++;
    }
    
    $unique = $pfx.'-0'.$code;
    
    $sql = "SELECT $campo FROM $tabla WHERE $campo = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($unique));
    
    $num = $query->rowCount();
    
    if($num > 0){
      
       return GenerarCodigo($campo,$tabla,$pfx);
       
    }else{     
       
       MIDAS_DataBase::Disconnect();
       return $unique;
    }
    
    
  }
  
  
}
  