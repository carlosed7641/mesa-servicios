<?php

require '../includes/conexion.php';
session_start();

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
	<title>Modificar/Eliminar</title>
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
<a href="index.php" class="btn btn-primary mt-3 ml-3">Volver</a>

<div class="container mb-5" style="margin-top: 5rem; max-width: 50rem;">
	<h4>Escriba el ID o el nombre del usuario: </h2>
	<br>
	<form method="POST" class="form-buscar mb-2"> 
		<input type="text" class="form-control mr-2" required="" name="buscar">
		<button class="btn btn-success">Buscar</button>
	</form>	
	<form method="POST">
		<input type="hidden" name="listar">
		<button class="btn btn-danger">Listar Todos</button>
	</form>
</div>


<?php 

if(!empty($_POST)) {

	if(isset($_POST['buscar'])) {

		$buscar = $_POST['buscar'];

		//Consulta para obtener la cantidad de usuarios con esa información
		$sql = "SELECT count(*) as contar FROM usuarios WHERE nombre_completo LIKE '%$buscar%' OR id_usuario = '$buscar' ";
		$resultado = $pdo->prepare($sql);
		$resultado->execute();
		$fila = $resultado->fetch(PDO::FETCH_ASSOC);


		if($fila['contar'] < 1) { //Si no hay resultados imprime un mensaje

	        echo "<center><h1 id='resultados'>No hay usuarios con esa información</h1></center><br>";
	        include('../includes/footer.php');  
	        die();

		} else {

		echo "<center><h2 id='resultados'>Hay ".$fila['contar']." usuarios con esta información</h2></center><br>";
		$sql = "SELECT * FROM usuarios WHERE nombre_completo LIKE '%$buscar%' OR id_usuario = '$buscar' ";
		$resultado = $pdo->prepare($sql);
		$resultado->execute();

		}

    } else if(isset($_POST['listar'])) {

    	//Consulta para obtener la cantidad de usuarios
		$sql = "SELECT count(*) as contar FROM usuarios";
		$resultado = $pdo->prepare($sql);
		$resultado->execute();
		$fila = $resultado->fetch(PDO::FETCH_ASSOC);

		if($fila['contar'] < 1) { //Si no hay resultados imprime un mensaje

	        echo "<center><h1 id='resultados'>No hay usuarios registrados</h1></center><br>";
	        include('../includes/footer.php');  
	        die();

    	} else {

    		echo "<center><h2 id='resultados'>Hay ".$fila['contar']." usuarios registrados </h2></center><br>";
    		$sql = "SELECT * FROM usuarios";
			$resultado = $pdo->prepare($sql);
			$resultado->execute();
    	}

    } else if(isset($_POST['eliminar'])) {

    	$id = $_POST['eliminar'];
    	$sql = "DELETE FROM usuarios WHERE id_usuario = '$id'";
    	$resultado = $pdo->prepare($sql);
    	$resultado->execute();

    	echo "<center><h2 id='resultados'>Usuario correctamente eliminado</h2></center><br>";

    } else if(isset($_POST['actualizar'])) {

		$id = $_POST['actualizar'];
    	$nombre_completo = $_POST['nombre_completo'];
    	$direccion = $_POST['direccion'];
    	$telefono = $_POST['telefono'];
    	$usuario = $_POST['usuario'];
    	$password = $_POST['password'];
    	$id_tipo_usuario = $_POST['id_tipo_usuario'];

    	$sql = "UPDATE usuarios SET nombre_completo = '$nombre_completo', direccion = '$direccion', 
    	telefono = '$telefono', usuario = '$usuario', password = '$password', 
    	id_tipo_usuario = '$id_tipo_usuario' WHERE id_usuario = '$id' ";

    	$resultado = $pdo->prepare($sql);
		$resultado->execute();

		echo "<center><h2 id='resultados'>Usuario correctamente actualizado</h2></center><br>";

    }

	

?>
		
	<table class="table table-hover table-sm table-dark">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Dirección</th>
				<th>Telefono</th>
				<th>Usuario</th>
				<th>Contraseña</th>
				<th>Tipo de Usuario</th>
      			<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row=$resultado->fetch(PDO::FETCH_ASSOC)) : 

				$id_tipo_usuario = $row['id_tipo_usuario'];

				//Consulta para mostrar el tipo de usuario
			    $sql="SELECT * FROM tipo_usuario WHERE id_tipo_usuario='$id_tipo_usuario'";
			    $resultado_srv=$pdo->prepare($sql);
			    $resultado_srv->execute();
			    $srv=$resultado_srv->fetch(PDO::FETCH_ASSOC);


			?>
			<tr>
				<td><?php echo $row['id_usuario']; ?></td>
				<td><?php echo $row['nombre_completo']; ?></td>
				<td><?php echo $row['direccion']; ?></td>
				<td><?php echo $row['telefono']; ?></td>
				<td><?php echo $row['usuario']; ?></td>
				<td><?php echo $row['password']; ?></td>
				<td><?php echo $srv['tipo']; ?></td>
			<!--Asigna el id usando GET para cuando se pique el botón lleve a la info de ese usuario y editarlo-->
			 	<td style="display: flex;">
				 	<a href="modificar.php?usr=<?php echo $row['id_usuario']; ?>" class="btn btn-success mr-2">Editar</a>
				 	<form method="POST">
					 	<input type="hidden" name="eliminar" value="<?php echo $row['id_usuario']; ?>">
					 	<button class="btn btn-danger" onclick="return confirmarEliminar();">Eliminar</button>
				 	</form>
			 	</td>
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>


<script type="text/javascript">
	
	function confirmarEliminar () {

		var respuesta = confirm("¿Estas seguro que deseas eliminar este usuario?");

		if (respuesta) {

			return true;
			
		} else {

			return false;
		}

	}

</script>



<?php } include('../includes/footer.php'); ?> 


