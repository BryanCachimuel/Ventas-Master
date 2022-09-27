<?php
session_start();
require_once('base_de_datos.php');

if(isset($_POST['submit']))
{
    if(isset($_POST['nombre'],$_POST['apellido'],$_POST['email'],$_POST['password']) && !empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['email']) && !empty($_POST['password']))
    {
        $firstName = trim($_POST['nombre']);
        $lastName = trim($_POST['apellido']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $hashPassword = $password;
        $options = array("cost"=>4);
        $hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
        $date = date('Y-m-d H:i:s');

        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $sql = 'select * from users where email = :email';
            $stmt = $base_de_datos->prepare($sql);
            $p = ['email'=>$email];
            $stmt->execute($p);
            
            if($stmt->rowCount() == 0)
            {
                $sql = "insert into users (nombre, apellido, email, `password`, created_at,updated_at) values(:vnombre,:vapellido,:email,:pass,:created_at,:updated_at)";

                try{
                    $handle = $base_de_datos->prepare($sql);
                    $params = [
                        ':vnombre'=>$firstName,
                        ':vapellido'=>$lastName,
                        ':email'=>$email,
                        ':pass'=>$hashPassword,
                        ':created_at'=>$date,
                        ':updated_at'=>$date
                    ];
                    
                    $handle->execute($params);
                    
                    $success = 'Usuario creado correctamente!!';
                    
                }
                catch(PDOException $e){
                    $errors[] = $e->getMessage();
                }
            }
            else
            {
                $valFirstName = $firstName;
                $valLastName = $lastName;
                $valEmail = '';
                $valPassword = $password;

                $errors[] = 'el Email ya esta registrado';
            }
        }
        else
        {
            $errors[] = "el Email no es valido";
        }
    }
    else
    {
        if(!isset($_POST['nombre']) || empty($_POST['nombre']))
        {
            $errors[] = 'el nombre es requerido';
        }
        else
        {
            $valFirstName = $_POST['apellido'];
        }
        if(!isset($_POST['apellido']) || empty($_POST['apellido']))
        {
            $errors[] = 'el apellido es requerido';
        }
        else
        {
            $valLastName = $_POST['apellido'];
        }

        if(!isset($_POST['email']) || empty($_POST['email']))
        {
            $errors[] = 'Email es requerido';
        }
        else
        {
            $valEmail = $_POST['email'];
        }

        if(!isset($_POST['password']) || empty($_POST['password']))
        {
            $errors[] = 'el Password es requerido';
        }
        else
        {
            $valPassword = $_POST['password'];
        }
        
    }

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
     

            <div class="dashboard-wrapper">
                <div class="dashboard-ecommerce">
                    <div class="container-fluid dashboard-content ">

                   

                        <div class="row">
                            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-7 mx-auto">
                                <div class="page-header">


                                   <?php 
                                   if(isset($errors) && count($errors) > 0)
                                   {
                                    foreach($errors as $error_msg)
                                    {
                                        /*echo '<div class="alert alert-danger">'.$error_msg.'</div>';*/
                                        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>'.$error_msg.'</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                                    }
                                }

                                if(isset($success))
                                {

                                    /*echo '<div class="alert alert-success">'.$success.'</div>';*/
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>'.$success.'</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                }
                                ?>

                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" class="formulario" >

                                    <div class="card mt-4">
                                      <h2 class="card-header">Registro de Nuevo Usuario</h2>
                                      <div class="card-body">
                                          <div class="mb-3 row">
                                           <label class="col-sm-3 col-form-label" for="nombre"><i class="fas fa-user icon"></i> Nombres: </label>
                                           <div class="col-sm-9">
                                                <input class="form-control" name="nombre" id="inputFirstName" type="text" placeholder="Ingrese sus nombres" />    
                                           </div>
                                       </div>

                                       <div class="mb-3 row">
                                           <label class="col-sm-3 col-form-label" for="apellido"><i class="fas fa-user icon"></i> Apellidos: </label>
                                          <div class="col-sm-9">
                                              <input class="form-control" name="apellido" id="inputLastName" type="text" placeholder="Ingrese sus apellidos" />
                                          </div>
                                       </div>

                                       <div class="mb-3 row">
                                          <label class="col-sm-3 col-form-label" for="email"><i class="fas fa-envelope icon"></i> Correo: </label>
                                          <div class="col-sm-9">
                                              <input class="form-control" name="email" id="inputEmailAddress" type="text" aria-describedby="emailHelp" placeholder="Ingrese su correo" />
                                          </div>    
                                       </div>

                                       <div class="mb-3 row">
                                           <label class="col-sm-3 col-form-label" for="password"><i class="fas fa-key icon"></i> Contraseña: </label>
                                           <div class="col-sm-9">
                                                <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Ingrese su contraseña" />
                                           </div>
                                       </div>

                                       <div class="mb-3 row">
                                           <label class="col-sm-3 col-form-label" for="repassword"><i class="fas fa-key icon"></i> Contraseña: </label>
                                           <div class="col-sm-9">
                                               <input class="form-control" name="repassword" id="inputConfirmPassword" type="password" placeholder="Confirmar su Contraseña" />
                                           </div>
                                       </div>



                                       <button type="submit" name="submit" class="btn btn-primary mt-3">Registrarse</button>
                                       <a href="index.php" class="btn btn-danger mt-3">Cancelar</a>
                                       <!--<p>¿Ya tienes una cuenta?<a class="link" href="login.php">Iniciar Sesion</a></p>-->
                                   </div>
                                      </div>
                                    

                               </form>
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
