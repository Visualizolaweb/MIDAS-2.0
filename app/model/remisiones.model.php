<?php
 

class RemisionModel
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

	public function Registrar($comprobante)
	{

		try
		{

		  /* Registramos el comprobante */
      $sql = "INSERT INTO ges_remisiones(fac_numero, fac_fecha, fac_plazo, fac_vencimiento, fac_subtotal, fac_total, fac_observacion, ges_clientes_cli_codigo, ges_sedes_sed_codigo, ges_usuarios_usu_codigo, fac_estado, fac_porpagar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
      $this->pdo->prepare($sql)
                ->execute(
                  array(
                      $comprobante['fac_num'],
                      $comprobante['fac_fecha'],
                      $comprobante['fac_plazo'],
                      $comprobante['fac_vencimiento'],
                      $comprobante['subtotal'],
                      $comprobante['total'],
                      $comprobante['fac_observacion'],
                      $comprobante['cliente_id'],
                      $comprobante['sede_id'],
                      $comprobante['usuario_id'],
											$comprobante['estado'],
                      $comprobante['total'],
                  ));


            /* El ultimo ID que se ha generado */
            // $comprobante_id = $comprobante['fac_num'];
						$comprobante_id = $this->pdo->lastInsertId();

            // /* Recorremos el detalle para insertar */

						foreach($comprobante['items'] as $d)
            {

                $sql = "INSERT INTO ges_detalleremision (ges_factura_fac_codigo,ges_producto_pro_codigo,det_cantidad)
                        VALUES (?, ?, ?)";

                $this->pdo->prepare($sql)
                          ->execute(
                            array(
                                $comprobante_id,
                                $d['producto_id'],
                                $d['cantidad'],
                            ));

                $sql_producto = "UPDATE ges_productos SET prod_cant = (prod_cant - ?) WHERE prod_codigo = ?";

                $this->pdo->prepare($sql_producto)
                					->execute(array($d['cantidad'], $d['producto_id']));
            }

            return true;
		}
        catch (Exception $e)
		{
			return false;
		}
	}


	
}
