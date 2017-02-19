<?php
class Database
{
    public static function Conectar()
    {
        //  $pdo = new PDO('mysql:host=localhost;dbname=besfit_midas;charset=utf8', 'root', '1037571915');
        $pdo = new PDO('mysql:host=a2plcpnl0603.prod.iad2.secureserver.net;dbname=besfit_midas;charset=utf8', 'besfit_midas', '1d4i5brT1azB');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
