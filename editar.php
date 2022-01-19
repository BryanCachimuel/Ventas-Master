<?php 
    session_start();
  
    if(!$_SESSION['id']){
        header('location:login.php');
    }  
?>
<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM productos WHERE id = ?;");
$sentencia->execute([$id]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
if($producto === FALSE){
	echo "¡No existe algún producto con ese ID!";
	exit();
}

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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

       

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
                                <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-tie"></i> <?php echo ucfirst($_SESSION['nombre']); ?> </a>
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
                                 

                                 <div class="card">
                                    <div class="card-header">
                                      <h3>Editar producto:  <strong><?php echo $producto->descripcion; ?></strong></h3>
                                  </div>
                                  <div class="card-body">
                                   
                                   <form method="post" action="guardarDatosEditados.php">
                                     <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                                     
                                     <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label" for="codigo">Código de barras:</label>
                                        <div class="col-sm-9">
                                           <input value="<?php echo $producto->codigo ?>" class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
                                       </div>
                                   </div>

                                   <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="descripcion">Descripción:</label>
                                    <div class="col-sm-9">
                                       <textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"><?php echo $producto->descripcion ?></textarea>
                                   </div>
                               </div>

                               <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label" for="precioVenta">Precio de venta:</label>
                                <div class="col-sm-9">
                                   <input value="<?php echo $producto->precioVenta ?>" class="form-control" name="precioVenta" required type="number" step="any" id="precioVenta" placeholder="Precio de venta">
                               </div>
                           </div>

                           <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label" for="precioCompra">Precio de compra:</label>
                            <div class="col-sm-9">
                               <input value="<?php echo $producto->precioCompra ?>" class="form-control" name="precioCompra" required type="number" step="any" id="precioCompra" placeholder="Precio de compra">
                           </div>
                       </div>

                       <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label" for="existencia">Existencia:</label>
                        <div class="col-sm-9">
                           <input value="<?php echo $producto->existencia ?>" class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">
                       </div>
                   </div>


                   <br><input class="btn btn-info" type="submit" value="Guardar">
                   <a class="btn btn-warning" href="./listar.php">Cancelar</a>
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
