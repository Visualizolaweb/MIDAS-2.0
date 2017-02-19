<?php
class Buscador_Midas{
     
function SearchAll($argumento){
    
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT prod_codigo,prod_nombre FROM ges_productos WHERE prod_nombre LIKE '%".$argumento."%'";
    
    $query = $pdo->prepare($sql);
    $query->execute();
    
    $results = $query->fetchALL(PDO::FETCH_BOTH);
    
    MIDAS_DataBase::Disconnect();
    return $results;      
  }

  function ReadbyId($id){

    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT prod_valor FROM ges_productos WHERE prod_codigo=?";

    $query = $pdo->prepare($sql);
    $query->execute(Array($id));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();

    return $result;
  }

  
   }
  ?>