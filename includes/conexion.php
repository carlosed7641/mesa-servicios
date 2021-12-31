<?php 
	$link='mysql:host=localhost;dbname=proyecto_web;charset=utf8';
	$user='root';
	$pass='';
	try {
		$pdo = new PDO($link,$user,$pass);
		//echo "Conexion ok.";
	} catch (Exception $e) {
		die("Error: ".$e->GetMessage());
	}
 ?>