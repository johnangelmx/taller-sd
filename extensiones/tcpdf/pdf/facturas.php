<?php
error_reporting(0);
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
class imprimirFactura
{
	public $codigo;
	public function traerImpresionFactura()
	{
		// mostrar ventas
		$itemVenta = "codigo";
		$valorVenta = $this->codigo;
		$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);
		$fecha = substr($respuestaVenta["fecha"], 0, -8);
		$productos = json_decode($respuestaVenta["productos"], true);
		$neto = number_format($respuestaVenta["neto"], 2);
		$impuesto = number_format($respuestaVenta["impuesto"], 2);
		$total = number_format($respuestaVenta["total"], 2);
		//TRAEMOS LA INFORMACIÓN DEL CLIENTE
		$itemCliente = "id";
		$valorCliente = $respuestaVenta["id_cliente"];
		$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);
		//TRAEMOS LA INFORMACIÓN DEL VENDEDOR
		$itemVendedor = "id";
		$valorVendedor = $respuestaVenta["id_vendedor"];
		$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);
		require_once('tcpdf_include.php');
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->startPageGroup();
		$pdf->AddPage();
		$bloque1 = <<<EOF
<table >
	<tr>
	<td style="width:150px"><img src="images/car1.png"></td>
	<td style="background-color:white; width:140px">
	<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					NIT: 71.759.963-9
					<br>
					Dirección: Calle 44B 92-11
				</div>
	</td>
	<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					Teléfono: 300 786 52 49
					<br>
					ventas@inventorysystem.com
				</div>
			</td>
			<td FONT COLOR="red" align="center" style="background-color:white; width:110px; text-align:center; color:#ff0000;"><br><br><strong style="color: red;">FACTURA N.<br>$valorVenta</strong></td>
	</tr>
</table>
EOF;
		$pdf->writeHTML($bloque1, false, false, false, false, '');
		$bloque2 = <<<EOF
		<table >
			<tr>
				<td style="width:540px"><img src="images/back.jpg"></td>
			</tr>
		</table>
		<table style="font-size:10px; padding:5px 10px;">
			<tr height="200">
				<td border="1" cellspacing="3" cellpadding="4" style="border: 1px solid black; background-color:white; width:390px">
					Cliente: $respuestaCliente[nombre]
					<br>
				</td>
				<td  align="right" border="1" style="border: 1px solid black; background-color:white; width:150px; text-align:right">
					Fecha: $fecha
				</td>
			</tr>
			<tr>
			<br>
				<td border="1" width="540px">Vendedor: $respuestaVendedor[nombre]</td>
			</tr>
			<tr>
			<td style="border-bottom: 1px solid black; background-color:white; width:540px"></td>
			</tr>
		</table>
	EOF;
		$pdf->writeHTML($bloque2, false, false, false, false, '');
		$bloque3 = <<<EOF
	<table border="1" cellspacing="3" cellpadding="4">
		<tr>
		<td style="border: 1px solid black; background-color:white; width:260px; text-align:center">Producto</td>
		<td style="border: 1px solid black; background-color:white; width:80px; text-align:center">Cantidad</td>
		<td style="border: 1px solid black; background-color:white; width:100px; text-align:center">Valor Unit.</td>
		<td style="border: 1px solid black; background-color:white; width:100px; text-align:center">Valor Total</td>
		</tr>
	</table>
EOF;
		$pdf->writeHTML($bloque3, false, false, false, false, '');
		foreach ($productos as $key => $item) {
			$itemProducto = "descripcion";
			$valorProducto = $item["descripcion"];
			$orden = null;
			$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);
			$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);
			$precioTotal = number_format($item["total"], 2);
			$bloque4 = <<<EOF
				<table border=".5" cellspacing="3" cellpadding="3">
					<tr>
						<td style="border: 1px solid black; color:#333; background-color:white; width:260px; text-align:center">
							$item[descripcion]
						</td>
						<td style="border: 1px solid black; color:#333; background-color:white; width:80px; text-align:center">
							$item[cantidad]
						</td>
						<td style="border: 1px solid black; color:#333; background-color:white; width:100px; text-align:center">$ 
							$valorUnitario
						</td>
						<td style="border: 1px solid black; color:#333; background-color:white; width:100px; text-align:center">$ 
							$precioTotal
						</td>
					</tr>
				</table>
			EOF;
			$pdf->writeHTML($bloque4, false, false, false, false, '');
		}
		$bloque5 = <<<EOF
			<table >
				<tr>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td style="border-right: 1px solid black; color:#333; background-color:white; width:340px; text-align:center"></td>
					<td text-align="right">
						Neto:
					</td>
					<td style="border: 1px solid black; color:#333; background-color:white; width:100px; text-align:center">
						$ $neto
					</td>
				</tr>
				<tr>
					<td style="border-right: 1px solid black; color:#333; background-color:white; width:340px; text-align:center"></td>
					<td style="border: 1px solid black; background-color:white; width:100px; text-align:center">
						Impuesto:
					</td>
					<td style="border: 1px solid black; color:#333; background-color:white; width:100px; text-align:center">
						$ $impuesto
					</td>
				</tr>
				<tr>
					<td style="border-right: 1px solid black; color:#333; background-color:white; width:340px; text-align:center"></td>
					<td style="border: 1px solid black; background-color:white; width:100px; text-align:center">
						Total:
					</td>
					<td style="border: 1px solid black; color:#333; background-color:white; width:100px; text-align:center">
						$ $total
					</td>
				</tr>
			</table>
		EOF;
		$pdf->writeHTML($bloque5, false, false, false, false, '');
		ob_end_clean();
		$pdf->Output('facturas.pdf');
	}
}
$factura = new imprimirFactura();
$factura->codigo = $_GET["codigo"];
$factura->traerImpresionFactura();
