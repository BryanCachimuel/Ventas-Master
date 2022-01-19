<?php 
session_start();

if(!$_SESSION['id']){
	header('location:login.php');
}  
?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT ventas.total, GROUP_CONCAT(productos.codigo, '..',  productos.descripcion, '..', productos_vendidos.cantidad*productos.precioVenta SEPARATOR '__') AS productos FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN productos ON productos.id = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<?php 
	ob_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Ventas</title>
	
	<link rel="stylesheet" href="./css/fontawesome-all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
	<div class="col-md-8 mt-5 mx-auto">
	<h1>Facturación</h1>
	
	<br>
	
	<?php foreach($ventas as $venta){ ?>
		
		<table border="1" class="table table-bordered">
			<thead align="center">
				<!--<tr class="table-dark">-->
				<tr>
					<th>Código</th>
					<th>Descripción</th>
					<th>SubTotal</th>
				</tr>
			</thead>
			<tbody align="center">
				<?php foreach(explode("__", $venta->productos) as $productosConcatenados){ 
					$producto = explode("..", $productosConcatenados)
					?>
					<tr>
						<td><?php echo $producto[0] ?></td>
						<td><?php echo $producto[1] ?></td>
						<td><?php echo $producto[2] ?></td>
					</tr>
				<?php } ?>
					<tr class="bg-info">
						<td colspan="2" align="right">Total a Pagar:</td>
						<td><?php echo $venta->total ?></td>
					</tr>
			</tbody>
		</table>
		<br>
	<?php } ?>

				
	</div>
		
</body>
</html>

<?php 
	$html=ob_get_clean();
	//echo $html;

	require_once 'public/libreria/dompdf/autoload.inc.php';
	use Dompdf\Dompdf;


	$dompdf = new Dompdf();

	$dompdf->loadHtml($html);

	$dompdf->setPaper("letter");

	$dompdf->render();
	$dompdf->stream("factura.pdf", array("Attachment"=>false));
?>