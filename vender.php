<?php 
session_start();
if(!$_SESSION['id']){
	header('location:login.php');
}  
//include_once "encabezado.php";
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>

<?php  

include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT codigo FROM productos");
$codigoProd = $sentencia->fetchAll(PDO::FETCH_OBJ);

?>
<?php 
session_start();
if(!$_SESSION['id']){
	header('location:login.php');
}  
//include_once "encabezado.php";
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>

<?php  

include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT codigo FROM productos");
$codigoProd = $sentencia->fetchAll(PDO::FETCH_OBJ);

?>


<!doctype html>
	<html lang="en">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
		<link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/libs/css/style.css">

		<title>Sistemas de Ventas</title>
	</head>

	<body>
		<!-- ============================================================== -->
		<!-- main wrapper -->
		<!-- ============================================================== -->
		<div class="dashboard-main-wrapper">
			<!-- ============================================================== -->
			<!-- navbar -->
			<!-- ============================================================== -->
			<div class="dashboard-header">
				<nav class="navbar navbar-expand-lg bg-dark fixed-top">
					<a class="navbar-brand" href="listar.php">Sistema de Ventas</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse " id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto navbar-right-top">

							<li class="nav-item dropdown nav-user">
								<a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"> <?php echo ucfirst($_SESSION['nombre']); ?> </a>
								<div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
									<div class="nav-user-info">
										<h5 class="mb-0 text-white nav-user-name"><?php echo ucfirst($_SESSION['nombre']); ?></h5>
										<span class="status"></span><span class="ml-2">Administrador</span>
									</div>

									<a class="dropdown-item" href="logout.php?logout=true"><i class="fas fa-power-off mr-2"></i>Cerrar Sesión</a>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>

			<div class="nav-left-sidebar sidebar-dark">
				<div class="menu-list">
					<nav class="navbar navbar-expand-lg navbar-light">
						<a class="d-xl-none d-lg-none" href="#">Dashboard</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarNav">
							<ul class="navbar-nav flex-column">
								<li class="nav-divider">
									Menu
								</li>
								<li class="nav-item ">
									<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fas fa-home"></i>Inicio <span class="badge badge-success">6</span></a>
									<div id="submenu-1" class="collapse submenu" style="">
										<ul class="nav flex-column">
											<li class="nav-item">
												<a class="nav-link" href="listar.php">Productos en Stock</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-shopping-cart"></i>Realizar Ventas</a>
									<div id="submenu-2" class="collapse submenu" style="">
										<ul class="nav flex-column">
											<li class="nav-item">
												<a class="nav-link" href="vender.php">Vender<span class="badge badge-secondary">New</span></a>
											</li>
										</ul>
									</div>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-dollar-sign"></i>Ventas Generadas</a>
									<div id="submenu-3" class="collapse submenu" style="">
										<ul class="nav flex-column">
											<li class="nav-item">
												<a class="nav-link" href="ventas.php">Ventas</a>
											</li>
										</ul>
									</div>
								</li>

								<li class="nav-item">
									<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-3"><i class="far fa-address-card"></i></i>Registrar Cajero</a>
									<div id="submenu-4" class="collapse submenu" style="">
										<ul class="nav flex-column">
											<li class="nav-item">
												<a class="nav-link" href="registro.php">Registro</a>
											</li>
										</ul>
									</div>
								</li>


							</ul>
						</div>
					</nav>
				</div>
			</div>

			<div class="dashboard-wrapper">
				<div class="dashboard-ecommerce">
					<div class="container-fluid dashboard-content ">



						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="page-header">
									<h2 class="pageheader-title">Vender </h2>




									<?php
									if(isset($_GET["status"])){
										if($_GET["status"] === "1"){
											?>
											<div class="col-md-4 mx-auto">
												<div class="alert alert-success alert-dismissible fade show" role="alert">
													<strong>Venta realizada correctamente</strong>
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													    <span aria-hidden="true">&times;</span>
													 </button>
												</div>
											</div>

											<?php
										}else if($_GET["status"] === "2"){
											?>
											<div class="col-md-3 mx-auto">
												<div class="alert alert-info alert-dismissible fade show" role="alert">
													<strong>Venta cancelada</strong>
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													    <span aria-hidden="true">&times;</span>
													 </button>
												</div>
											</div>
											<?php
										}else if($_GET["status"] === "3"){
											?>
											<div class="col-md-4 mx-auto">
												<div class="alert alert-info alert-dismissible fade show" role="alert">
													<strong>Ok, Producto quitado de la lista</strong>
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													    <span aria-hidden="true">&times;</span>
													 </button>
												</div>
											</div>
											<?php
										}else if($_GET["status"] === "4"){
											?>
											<div class="col-md-4 mx-auto">
												<div class="alert alert-warning alert-dismissible fade show" role="alert">
													<strong>Error: El producto que buscas no existe</strong>
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													    <span aria-hidden="true">&times;</span>
													 </button>
												</div>
											</div>
											<?php
										}else if($_GET["status"] === "5"){
											?>
											<div class="col-md-4 mx-auto">
												<div class="alert alert-danger alert-dismissible fade show" role="alert">
													<strong>Error: El producto está agotado</strong>
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													    <span aria-hidden="true">&times;</span>
													  </button>
												</div>
											</div>
											<?php
										}else{
											?>
											<div class="col-md-4 mx-auto">
												<div class="alert alert-danger alert-dismissible fade show" role="alert">
													<strong>Error: Algo salió mal mientras se realizaba la venta</strong>
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													    <span aria-hidden="true">&times;</span>
													  </button>
												</div>
											</div>
											<?php
										}
									}
									?>
									<br>



									<div class="row">


										<div class="col-md-4">
											<form method="post" action="agregarAlCarrito.php">
												<div class="mb-3 row">
													<label class="col-sm-3 col-form-label" for="codigo">C. Barras:</label>
													<div class="col-sm-9">
														<input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
													</div>
												</div>
											</form>
										</div>


										<div class="col-md-8">

											<table class="table table-bordered">
												<thead>
													<tr>

														<th>Código</th>
														<th>Descripción</th>
														<th>Precio de venta</th>
														<th>Cantidad</th>
														<th>Total</th>
														<th>Quitar</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($_SESSION["carrito"] as $indice => $producto){ 
														$granTotal += $producto->total;
														?>
														<tr>

															<td><?php echo $producto->codigo ?></td>
															<td><?php echo $producto->descripcion ?></td>
															<td><?php echo "$".$producto->precioVenta ?></td>
															<td><?php echo $producto->cantidad ?></td>
															<td><?php echo "$".$producto->total ?></td>
															<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>">Eliminar</a></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
											<br>
											<h3>Total: <?php echo "$".$granTotal; ?></h3>
											<form action="./terminarVenta.php" method="POST">
												<input name="total" type="hidden" value="<?php echo $granTotal;?>">
												<button type="submit" class="btn btn-success">Terminar venta</button>
												<a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
											</form>



										</div>




									</div>






								</div>
							</div>
						</div>




					</div>
				</div>

			</div>

		</div>




























		<!-- Optional JavaScript -->
		<!-- jquery 3.3.1 -->
		<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
		<!-- bootstap bundle js -->
		<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
		<!-- slimscroll js -->
		<script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
		<!-- main js -->
		<script src="assets/libs/js/main-js.js"></script>
	
		<script src="assets/libs/js/dashboard-ecommerce.js"></script>


		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	</div>

</body>

</html>