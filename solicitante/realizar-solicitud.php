<?php

require 'includes/conexion.php';
session_start();

if ($_SESSION['tipo'] != 2) { 
/** Si se intenta acceder a este sitio y no es usuario un solicitante,
        o no está logueado, se redirigirá al index **/
	header('location:index.php');
}
//Consulta para mostrar las categorías principales
$sql='SELECT * FROM categorias';
$resultado=$pdo->prepare($sql);
$resultado->execute();

?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Realizar Solicitud</title>
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
<a href="solicitud.php" class="btn btn-primary mt-3 ml-3">Volver</a>
<div class="container" style="margin-top: 0 auto; max-width: 38rem; ?>">
		<div class="card border-success mb-3 mt-3 formulario" style="max-width: 55rem;">
			<div class="card-header text-center" style="text-transform: uppercase;"><h4>Realizar Solicitud</h4></div>
			<form class="row" method="POST" action="info-solicitud.php" style="margin: 0 5px;">
				<div class="col-lg-6 col-md-6 text-center" style="margin-top: 65px;">
					<img src="img/registro.png" style="max-width: 14rem;">
				</div>
				<div class="col-lg-6 col-md-6">
						<br>
						<!--Lista para las categorias -->
						<select id="id_categoria" class="form-control" name="categoria" required="">
							<option value="">--Seleccione una categoría--</option>
							<?php
							//Recorre todas las categorías y las imprime en una lista desplegable
							while ($categoria=$resultado->FETCH(PDO::FETCH_ASSOC)) :?>
						
							<option value="<?php echo $categoria['id_categoria']; ?>"> <?php echo $categoria['categoria'];?></option>
							
							<?php endwhile; ?>
						</select><br>
						<!--Cierre de lista para las categorias -->

						<!--Lista para los servicios (inicialmente estará deshabilitada) -->
						<select id="servicio" name="servicio" class="form-control" required="" disabled="disabled">
							<option value=""></option>
						</select><br>
						<!--Cierre de lista para los servicios-->

						<input name="ubicacion" type="text" placeholder="Ubicación" class="form-control"
							required=""> <br>

						<label>Descripción: </label>
						<textarea class="form-control" name="descripcion" required="" minlength="30" style="height: 100px;"></textarea><br>

						<div class="text-center" style="margin-bottom: 2rem;">
							<button class="btn btn-primary">Guardar</button>
							<a href="realizar-solicitud.php" class="btn btn-danger">Cancelar</a>
						</div>

				</div><br>
			</form>
	
			</div><br>
		</div>
</div>

<script src = "js/jquery-3.4.1.min.js"></script>
<script type = "text/javascript">
	//Utilizando jquery y ajax
	$(document).ready(function(){
		$('#id_categoria').on('change', function(){ //Cuando se seleccione una categoría
				if($('#id_categoria').val() == ""){ //Si no se selecciona ninguna
					$('#servicio').empty(); //La lista desplegable secundaria seguirá vacía
					$('<option value = ""></option>').appendTo('#servicio');
					$('#servicio').attr('disabled', 'disabled'); //Y seguirá deshabilitada
				}else{ //Si se selecciona una categoría
					$('#servicio').removeAttr('disabled', 'disabled'); //Se quita el disabled
					/**Con ajax se envía el id de la categoría seleccionada
					 a la página donde se hará la consulta para obtener 
					 los servicios de ese tipo de categoría**/
					$('#servicio').load('servicio_get.php?id_categoria=' + $('#id_categoria').val());
				}
		});
	});
</script>


<?php include('includes/footer.php'); ?>  
