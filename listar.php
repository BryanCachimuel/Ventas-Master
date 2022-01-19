<?php 
session_start();

if(!$_SESSION['id']){
    header('location:login.php');
}  
?>


<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM productos;");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
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

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap5.min.css">

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
                                    <h2 class="pageheader-title">Productos </h2>
                                    
                                    <div>
                                        <!--<a class="btn btn-success" href="./formulario.php">Nuevo <i class="fa fa-plus"></i></a>-->
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevoproducto">
                                          Nuevo <i class="fa fa-plus"></i>
                                      </button>
                                  </div>
                                  <br>
                                  <table class="table table-bordered" id="productos">
                                    <thead>
                                        <tr>
                                            <!--<th>ID</th>-->
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Precio de compra</th>
                                            <th>Precio de venta</th>
                                            <th>Stock</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($productos as $producto){ ?>
                                            <tr>
                                                <!--<td><?php echo $producto->id ?></td>-->
                                                <td><?php echo $producto->codigo ?></td>
                                                <td><?php echo $producto->descripcion ?></td>
                                                <td><?php echo "$".$producto->precioCompra ?></td>
                                                <td><?php echo "$".$producto->precioVenta ?></td>
                                                <td><?php echo $producto->existencia ?></td>
                                                <td><a class="btn btn-outline-info" href="<?php echo "editar.php?id=" . $producto->id?>"><i class="fa fa-edit"></i></a></td>
                                                <td><a class="btn btn-outline-danger" href="<?php echo "eliminar.php?id=" . $producto->id?>"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    
                    

                    
                </div>
            </div>
            
        </div>
        
    </div>







    <!-- Modal -->
    <div class="modal fade" id="nuevoproducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><h1>Nuevo producto</h1></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         
            <form method="post" action="nuevo.php">
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="codigo">Cód. Barras:</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="descripcion">Descripción: </label>
                    <div class="col-sm-9">
                        <textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="precioVenta">P. Venta:</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="precioVenta" required type="number" step="any" id="precioVenta" placeholder="Precio de venta">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="precioCompra">P. Compra:</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="precioCompra" required type="number" step="any" id="precioCompra" placeholder="Precio de compra">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label" for="existencia">Existencia:</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">
                    </div>
                </div>

                <br><input class="btn btn-info" type="submit" value="Guardar">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </form>


        </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Gua</button>
    </div>-->
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
<!-- chart chartist js -->

<script src="assets/libs/js/dashboard-ecommerce.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</div>


<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap5.min.js"></script> 
<script>
    $(document).ready( function () {
        $('#productos').DataTable({
            "language":{
              "decimal": "",
              "emptyTable": "No hay información",
              "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
              "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
              "infoFiltered": "(Filtrado de _MAX_ total entradas)",
              "infoPostFix": "",
              "thousands": ",",
              "lengthMenu": "Mostrar _MENU_ Entradas",
              "loadingRecords": "Cargando...",
              "processing": "Procesando...",
              "search": "Buscar:",
              "zeroRecords": "Sin resultados encontrados",
              "paginate": {
                  "first": "Primero",
                  "last": "Ultimo",
                  "next": "Siguiente",
                  "previous": "Anterior"
              }
          },
          "lengthMenu": [[5, 10, 15, 20], [5, 10, 15, "All"]
          ],
      });
    });
</script>



</body>

</html>