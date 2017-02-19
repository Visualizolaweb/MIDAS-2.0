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
 
# --> Class: Gestion_Inbody
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @mmalvarez
# --> Date Create: 25 de Enero 2016
# --> Description: La clase controla todas las acciones sobre la tabla ges_inbody


class Gestion_Inbody{
     
  /**********************************************
   * Create()                                   *
   * Metodo que guarda archivos en ges_inbody   *  
   **********************************************/
  
  function Create($inb_codigo, $inb_codigo_be, $cli_nombre, $inb_edad, $inb_altura, $inb_peso, $inb_sexo, $inb_tasmetbas, $inb_porgrascor, 
                  $inb_dieta, $inb_patologias, $inb_fecha){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO ges_inbody VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($inb_codigo, $inb_codigo_be, $cli_nombre, $inb_edad, $inb_altura, $inb_peso, $inb_sexo, $inb_tasmetbas, $inb_porgrascor, 
                          $inb_dieta, $inb_patologias, $inb_fecha));
    
    MIDAS_DataBase::Disconnect(); 
  }
  
  /**********************************************
   * ReadAll() - ReadbyID() - ReadlastItem()    *
   * Metodos de lectura y consulta, uno es para *
   * todos los registros y otro se consulta por *
   * codigo                                     *
   **********************************************/
  
  function ReadAll(){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM ges_inbody ORDER BY inb_fecha DESC";
    
    $query = $pdo->prepare($sql);
    $query->execute();
    
    $results = $query->fetchALL(PDO::FETCH_BOTH);
    
    MIDAS_DataBase::Disconnect();
    return $results;      
  }
  
  function ReadbyID($inb_codigo){
  
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM ges_inbody WHERE inb_codigo = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($inb_codigo));
    
    $result = $query->fetch(PDO::FETCH_BOTH);
    
    MIDAS_DataBase::Disconnect();
    
    return $result;
  }
  
  function ReadLastItem(){
  
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM ges_inbody ORDER BY inb_codigo DESC LIMIT 1";
    
    $query = $pdo->prepare($sql);
    $query->execute();
    
    $result = $query->fetch(PDO::FETCH_BOTH);
    
    MIDAS_DataBase::Disconnect();
    
    return $result;
  }
  /**********************************************
   * Update()                                   *
   * Metodo  de Actualización de registro       *
   **********************************************/
  
  function Update($inb_altura, $inb_peso, $inb_patologias, $inb_fecha,$inb_codigo){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    $sql = "UPDATE ges_inbody SET  inb_altura = ?, inb_peso = ?, inb_patologias = ?, inb_fecha = ?
                                    
            WHERE inb_codigo = ?";
  
    $query = $pdo->prepare($sql);
    $query->execute(array($inb_altura, $inb_peso, $inb_patologias, $inb_fecha, $inb_codigo));
     
    MIDAS_DataBase::Disconnect();      
  }
  
   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/ 
  
  function Delete($inb_codigo){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "DELETE FROM ges_inbody WHERE inb_codigo = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($inb_codigo));
    
    MIDAS_DataBase::Disconnect();
  }
    
}
?>