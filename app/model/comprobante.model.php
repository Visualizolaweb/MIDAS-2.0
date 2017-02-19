<?php
require 'lib/anexgrid.php';
require 'fpdf/fpdf.php';
include 'ChromePhp.php';


class ComprobanteModel
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

	public function Listar()
	{
		try
		{
            /* Instanciamos AnexGRID */
            $anexGrid = new AnexGrid();

            /* Contamos los registros*/
            $total = $this->pdo->query("
                SELECT COUNT(*) Total
                FROM comprobante
            ")->fetchObject()->Total;

            /* Nuestra consulta dinámica */
            $registros = $this->pdo->query("
                SELECT * FROM comprobante
                ORDER BY $anexGrid->columna $anexGrid->columna_orden
                LIMIT $anexGrid->pagina,$anexGrid->limite")->fetchAll(PDO::FETCH_ASSOC
             );

            foreach($registros as $k => $r)
            {
                /* Traemos los clientes que tiene asignado cada comprobante */
                $cliente = $this->pdo->query("SELECT * FROM cliente c WHERE c.id = " . $r['Cliente_id'])
                                ->fetch(PDO::FETCH_ASSOC);

                $registros[$k]['Cliente'] = $cliente;

                /* Traemos el detalle */
                $registros[$k]['Detalle'][] = $this->pdo->query("SELECT * FROM comprobante_detalle cd WHERE cd.Comprobante_id = " . $r['id'])
                                                   ->fetch(PDO::FETCH_ASSOC);

                foreach($registros[$k]['Detalle'] as $k1 => $d)
                {
                    $registros[$k]['Detalle'][$k1]['Producto'] = $this->pdo->query("SELECT * FROM producto p WHERE p.id = " . $d['Producto_id'])
                                                                      ->fetch(PDO::FETCH_ASSOC);
                }
            }

            return $anexGrid->responde($registros, $total);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try
		{
			$stm = $this->pdo->prepare("SELECT * FROM comprobante WHERE id = ?");
			$stm->execute(array($id));

			$c = $stm->fetch(PDO::FETCH_OBJ);

            /* El cliente asignado */
            $c->{'Cliente'} = $this->pdo->query("SELECT * FROM cliente c WHERE c.id = " . $c->Cliente_id)
                                        ->fetch(PDO::FETCH_OBJ);

            /* Traemos el detalle */
            $c->{'Detalle'} = $this->pdo->query("SELECT * FROM comprobante_detalle cd WHERE cd.Comprobante_id = " . $c->id)
                                        ->fetchAll(PDO::FETCH_OBJ);

            foreach($c->Detalle as $k => $d)
            {
                $c->Detalle[$k]->{'Producto'} = $this->pdo->query("SELECT * FROM producto p WHERE p.id = " . $d->Producto_id)
                                                          ->fetch(PDO::FETCH_OBJ);
            }

            return $c;

						// Realizo el pdf de la factura y la guardo.



		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try
		{
			$stm = $this->pdo->prepare("DELETE FROM comprobante WHERE id = ?");
			$stm->execute(array($id));
		}
        catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function RegistrarfacturaPlan($comprobante)
	{

		try
		{

			if($comprobante['afiliacion'] == 1){
				$agenda = "UPDATE ges_agenda SET age_estado = 'Activa' WHERE cli_codigo = ? AND age_estado = 'Sin facturar'";

                $this->pdo->prepare($agenda)
                					->execute(array($comprobante['cliente_id']));
			}


		  /* Registramos el comprobante */
      $sql = "INSERT INTO ges_factura(fac_numero, fac_fecha, fac_plazo, fac_vencimiento, fac_subtotal, fac_total, fac_observacion, ges_clientes_cli_codigo, ges_sedes_sed_codigo, ges_usuarios_usu_codigo, fac_estado, fac_porpagar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
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

                $sql = "INSERT INTO ges_detallefactura (ges_factura_fac_codigo,ges_producto_pro_codigo,det_cantidad)
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

	public function Registrar($comprobante)
	{

		try
		{

 


		  /* Registramos el comprobante */
      $sql = "INSERT INTO ges_factura(fac_numero, fac_fecha, fac_plazo, fac_vencimiento, fac_subtotal, fac_total, fac_observacion, ges_clientes_cli_codigo, ges_sedes_sed_codigo, ges_usuarios_usu_codigo, fac_estado, fac_porpagar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
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

                $sql = "INSERT INTO ges_detallefactura (ges_factura_fac_codigo,ges_producto_pro_codigo,det_cantidad)
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


	public function RegistrarPago($comprobante){

		try{
			foreach($comprobante['items'] as $pago){ 
				$sql = "INSERT INTO ges_pagos (ges_facturas_fac_codigo, pag_destno, ges_formaspago_codigo, pag_valor, pag_fechapag, ges_retenciones_ret_codigo) VALUES (?, ?, ?, ?, ?, ?);";
				$this->pdo->prepare($sql)
									->execute(
										array(
												$pago['codigo_factura'],
												$pago['destino_codigo'],
												$pago['forma_pago_codigo'],
												$pago['total'],
												date("Y-m-d"),
												$pago['retenciones']
										));

				$pago_id = $this->pdo->lastInsertId();
				// ACTUALIZO MI SALDO EN EL BANCO
				$sql = "UPDATE ges_finanzas SET fin_saldo = (? + fin_saldo) WHERE fin_codigo = ?";
	      $this->pdo->prepare($sql)
	                ->execute(
	                  array(
	                      $pago['total'],
	                      $pago['destino_codigo']
	                  ));

	                $caja_cliente = $pago["caja_cliente"];
									$caja_total = $pago["caja_total"];
									$caja_factura = $pago["caja_factura"];
									$caja_sede = $pago["caja_sede"];



			// CONSULTO EL ULTIMO NUMERO DEL RECIBO DE CAJA Y AUMENTO CONSECUTIVO

    $numero = "SELECT MAX(recaj_consecutivo) FROM ges_recibo_caja WHERE recaj_sede = ?";

    $query = $this->pdo->prepare($numero);
    $query->execute(array($caja_sede));

    $numero = $query->fetch(PDO::FETCH_BOTH);
     
    if(($numero[0] > 0)){
      $numero = $numero[0] + 1;   

      
    }else{
      
      $numero = "SELECT * FROM ges_numeracion WHERE ges_sedes_sed_codigo = ?";

      $query = $this->pdo->prepare($numero);
      $query->execute(array($caja_sede));

      $numero = $query->fetch(PDO::FETCH_BOTH);  

      if(($numero[0] < 1)){
        $numero = 1;
      }else{
	      $numero = $numero["num_recibocaja"];
      }
 
     
    }


				$sql = "INSERT INTO ges_recibo_caja  VALUES ('', NOW(), ?, ?, ?, ?, ?, ?);";
				$this->pdo->prepare($sql)
									->execute(
										array(
												$caja_cliente,
												$caja_total,
												$caja_factura,
												$numero,
												$caja_sede,
												$pago_id
										));

			}


			


			if($comprobante["restante"] == 0){
				$estado_factura = "Cerrada";
			}else{
				$estado_factura = "Abierta";
			}

      $sql = "UPDATE ges_factura SET fac_pagado = ( fac_pagado + ? ), fac_porpagar = ?, fac_estado = ? WHERE fac_codigo = ?";
      $this->pdo->prepare($sql)
                ->execute(
                  array(
                      str_replace(',','',$comprobante['total']),
                      $comprobante['restante'],
                      $estado_factura,
                      $pago['codigo_factura'],
                  ));

            return true;
		}
        catch (Exception $e)
		{
			return false;
		}
	}
}
