<?php  
session_start();
require_once('base_de_datos.php');
 
if(isset($_POST['submit']))
{
	if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
	{
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
 
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$sql = "select * from users where email = :email ";
			$handle = $base_de_datos->prepare($sql);
			$params = ['email'=>$email];
			$handle->execute($params);
			if($handle->rowCount() > 0)
			{
				$getRow = $handle->fetch(PDO::FETCH_ASSOC);
				if(password_verify($password, $getRow['password']))
				{
					unset($getRow['password']);
					$_SESSION = $getRow;
					header('location:listar.php');
					exit();
				}
				else
				{
					$errors[] = "Error en  Email o Password";
				}
			}
			else
			{
				$errors[] = "Error Email o Password";
			}
			
		}
		else
		{
			$errors[] = "Email no valido";	
		}
 
	}
	else
	{
		$errors[] = "Email y Password son requeridos";	
	}
 
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title></title> 
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
	
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
	<link rel="stylesheet" href="public/css/estilos.css">
	

</head>  
<body>

         <nav class="nav">
                <a href="index.php" class="nav__items nav__items--cta" data-bs-toggle="modal" data-bs-target="#exampleModal">Sistema de Venta</a>
        </nav>

         <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="formulario">
    
            <h1 class="titulo_formulario">Iniciar Sessión</h1>
             <div class="contenedor">
                 <div class="input-contenedor">
	                 <i class="fas fa-envelope icon"></i>
	                  <input class="form-control" name="email" id="inputEmail" type="text" placeholder="Correo" />
                 </div>
                 
                 <div class="input-contenedor">
	                 <i class="fas fa-key icon"></i>
	                 <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Contraseña" />
                 </div>

                  <button type="submit" name="submit" class="button">Iniciar Sessión</button>
                  <!--<p>¿No tienes una cuenta? <a class="link" href="registro.php">Registrate </a></p>-->
             </div>
     </form>




</body>
</html>