<?php
	include("../includes/conexion.php");
	$id_categoria=intval($_REQUEST['id_categoria']); //Variable para guardar el id_categoria

	//Consulta para obtener el servicio de la categoria seleccionada
	$sql = "SELECT * FROM tipo_servicio WHERE id_categoria = '$id_categoria'";
	$servicios = $pdo->prepare($sql);
	echo '<option value = "">--Seleccione un servicio--</option>';
	$servicios->execute();
			
		//Recorre los servicios de la categoría y los muestra en la lista secundaria
		while($row = $servicios->FETCH(PDO::FETCH_ASSOC)){
			echo '<option value = "'.$row['id_tipo_servicio'].'">'.$row['servicio'].'</option>';
		}
?>