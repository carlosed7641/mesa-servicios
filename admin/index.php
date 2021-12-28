<?php 
require '../includes/conexion.php';
session_start();
$usuario=$_SESSION['username']; //Variable para guardar el nombre del usuario

if ($_SESSION['tipo'] != 3) { 
	 /** Si se intenta acceder a este sitio y no es admin,
        o no está logueado, se redirigirá al index **/
	header('location:../index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Administrador de Usuarios</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-breezed.css">
    <link rel="stylesheet" href="../assets/css/owl-carousel.css">
    <link rel="stylesheet" href="../assets/css/lightbox.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>

<?php include('../includes/navbar.php'); ?>


<!-- Mensaje de Bienvenida -->
<h2 class="mt-3 ml-3">Bienvenido <?php echo $usuario; ?>, has iniciado sesión.</h2>


<div style="margin: 5rem 0;">
	<center><h1 style="color: darkblue;">¿Qué deseas hacer?</h1></center>

	<div class="row" style="margin: 2rem 0;">
		<div class="col-lg-6 col-md-6 text-center mb-4">
				<img class="img-fluid" src="../assets/images/registro.png" style="width: 30%;">
				<h1>Agregar Usuario</h1><br>
				<a href="agregar-usuario.php"><button class="btn btn-primary">Click Aquí</button></a>
		</div>
		<br><br><br><br><br><br><br>
		<div class="col-lg-6 col-md-6 text-center">
				<img class="img-fluid" src="../assets/images/editar.png" style="width: 30%;">
				<h1>Modficar/Eliminar Usuario</h1><br>	
				<a href="modificar-usuario.php"><button class="btn btn-danger">Click Aquí</button></a>
		</div>
					
	</div>    

</div>

<?php 

if (!empty($_POST)) {

	//Valida que se hayan enviado datos a través de POST
	$nombre_completo = $_POST['nombre_completo'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];
	$usuario = $_POST['usuario'];
	$password = $_POST['password'];
	$id_tipo_usuario = $_POST['tipo_usuario'];


	//Imprime un mensaje en la pantalla
	echo "<center><h2>Usuario agregado correctamente</h2></center>";

	//Insertar a la base de datos
	$sql="INSERT INTO usuarios (nombre_completo, direccion, telefono, usuario, password, id_tipo_usuario)
	VALUES ('".$nombre_completo."', '".$direccion."', '".$telefono."', '".$usuario."', 
	'".$password."', '".$id_tipo_usuario."')";
	$resultado = $pdo->prepare($sql);
	$resultado->execute();

}

?>

<?php include('../includes/footer.php'); ?>  
