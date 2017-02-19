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
 
# --> Class: Gestion_Traslados
# --> Method(s): create(), readAll(), readbyID(), delete(), update()
# --> Author(s): @malvarez
# --> Date Create: 8 de Diciembre de 2015
# --> Description: La clase controla todas las acciones sobre la tabla ges_traslados



class Gestion_Traslados{
     
  /**********************************************
   * Create()                                   *
   * Metodo que guarda archivos en ges_traslados *  
   **********************************************/
  
  function Create($tra_codigo, $cli_codigo, $tra_laborigen, $tra_labdestino, $tra_motivos, $tra_valor, $tra_estado, 
                  $tra_autor, $tra_aprobadopor, $tra_fechacre,$comision, $tra_saldofavor,$obsequio){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO ges_traslados VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $query = $pdo->prepare($sql);

    $query->execute(array($tra_codigo,$cli_codigo,$tra_laborigen,$tra_labdestino,$tra_motivos,$tra_valor,$tra_estado,$tra_autor,$tra_aprobadopor,$tra_fechacre,$comision,$tra_saldofavor,$obsequio));
    
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
    
    $sql = "SELECT * FROM ges_traslados ORDER BY tra_codigo DESC";
    
    $query = $pdo->prepare($sql);
    $query->execute();
    
    $results = $query->fetchALL(PDO::FETCH_BOTH);
    
    MIDAS_DataBase::Disconnect();
    return $results;      
  }
  
  function ReadbyID($tra_cod){
  
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM ges_traslados WHERE tra_codigo = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($tra_cod));
    
    $result = $query->fetch(PDO::FETCH_BOTH);
    
    MIDAS_DataBase::Disconnect();
    
    return $result;
  }
// Función para los traslados Enviados desde la sede 
 function ReadbyIDSede($sede_codigo){
  
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM ges_traslados INNER JOIN ges_sedes ON ges_sedes.sed_codigo = ges_traslados.tra_laborigen WHERE tra_laborigen = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($sede_codigo));
    
    $result = $query->fetchALL(PDO::FETCH_BOTH);
    
    MIDAS_DataBase::Disconnect();
    
    return $result;
  }
// Función para los traslados Recibidos en la sede 
function ReadbyIDSedeRecibidos($sede_codigo){
  
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM ges_traslados WHERE tra_labdestino = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($sede_codigo));
    
    $result = $query->fetchALL(PDO::FETCH_BOTH);
    
    MIDAS_DataBase::Disconnect();
    
    return $result;
  }

    function ReadLastItem(){
  
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM ges_traslados ORDER BY tra_fechacre ASC LIMIT 1";
    
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
  
  function Update($tra_codigo, $cli_codigo, $tra_laborigen, $tra_labdestino, $tra_motivos, $tra_valor, $tra_estado, 
                  $tra_autor, $tra_aprobadopor){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "UPDATE ges_traslados SET cli_codigo = ?, tra_laborigen = ?, tra_labdestino = ?, tra_motivos = ?, tra_valor = ?, tra_estado = ?, 
                   tra_autor = ?, tra_aprobadopor = ?
                   WHERE tra_codigo = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($cli_codigo, $tra_laborigen, $tra_labdestino, $tra_motivos, $tra_valor, $tra_estado, 
                  $tra_autor, $tra_aprobadopor, $tra_codigo));
    
    MIDAS_DataBase::Disconnect();      
  }

function UpdateEstado($tra_codigo){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "UPDATE ges_traslados SET  tra_estado = 1 WHERE tra_codigo = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($tra_codigo));
    
    MIDAS_DataBase::Disconnect();      
  }
  
   /*********************************************
   * Delete()                                   *
   * Metodo de eliminación de registro          *
   **********************************************/ 
  
  function Delete($tra_codigo){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "DELETE FROM ges_traslados WHERE tra_codigo = ?";
    
    $query = $pdo->prepare($sql);
    $query->execute(array($tra_codigo));
    
    MIDAS_DataBase::Disconnect();
  }
    
}?>