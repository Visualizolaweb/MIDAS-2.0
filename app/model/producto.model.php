<?php
class ProductoModel
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

			$stm = $this->pdo->prepare("SELECT prod_codigo, prod_nombre, prod_valor, prod_valorTotal, imp_porcentaje AS prod_impuesto, prod_descuentos
																			FROM ges_productos
																			INNER JOIN ges_impuestos ON imp_codigo = ges_impuestos_imp_codigo
																			WHERE prod_nombre LIKE  '%$criterio%' OR prod_codigo LIKE '%$criterio%'

																	UNION
	            										SELECT pla_codigo, pla_nombre, pla_valor, pla_valorTotal,  imp_porcentaje AS prod_impuesto, pla_descuento
																			FROM ges_planes
																			INNER JOIN ges_impuestos ON imp_codigo = pla_impuesto
																			WHERE pla_nombre LIKE  '%$criterio%' OR pla_codigo LIKE  '%$criterio%' AND pla_codigo != 'PLA-00001' ORDER BY prod_nombre LIMIT 20");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
