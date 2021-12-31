<?php 
require '../includes/conexion.php';
session_start();

if($_SESSION['tipo'] != 1 || !isset($_GET['req'])) {

/** Si se intenta acceder a este sitio y no es un usuario
  de soporte, no está logueado o no hay ningun código se redirigirá al index **/
header('location:../index.php');

} 

//Variable para guardar el código que viene desde consultar categoría
$req = $_GET['req'];

//Consulta para obtener la información del requerimiento asociada al código
$sql="SELECT * FROM requerimientos WHERE codigo = '$req'";
$resultado=$pdo->prepare($sql);
$resultado->execute();
$row = $resultado->fetch(PDO::FETCH_ASSOC);

/**Si se escribe en la url un código que no existe,
redigirirá al index para evitar errores**/
if(!$row) {
    header('location:../index.php');
}

//Variable para guardar la categoría, servicio y el usuario solc.
$categoria = $row['id_categoria'];
$servicio = $row['id_tipo_servicio'];
$id_usuario = $row['id_usuario_solicitante'];

//Consulta para mostrar el nombre de la categoria
$sql="SELECT * FROM categorias WHERE id_categoria='$categoria'";
$resultado=$pdo->prepare($sql);
$resultado->execute();
$cat=$resultado->fetch(PDO::FETCH_ASSOC);

//Consulta para mostrar el nombre del servicio
$sql="SELECT * FROM tipo_servicio WHERE id_tipo_servicio='$servicio'";
$resultado=$pdo->prepare($sql);
$resultado->execute();
$srv=$resultado->fetch(PDO::FETCH_ASSOC);


//Consulta para mostrar el nombre del usuario solicitante
$sql="SELECT * FROM usuarios WHERE id_usuario='$id_usuario'";
$resultado=$pdo->prepare($sql);
$resultado->execute();
$usr=$resultado->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Revisar Requerimiento</title>
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

<center><div style="margin-top: 3rem;">
	<h1>Información del requerimiento</h1><br>
    <!-- Imprime la información del requerimiento-->
    <form method="POST" action="index.php">       
        <ul class='mt-3 ml-3 mr-3 resumen' style='border: 1px solid gray; padding: 25px;'>
            <b><li>Código: </li></b><p><?php echo $row['codigo']; ?></p>
            <b><li>Usuario solicitante: </li></b><p><?php echo $usr['nombre_completo']; ?></p>
            <b><li>Categoría: </li></b><p><?php echo $cat['categoria']; ?></p>
            <b><li>Tipo: </li></b><p><?php echo $srv['servicio']; ?></p>
            <b><li>Ubicación: </li></b><p><?php echo $row['ubicacion']; ?></p>
            <b><li>Descrpción: </li></b><p><?php echo $row['descripcion']; ?></p>
            <b><li>Fecha de creación: </li></b><p><?php echo $row['fecha_creacion']; ?></p>
            <b><li>Fecha de atención: </li></b><p><?php echo $row['fecha_atencion']; ?></p>
            <b><li>Fecha de finalización: </li></b><p><?php echo $row['fecha_fin']; ?></p>
            <b><li>Estado: </li></b><p><?php echo $row['estado']; ?></p>
        </ul><br>
        <div class="text-center">

        <!--Este input toma el código del requerimiento para después cambiar el estado
            si fue atendido, cancelado o finalizado e insertarlo en la Base de datos-->
        <input type="hidden" name="code" value="<?php echo $row['codigo']; ?>">

            <?php 

            //Variable para guardar el estado del requerimiento
            $estado = $row['estado'];

            //Si el requerimiento está reportado saldrá la opción de atender, cancelar y regresar
            if($estado == "Reportado") { ?>

    		<input type="submit"class="btn btn-success" value="Atender" name="atendido">
            <input type="submit"class="btn btn-danger" value="Cancelar" name="cancelado">
                  	
            <?php }

            /**Si el requerimiento está en proceso saldrá la opción de finalizar, cancelar, regresar y 
               el campo de texto para escribir el detalle**/
            if($estado == "En proceso") { ?>

            <label><b>Detalle:</b></label>
            <center><textarea class="form-control" name="detalle" required minlength="30" style="height: 100px; width: 350px;"></textarea></center><br>

            <input type="submit"class="btn btn-success" value="Finalizar" name="finalizado"id="finalizado">    
            <input type="submit"class="btn btn-danger" value="Cancelar" name="cancelado" onclick="noRequired();">    

           <?php } ?>

           <script type="text/javascript">
               
               function noRequired () {

                    document.querySelector("textarea").removeAttribute("required");
               }
               

           </script>

        <!--Si está cancelado o ya está finalizado solo saldrá la opción de regresar -->
        <a href="index.php" class="btn btn-primary">Volver</a>

    	</div><br><br>
    </form>

</div></center>


 <?php include('../includes/footer.php'); ?>  
