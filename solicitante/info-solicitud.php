<?php

//Definir el formato de tiempo para la hora
date_default_timezone_set('America/Bogota');
require 'includes/conexion.php';

session_start();
if ($_SESSION['tipo'] != 2 || empty($_POST)) {
    /** Si se intenta acceder a este sitio y no es usuario un solicitante,
        ,no está logueado, o no hay datos enviados se redirigirá al index **/
    header('location:index.php');
}

if (!empty($_POST)) { //Valida que se hayan enviado datos a través de POST


//Variables para guardar los datos que se enviaron a través del formulario
$estado = "Reportado"; //Estado inicial
$descripcion = utf8_decode($_POST['descripcion']);
$ubicacion = utf8_decode($_POST['ubicacion']);
$fecha_creacion = date('d-m-Y h:i:s a', time()); //Toma la fecha actual del sistema
$id_usuario_solicitante = $_SESSION['id']; 
$id_categoria = $_POST['categoria'];
$id_tipo_servicio = $_POST['servicio'];


//Insertar a la base de datos
$sql="INSERT INTO requerimientos(estado, descripcion, ubicacion, fecha_creacion, id_usuario_solicitante, id_categoria, id_tipo_servicio) VALUES ('".$estado."','".$descripcion."','".$ubicacion."','".$fecha_creacion."','".$id_usuario_solicitante."','".$id_categoria."','".$id_tipo_servicio."')";
$resultado=$pdo->prepare($sql);
$resultado->execute();

//Consulta para mostrar resumen
$sql="SELECT * FROM requerimientos WHERE fecha_creacion='$fecha_creacion' and id_usuario_solicitante = '$id_usuario_solicitante'";
$resultado=$pdo->prepare($sql);
$resultado->execute();
$fila=$resultado->fetch(PDO::FETCH_ASSOC);


//Consulta para mostrar el nombre de la categoria
$sql="SELECT * FROM categorias WHERE id_categoria='$id_categoria'";
$resultado=$pdo->prepare($sql);
$resultado->execute();
$cat=$resultado->fetch(PDO::FETCH_ASSOC);

//Consulta para mostrar el nombre del servicio
$sql="SELECT * FROM tipo_servicio WHERE id_tipo_servicio='$id_tipo_servicio'";
$resultado=$pdo->prepare($sql);
$resultado->execute();
$srv=$resultado->fetch(PDO::FETCH_ASSOC);

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
</head>
<body>

<?php include('includes/header.php'); ?>  



<div style="margin: 3rem auto;">

 <a href="solicitud.php" class="btn btn-primary ml-3">Volver</a>
 <center><h1>Resumen de su solicitud</h1>
        
    <ul class='mt-3 ml-3 mr-3 resumen' style='border: 1px solid gray; padding: 25px;'>
        <b><li>Código:  </li></b><p><?php echo $fila['codigo']; ?></p>
        <b><li>Categoría: </li></b><p><?php echo $cat['categoria']; ?></p>
        <b><li>Tipo: </li></b><p><?php  echo utf8_encode($srv['servicio']); ?></p>
        <b><li>Ubicación: </li></b><p><?php echo utf8_encode($fila['ubicacion']); ?></p>
        <b><li>Descrpción: </li></b><p><?php echo utf8_encode($fila['descripcion']); ?></p>   
        <b><li>Fecha de creación: </li></b><p><?php echo $fila['fecha_creacion']; ?></p>
        <b><li>Estado: </li></b><p><?php echo utf8_encode($fila['estado']); ?></p>
    </ul>

</div></center>


 <?php include('includes/footer.php'); ?>  
