<?php session_start();
if(!isset($_SESSION['id'])){
	header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<script src="script.js"></script>
<title>ECIVirtualInduction</title>
</head>
<body onload="cambioImagen();">

<p style="text-align:center;"><img id="Banner" src="http://estudiantes.is.escuelaing.edu.co/~2092964/Banners/bannerConTexto.png" alt="Escuela Colombiana de Ingenieria Banner" style="width:836px;height:150px;"></p>

<table style="width:836px; border: 1px solid black; margin-left: auto; margin-right: auto;">
<tr style="border: 1px solid black;"><th style="border: 1px solid black;"><h2 style="display:inline">Id Imagen: 
<?php 
	echo "<h2 style=\"display:inline\" id=\"ids\">".$_GET['actividad']."</h2>";
?>
</h2>

<form onSubmit="Guardar()">
<img id="imgScan" src="" alt="Escuela Colombiana de Ingenieria Target" style="width:250px;height:250px;">
</th></tr>
<tr style="border: 1px solid black;"><td  style="border: 1px solid black;">
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp; Nombre Actividad: <input id="NombreActividad" type="text" name="NombreActividad" style="width: 500px;"><br>
	&nbsp;&nbsp;&nbsp;&nbsp; Fecha Inicio: <input id="FechaInicio" type="datetime-local"><br>
	&nbsp;&nbsp;&nbsp;&nbsp; Fecha Final:&nbsp; <input id="FechaFin" type="datetime-local"><br>
	&nbsp;&nbsp;&nbsp;&nbsp; Lugar: <input id="Lugar" type="text" name="Lugar" style="width: 500px;"><br>
	&nbsp;&nbsp;&nbsp;&nbsp; Link del Mp3: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input id="LinkMp3" type="text" name="LinkMp3" style="width: 655px;"><br>
	&nbsp;&nbsp;&nbsp;&nbsp; Link del Mapa Guía: <input id="LinkMapa" type="text" name="LinkMapa" style="width: 655px;"><br>
	<br>
</td></tr>
<tr  style="border: 1px solid black;" align="center"><td  style="border: 1px solid black;">
<br>
<?php
	if($_GET['actividad']!=1){
		echo "<button type=\"button\" onclick=\"imgVecina('-')\" id=\"botonAnterior\"><< Anterior</button>";		
	}
?>
	<input type="submit" value="Guardar Actividad">
<?php
	if($_GET['actividad']!=21){
		echo "<button type=\"button\" onclick=\"imgVecina('+')\" id=\"botonSiguiente\">Siguiente >></button>";		
	}
?>
<br>
<p> </p>
</form></td></tr>

<br>
<tr style="border: 1px solid black;" align="center"><td style="border: 1px solid black;">
<br>
<button type="button" onclick="location.href = 'index.php';" id="botonActividades">Volver a Actividades</button>
<br>
<p> </p>
</td></tr>




</body>
</html>