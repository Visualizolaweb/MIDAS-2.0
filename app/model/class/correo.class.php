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
 
# --> Class: Gestion_Estudios
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @malvarez
# --> Date Create: 8 de Diciembre de 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_correo

require_once("../../conf.ini.php");

class Gestion_Correo{
     
  /**********************************************
   * Create()                                   *
   * Metodo que guarda archivos en ges_correo   *  
   **********************************************/
  
  function Create($cod_correo, $tra_codigo, $cor_estado, $cor_observacion, $cor_fechacre){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO ges_correo VALUES (?,?,?,?,?)";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($cod_correo, $tra_codigo, $cor_estado, $cor_observacion, $cor_fechacre));
    
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
    
    $sql = "SELECT * FROM ges_correo ORDER BY cod_correo DESC";
    
    $query = $pdo->prepare($sql);
    $query->execute();
    
    $results = $query->fetchALL(PDO::FETCH_BOTH);
    
    MIDAS_DataBase::Disconnect();
    return $results;      
  }
  
  function ReadbyID($cod_correo){
  
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM ges_correo WHERE cod_correo = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($cod_correo));
    
    $result = $query->fetch(PDO::FETCH_BOTH);
    
    MIDAS_DataBase::Disconnect();
    
    return $result;
  }
  
  /**********************************************
   * Update()                                   *
   * Metodo  de Actualización de registro       *
   **********************************************/
  
  function Update(){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "UPDATE ges_correo SET tra_codigo = ?, cor_estado = ?, cor_observacion = ?
            WHERE cod_correo = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($tra_codigo, $cor_estado, $cor_observacion, $cod_correo,));
    
    MIDAS_DataBase::Disconnect();      
  }
  
   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/ 
  
  function Delete($$cod_correo,){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "DELETE FROM ges_correo WHERE $cod_correo, = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($cod_correo,));
    
    MIDAS_DataBase::Disconnect();
  }
    
    }?>