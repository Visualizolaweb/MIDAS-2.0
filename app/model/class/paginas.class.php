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
 
# --> Class: Gestion_Paginas
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @guille_valen
# --> Date Create: 03 Agosto 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_empresa


class Gestion_Paginas{
 
 
  function ReadbyID($pag_codigo){
  
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM ges_paginas WHERE pag_codigo = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($pag_codigo));
    
    $result = $query->fetch(PDO::FETCH_BOTH);
    
    MIDAS_DataBase::Disconnect();
    
    return $result;
  }
  
   
    
}
?>