<?php

require 'includes/conexion.php';
session_start();

if ($_SESSION['tipo'] != 3) { 
/** Si se intenta acceder a este sitio y no es admin,
        o no está logueado, se redirigirá al index **/
	header('location:index.php');
}
//Consulta para mostrar los tipos de usuarios
$sql='SELECT * FROM tipo_usuario WHERE id_tipo_usuario BETWEEN 1 and 2';
$resultado=$pdo->prepare($sql);
$resultado->execute();

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Agregar Usuario</title>
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
<a href="admin-usuarios.php" class="btn btn-primary mt-3 ml-3">Volver</a>
<div class="container" style="margin-top: 0 auto; max-width: 50rem;">
		<div class="card border-success mb-3 mt-3 formulario" style="max-width: 50rem;">
			<div class="card-header text-center" style="text-transform: uppercase;"><h4>Agregar Usuario</h4></div>
			<form class="row" method="POST" action="admin-usuarios.php" style="margin: 0 5px;">
				<div class="col-lg-4 col-md-4 text-center" style="margin-top: 20px;">
					<img src="img/registro.png" style="max-width: 14rem;">
				</div>
				<div class="col-lg-4 col-md-4">
						<br>
						<!--Lista para los tipos de usuario-->
						<select class="form-control" name="tipo_usuario" required="">
							<option value="">--Seleccione el tipo--</option>
							<?php
							//Recorre todas los tipos y los imprime en una lista desplegable
							while ($row=$resultado->FETCH(PDO::FETCH_ASSOC)) :?>
						
							<option value="<?php echo $row['id_tipo_usuario']; ?>"> <?php echo $row['tipo'];?></option>
							
							<?php endwhile; ?>
						</select><br>			

						<input name="nombre_completo" type="text" placeholder="Nombre completo" class="form-control" required=""> <br>
						<input name="direccion" type="text" placeholder="Dirección" class="form-control" required="">
				</div>
				<div class="col-lg-4 col-md-4">
						<br>
						<input name="telefono" type="number" min="0" placeholder="Teléfono" class="form-control" required=""> <br>
						<input name="usuario" type="text" placeholder="Usuario" class="form-control" required=""> <br>
						<input name="password" type="text" placeholder="Contraseña" class="form-control" required=""> <br>

						<center class="mb-3">					
							<button class="btn btn-primary">Guardar</button>
							<a href="agregar-usuario.php" class="btn btn-danger">Cancelar</a>
						</center>						
				</div>
			</form>

		</div><br>
</div><br>

<?php include('includes/footer.php'); ?>  