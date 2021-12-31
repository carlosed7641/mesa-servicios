<?php
require '../includes/conexion.php';
session_start();
if ($_SESSION['tipo'] != 2) {
    /** Si se intenta acceder a este sitio y no es usuario un solicitante,
        o no está logueado, se redirigirá al index **/
    header('location:../index.php');
}

//Se guarda el id del usuario en una variable
$id = $_SESSION['id'];

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consultar Solicitud</title>
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


<div style="margin: 3rem 0;">
    <a href="index.php" class="btn btn-primary ml-3">Volver</a>
    
    <center><h1 style="color: darkblue; margin-top: 1rem">¿Qué tipo de consulta desea hacer?</h1></center>

    <div class="row" style="margin: 3rem 0;">
        <form class="col-lg-6 col-md-6 text-center mb-4" method="POST" action="consultar-solicitud.php#resultados">
                <img class="img-fluid" src="../assets/images/consulta_general.png" style="width: 30%;">
                <input type="hidden" name="consulta_general">
                <h1>Consulta general</h1><br>
                <button class="btn btn-primary">Click Aquí</button>
        </form>
        <br><br><br><br><br><br><br>
        <form class="col-lg-6 col-md-6 text-center" method="POST" action="consultar-solicitud.php#resultados">
                <img class="img-fluid" src="../assets/images/consulta_codigo.png" style="width: 30%;">
                <h1>Consultar por código</h1><br>    
                <input type="number" name="codigo" placeholder="Digite su código" class="form-control" min="1" required=""><br>
                <button class="btn btn-danger">Click Aquí</button>
        </form>
                   
    </div>  
</div>


<?php 

if (!empty($_POST)) { //Valida que se hayan enviado datos a través de POST

   //Si presionó consulta general 
   if(isset($_POST['consulta_general'])) {

        //Consulta para contar la cantidad de requerimientos que tiene el usuario
        $sql="SELECT count(*) as contar FROM requerimientos WHERE id_usuario_solicitante='$id'";
        $resultado=$pdo->prepare($sql);
        $resultado->execute();
        $fila = $resultado->fetch(PDO::FETCH_ASSOC);

        if($fila['contar'] < 1) { //Si no hay requerimientos imprime un mensaje

        echo "<center><h1 id='resultados'>Usted no tiene solicitudes realizadas</h1></center><br>";
        include('../includes/footer.php');  
        die();

        } else { //Si hay requerimientos nos dice la cantidad que hay

          $usuarios = "";

          if ($fila['contar'] == 1) {
            $solicitudes = "solicitud";
          } else {
            $solicitudes = "solicitudes";
          }

      echo "<center><h3 style='color: darkblue;'>Usted ha realizado "
      .$fila['contar']." ".$solicitudes."</h3><br></center>";

        //Consulta para obtener los requerimientos que tiene el usuario
        $sql="SELECT * FROM requerimientos WHERE id_usuario_solicitante='$id'";
        $resultado=$pdo->prepare($sql);
        $resultado->execute();

        } 

    } else { //Si presionó consulta por código

       $codigo = $_POST['codigo'];  //Variable para guardar el código que digitó el usuario

        //Consulta para contar si hay requerimientos con ese código, que haya realizado ese usuario
        $sql="SELECT count(*) as contar FROM requerimientos WHERE codigo='$codigo' and id_usuario_solicitante='$id'";
        $resultado=$pdo->prepare($sql);
        $resultado->execute();
        $fila = $resultado->fetch(PDO::FETCH_ASSOC);

        if($fila['contar'] < 1) { //Si no hay requerimientos con ese código imprime un mensaje

        echo "<center><h1 id='resultados'>Código ingresado no valido</h1></center><br>";
        include('../includes/footer.php');  
        die();

        } else { //Si hay un requerimiento hace la consulta para obtenerlo

            $sql="SELECT * FROM requerimientos WHERE codigo='$codigo'";
            $resultado=$pdo->prepare($sql);
            $resultado->execute(); 

        }

    }

?>
<div id="tabla">
<table id="resultados"class="table table-hover table-sm table-dark">
        <thead>
            <tr>
                  <th scope="col">Código</th>       
                  <th scope="col">Categoría</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Ubicación</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Fecha C</th>
                  <th scope="col">Fecha A</th>
                  <th scope="col">Fecha F</th>
                  <th scope="col">Atención</th>
                  <th scope="col">Detalle</th>
                  <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>

<?php while ($fila=$resultado->fetch(PDO::FETCH_ASSOC)): //Recorre las consultas


      //Se guardan los datos de la categoría, servicio y el usuario de soportes
      $id_categoria = $fila['id_categoria'];
      $id_servicio = $fila['id_tipo_servicio'];
      $id_usuario = $fila['id_usuario_soporte'];


      //Consulta para mostrar el nombre de la categoria
      $sql="SELECT * FROM categorias WHERE id_categoria='$id_categoria'";
      $resultado_cat=$pdo->prepare($sql);
      $resultado_cat->execute();
      $cat=$resultado_cat->fetch(PDO::FETCH_ASSOC);


      //Consulta para mostrar el nombre del servicio
      $sql="SELECT * FROM tipo_servicio WHERE id_tipo_servicio='$id_servicio'";
      $resultado_srv=$pdo->prepare($sql);
      $resultado_srv->execute();
      $srv=$resultado_srv->fetch(PDO::FETCH_ASSOC);


      //Consulta para mostrar el nombre del usuario de soporte
      $sql="SELECT * FROM usuarios WHERE id_usuario='$id_usuario'";
      $resultado_usr=$pdo->prepare($sql);
      $resultado_usr->execute();
      $usr=$resultado_usr->fetch(PDO::FETCH_ASSOC);
       
?>
        <tr>
           <td><?php echo $fila['codigo'];?></td>
           <td><?php echo $cat['categoria'];?></td>
           <td><?php echo $srv['servicio'];?></td>
           <td><?php echo $fila['ubicacion'];?></td>
           <td><?php echo $fila['descripcion'];?></td>
           <td><?php echo $fila['fecha_creacion'];?></td>
           <td><?php echo $fila['fecha_atencion'];?></td>
           <td><?php echo $fila['fecha_fin'];?></td>
           <!--Se hace la validación para que no arroje un error si aun no se ha atendido -->
           <td><?php if($usr){echo $usr['nombre_completo'];}else{} ?></td>
           <td><?php echo $fila['detalle'];?></td>
           <td><?php echo $fila['estado'];?></td>
        </tr>

<?php endwhile; ?> 

        </tbody>
        </table>
        </div>   

<?php } //Cierre del primer If ?>

<?php include('../includes/footer.php'); ?>  