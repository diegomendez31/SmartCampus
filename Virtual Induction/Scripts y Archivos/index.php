<?php session_start();
if(!isset($_SESSION['id'])){
		header("Location: login.php");
	}?>
<!DOCTYPE html>
<html>
<head>
<script src="script.js"></script>
<title>InducciónVirtual</title>
</head>
<body onload="getActividades();">

<p style="text-align:center;"><img id="Banner" src="http://estudiantes.is.escuelaing.edu.co/~2092964/Banners/bannerConTexto.png" alt="Escuela Colombiana de Ingenieria Banner" style="width:836px;height:150px;"></p>

<table style="width:836px; border: 1px solid black; margin-left: auto; margin-right: auto;">
	<tr style="border: 1px solid black;"><th style="border: 1px solid black;"><h2>ACTIVIDADES</h2></th></tr>
	<?php 
	for ($i = 1; $i <= 21; $i++) {
		echo "<tr align=\"left\" style=\"border: 1px solid black;\"><th style=\"border: 1px solid black;\"><a href=\"actividad.php?actividad=".$i."\" id=\"actividad".$i."\" ></a></th></tr>";
	}
	?>
</table>

<br>
<div style="text-align:center;">
	<button type="button" onclick="Salir()">Salir de la sesión</button>
</div>

</body>
</html>