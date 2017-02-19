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
 
# --> Class: Gestion_Retencion
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @guille_valen
# --> Date Create: 4 de Agosto 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_perfiles
 
class Gestion_Retencion{
  
     
  /**********************************************
   * Create()                                   *
   * Metodo que guarda archivos en ges_retenciones *  
   **********************************************/
  
  function Create($ret_codigo, $ret_nombre, $ret_tipo_retencion, $ret_porcentaje, $ret_descripcion, $ret_autor, $ret_fecha_creacion){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO ges_retenciones VALUES (?,?,?,?,?,?,?)";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($ret_codigo, $ret_nombre, $ret_tipo_retencion, $ret_porcentaje, $ret_descripcion, $ret_autor, $ret_fecha_creacion));
    
    MIDAS_DataBase::Disconnect(); 
  }
  
  /**********************************************
   * ReadAll() - ReadbyID()                     *
   * Metodos de lectura y consulta, uno es para *
   * todos los registros y otro se consulta por *
   * codigo                                     *
   **********************************************/
  
  function ReadAll(){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM ges_retenciones ORDER BY ret_nombre ASC";
    
    $query = $pdo->prepare($sql);
    $query->execute();
    
    $results = $query->fetchALL(PDO::FETCH_BOTH);
    
    MIDAS_DataBase::Disconnect();
    return $results;      
  }
  
  function ReadbyID($per_codigo){
  
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM ges_retenciones WHERE ret_codigo = ?  ";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($per_codigo));
    
    $result = $query->fetch(PDO::FETCH_BOTH);
    
    MIDAS_DataBase::Disconnect();
    
    return $result;
  }

  function ReadLastItem(){
  
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM ges_retenciones ORDER BY ret_fecha_creacion DESC LIMIT 1";
    
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
  
  function Update($ret_codigo, $ret_nombre, $ret_tipo_retencion, $ret_porcentaje, $ret_descripcion){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "UPDATE ges_retenciones SET ret_nombre = ?, ret_tipo_retencion = ?, ret_porcentaje = ?, ret_descripcion = ? WHERE ret_codigo = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($ret_nombre, $ret_tipo_retencion, $ret_porcentaje, $ret_descripcion, $ret_codigo));
    
    MIDAS_DataBase::Disconnect();      
  }
  
   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/ 
  
  function Delete($per_codigo){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "DELETE FROM ges_retenciones WHERE ret_codigo = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($per_codigo));
    
    
    MIDAS_DataBase::Disconnect();
    
    
  }
    
}
?>