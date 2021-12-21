<?php 
session_start();
$usuario=$_SESSION['username']; //Variable para guardar el nombre del usuario

if ($_SESSION['tipo'] != 2) { 
	 /** Si se intenta acceder a este sitio y no es usuario un solicitante,
        o no está logueado, se redirigirá al index **/
	header('location:index.php');
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Solicitud</title>
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
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<?php include('includes/header.php'); ?>  

<!-- Mensaje de Bienvenida -->
<h2 class="mt-3 ml-3">Bienvenido <?php echo $usuario; ?>, has iniciado sesión.</h2>


<div style="margin: 5rem 0;">
	<center><h1 style="color: darkblue;">¿Qué deseas hacer?</h1></center>

	<div class="row" style="margin: 2rem 0;">
		<div class="col-lg-6 col-md-6 text-center mb-4">
				<img class="img-fluid" src="img/registro.png" style="width: 30%;">
				<h1>Realizar Solicitud</h1><br>
				<a href="realizar-solicitud.php"><button class="btn btn-primary">Click Aquí</button></a>
		</div>
		<br><br><br><br><br><br><br>
		<div class="col-lg-6 col-md-6 text-center">
				<img class="img-fluid" src="img/consulta.png" style="width: 30%;">
				<h1>Consultar Solicitud</h1><br>	
				<a href="consultar-solicitud.php"><button class="btn btn-danger">Click Aquí</button></a>
		</div>
					
	</div>    

</div>


  
 <?php include('includes/footer.php'); ?>  
