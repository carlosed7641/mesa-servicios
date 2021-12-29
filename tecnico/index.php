<?php

date_default_timezone_set('America/Bogota');
require '../includes/conexion.php';
session_start();

if($_SESSION['tipo'] != 1) {

/** Si se intenta acceder a este sitio y no es un usuario
  de soporte, o no está logueado, se redirigirá al index **/

header('location:../index.php');

} 

//Variable para guardar el nombre de usuario en sesión y su id
$usuario=$_SESSION['username'];
$id_usuario = $_SESSION['id'];
//Consulta para las categorías principales
$sql='SELECT * FROM categorias';
$resultado=$pdo->prepare($sql);
$resultado->execute();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Consultar Solicitudes</title>
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

<?php 

include('../includes/navbar.php'); 

//Imprime mensaje de bienvenida con el nombre del usuario
echo "<h2 class='mt-3 ml-3'>Bienvenido $usuario, has iniciado sesión.</h2>";

?>

<div class="container" style="margin-top: 5rem;">
	<h4>Consulta el requerimiento por su categoria: </h2>

	<form method="POST"> 
			<select class="form-control" required="" name="categoria">
				<option value="">--Seleccione una categoría--</option>

									<?php
									//Recorre la lista de las categorías y las imprime
									while ($categoria=$resultado->FETCH(PDO::FETCH_ASSOC)) :?>
								
									<option value="<?php echo $categoria['id_categoria']; ?>"> <?php echo $categoria['categoria'];?></option>
									
									<?php endwhile; ?>

		 </select><br>

		 <button class="btn btn-danger">Consultar</button>	
	</form>	
</div><br><br>



<?php 

//Valida que se hayan enviado datos a través de POST
if (!empty($_POST)) : 

?>

<table class="table table-hover table-sm table-dark">
	<!-- Encabezado de la tabla-->
  <thead>
    <tr>
      <th scope="col">Código</th>   	
      <th scope="col">Usuario</th>
      <th scope="col">Servicio</th>
      <th scope="col">Fecha</th>
      <th scope="col">Estado</th>
      <th scope="col">Acción</th>
    </tr>
  </thead>

<?php
//Valida si un requerimiento fue enviado como atendido
if (isset($_POST['atendido'])) {

//Imprime un mensaje en la pantalla
echo "<center><h2>El requerimiento ahora está en proceso</h2></center>";

//Variable para la condición del SQL
$codigo = $_POST['code'];
//Variables para la fecha de atención y el nuevo estado
$fecha_atencion = date('d-m-Y h:i:s a', time());
$estado = "En proceso";

//SQL para actualizar el requerimiento de reportado a en proceso
$sql="UPDATE requerimientos SET estado = '$estado', fecha_atencion = '$fecha_atencion', id_usuario_soporte = '$id_usuario' WHERE codigo = '$codigo'";
$resultado=$pdo->prepare($sql);
$resultado->execute();

//Valida si un requerimiento fue enviado como cancelado
} else if (isset($_POST['cancelado'])) {

//Imprime un mensaje en la pantalla
echo "<center><h2>El requerimiento fue cancelado correctamente</h2></center>";

//Variable para la condición del SQL
$codigo = $_POST['code'];
//Variables para la fecha de atención, finalización, el nuevo estado y el detalle
$fecha_atencion = date('d-m-Y h:i:s a', time());
$fecha_fin = date('d-m-Y h:i:s a', time());
$estado = "Cancelado";
$detalle = "Requerimiento cancelado";

//SQL para actualizar el requerimiento de reportado o en proceso, a cancelado
$sql="UPDATE requerimientos SET estado = '$estado', detalle = '$detalle' ,fecha_atencion = '$fecha_atencion',  fecha_fin = '$fecha_fin', id_usuario_soporte = '$id_usuario' WHERE codigo = '$codigo'";
$resultado=$pdo->prepare($sql);
$resultado->execute();

//Valida si un requerimiento fue enviado como finalizado
} else if (isset($_POST['finalizado'])) {

//Imprime un mensaje en la pantalla
echo "<center><h2>El requerimiento fue atendido correctamente y está finalizado</h2></center>";

//Variable para la condición del SQL
$codigo = $_POST['code'];
//Variables para finalización, el nuevo estado y el detalle
$fecha_fin = date('d-m-Y h:i:s a', time());
$estado = "Atendido";
$detalle = $_POST['detalle'];

//SQL para actualizar el requerimiento de en proceso a finalizado
$sql="UPDATE requerimientos SET estado = '$estado', detalle = '$detalle', fecha_fin = '$fecha_fin' WHERE codigo = '$codigo'";
$resultado=$pdo->prepare($sql);
$resultado->execute();

}

//Valida que se haya seleccionado una categoría
if (isset($_POST['categoria'])) :

//Variable para guardar la categoría que se seleccionó
$id_categoria = $_POST ['categoria'];

//Consulta para obtener los requerimientos asociados a esa categoría
$sql="SELECT * FROM requerimientos WHERE id_categoria = '$id_categoria'";
$resultado=$pdo->prepare($sql);
$resultado->execute();

?>

<tbody><!--Abre el cuerpo de la tabla -->

<?php 
//Recorre la lista de requerimientos
while($row = $resultado->fetch(PDO::FETCH_ASSOC)): 

//Variable para guardar el id del usuario, y el tipo del servicio
$id_usuario = $row['id_usuario_solicitante'];
$servicio = $row['id_tipo_servicio'];

//Consulta para mostrar el nombre del servicio
$sql="SELECT * FROM tipo_servicio WHERE id_tipo_servicio='$servicio'";
$resultado_srv=$pdo->prepare($sql);
$resultado_srv->execute();
$srv=$resultado_srv->fetch(PDO::FETCH_ASSOC);


//Consulta para mostrar el nombre del usuario solicitante
$sql="SELECT * FROM usuarios WHERE id_usuario='$id_usuario'";
$resultado_usr=$pdo->prepare($sql);
$resultado_usr->execute();
$usr=$resultado_usr->fetch(PDO::FETCH_ASSOC);

?>

	 <tr><!-- Imprime la inf de los requerimientos en la tabla-->
		 	<td><?php echo $row['codigo']; ?></td>
		 	<td><?php echo utf8_encode($usr['nombre_completo']); ?></td>
		 	<td><?php echo utf8_encode($srv['servicio']); ?></td>
		 	<td><?php echo $row['fecha_creacion']; ?></td>
		 	<td><?php echo utf8_encode($row['estado']); ?></td>
		 	<!--Asigna el codigo usando GET para cuando se pique el botón lleve a la inf de ese requerimiento -->
		 	<td><a href="revisar-requerimiento.php?req=<?php echo $row['codigo']; ?>" class="btn btn-success">Ver</a></td>
	 </tr> 

<?php endwhile; //Finaliza el ciclo ?>

</tbody> <!--Cierra el cuerpo de la tabla -->

<?php endif; ?> <!--Cierre del if que valida que se haya seleccionado una categoría -->

<?php endif; ?> <!--Cierre del if que valida que se hayan enviado datos a través de POST-->

</table> <!-- Cierra la tabla-->




 <?php include('../includes/footer.php'); ?>  