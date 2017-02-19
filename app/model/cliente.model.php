<?php
class ClienteModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
            $this->pdo = Database::Conectar();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Buscar($criterio)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT cli_codigo, CONCAT( cli_nombre,  ' ', cli_apellido ) AS cli_nombre, cli_identificacion, cli_direccion FROM ges_clientes WHERE cli_nombre LIKE  '%$criterio%' OR cli_identificacion LIKE  '%$criterio%' UNION SELECT pro_codigo, pro_nombre, pro_nit, pro_direccion FROM ges_proveedores WHERE pro_nombre LIKE  '%$criterio%' OR pro_nit LIKE  '%$criterio%' ORDER BY cli_nombre LIMIT 20");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
