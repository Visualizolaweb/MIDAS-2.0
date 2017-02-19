<?php

class Gestion_Recibocaja{

  function recibobyID($codigo){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_recibo_caja WHERE recaj_numpago = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($codigo));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $result;
  }


    function recibobySede_bynum($numero_recibo, $sede){
    $pdo = MIDAS_DataBase::Connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM ges_recibo_caja WHERE recaj_numpago = ? AND ges_sedes_sed_codigo = ?";

    $query = $pdo->prepare($sql);
    $query->execute(array($numero_recibo, $sede));

    $result = $query->fetch(PDO::FETCH_BOTH);

    MIDAS_DataBase::Disconnect();
    return $result;
  }
}
?>
