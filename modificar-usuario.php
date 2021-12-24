<?php

require 'includes/conexion.php';
session_start();

if ($_SESSION['tipo'] != 3) { 
/** Si se intenta acceder a este sitio y no es admin,
        o no está logueado, se redirigirá al index **/
	header('location:index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Modificar/Eliminar</title>
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

<?php include('includes/header.php'); ?>

<div class="container mb-5" style="margin-top: 5rem; max-width: 50rem;">
	<h4>Escriba el ID o el nombre del usuario: </h2>
	<br>
	<form method="POST" class="form-buscar mb-2"> 
		<input type="text" class="form-control mr-2" required="listar" name="buscar">
		<button class="btn btn-success">Buscar</button>
	</form>	
	<form>
		<input type="submit" name="listar" value="Listar Todos" class="btn btn-danger">	
	</form>
</div>


<?php 

if(!empty($_POST)) {

	$buscar = $_POST['buscar'];

	$sql = "SELECT * FROM usuarios WHERE nombre_completo LIKE '%$buscar%' OR id_usuario = '$buscar' ";
	$resultado = $pdo->prepare($sql);
	$resultado->execute();
	$row=$resultado->fetch(PDO::FETCH_ASSOC);

	if (!$row) {

		echo "<center><h2 class='mb-3'>No se encuentra un usuario con la información solicitada</h2></center>";
		include('includes/footer.php'); 
		die();
	} else {
		
	}

}

?>




<?php include('includes/footer.php'); ?> 


