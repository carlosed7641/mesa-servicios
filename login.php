<?php 

require 'includes/conexion.php';

session_start();

if (isset($_SESSION['username'])) {   

    header('location:index.php'); //Si hay una sesión iniciada redirige al index
} 

$error = ""; //Variable para guardar el mensaje de error

if (!empty($_POST)) { //Valida que se hayan enviado datos a través de POST

	$user=$_POST['usuario']; //Guarda el usuario en una variable
	$pass=$_POST['password']; //Guarda la contraseña en una variable

	//Consulta para validar los datos
	$query="SELECT * FROM usuarios where usuario='$user' and password='$pass'";
	$resultado=$pdo->prepare($query);
	$resultado->execute();
	$fila=$resultado->fetch(PDO::FETCH_ASSOC);

	//Si la consulta arroja resultados, significa que existe el usuario
	if ($fila) {

		//Variables globales de sesión para id, nombre y el tipo de usuario
		$_SESSION['username']= utf8_encode($fila['nombre_completo']);
		$_SESSION['id']= $fila['id_usuario'];
		$_SESSION['tipo']= $fila['id_tipo_usuario'];

		//Validar si es técnico o solicitante 1 es técnico, 2 solicitante
		if($fila['id_tipo_usuario'] == 1) {
			header("location:consultar-categoria.php");

		} else  if ($fila['id_tipo_usuario'] == 2){
			header("location:solicitud.php");
		}

	} else { 
		 //Si la consulta no arroja resultados se guarda el mensaje de error
		 $error = "Usuario o contraseña incorrectos";
	}
	
}	

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ingresar</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-breezed.css">
  <link rel="stylesheet" href="assets/css/owl-carousel.css">
  <link rel="stylesheet" href="assets/css/lightbox.css">
</head>

<body>
  
<nav class="navbar navbar-expand-lg navbar-light gradiente" style="padding: 20px;">
    <a class="navbar-brand" href="index.php" style="color: white;">MESA DE SERVICIOS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <ul class="navbar-nav mr-auto">

	        <li class="nav-item">
	          <a class="nav-link" href="index.php#about" style="color: white;">Nosotros</a>
	        </li>

      	</ul>
      </form>
    </div>
</nav>


<div class="container" style="margin: 5rem auto; max-width: 35rem;">
		<div class="card border-secondary mb-3 mt-3" style="max-width: 35rem;">
			<div class="card-header text-center" style="text-transform: uppercase;">Inicio de Sesion</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 text-center">
					<img src="img/login.png" style="max-width: 15rem; margin-top: 15px;">
				</div>
				<div class="col-lg-6 col-md-6">
					<form class="form-group" method="POST" style="margin: 2rem 15px">
						<input type="text" name="usuario" placeholder="Digite su usuario" class="form-control"
							required=""><br>
						<input type="password" name="password" placeholder="Digite su contraseña" class="form-control"
							required=""><br>				
						<div class="text-center">
							<button class="btn btn-primary">Ingresar</button>
							<a href="login.php" class="btn btn-danger">Cancelar</a>
						</div>
					</form>
				</div>
			</div>
			<div class="alerta error">
       		<?php echo $error; //Imprime el mensaje de error ?>
    	</div>
		</div>
</div>




 <?php include('includes/footer.php'); ?>  
