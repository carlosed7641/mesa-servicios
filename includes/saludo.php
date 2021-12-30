<?php

date_default_timezone_set('America/Bogota');

$hora = strtotime(date('H:i:s'));

$dia = strtotime('05:00:00');
$tarde = strtotime('12:00:00');
$noche = strtotime('19:00:00');

$user = explode(" ", utf8_decode($usuario));

//Imprime mensaje de acuerdo a la horas
if ($hora >= $dia && $hora < $tarde) {
	
echo "<h2 class='mt-3 ml-3'>Buenos días, $user[0]</h2>";

} else if ($hora >= $tarde && $hora < $noche) {

echo "<h2 class='mt-3 ml-3'>Buenas tardes, $user[0]</h2>";

} else {

echo "<h2 class='mt-3 ml-3'>Buenas noches, $user[0]</h2>";

}

?>