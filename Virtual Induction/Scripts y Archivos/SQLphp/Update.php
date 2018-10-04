<?php
	$servername = "desarrollo.is.escuelaing.edu.co:3306/bd2087065";
	$username =  "bd2087065";
	$password = "2087065";
	$dbName = "bd2087065";
	
	//Make Connection
	$conn = new mysqli($servername, $username, $password, $dbName);
	//Check Connection
	if(!$conn){
		die("Connection Failed. ". mysqli_connect_error());
	}
	$sql = "UPDATE ECIVIRTUALINDUCTION SET fecha_inicio='".$_GET['fechainicio']."', fecha_fin='".$_GET['fechafin']."', lugar='".$_GET['lugar']."', nombre_actividad='".$_GET['nombreactividad']."', link_mp3='".$_GET['linkmp3']."', link_mapa='".$_GET['linkmapa']."' WHERE id_actividad='".$_GET['actividad']."'";
	mysqli_query($conn ,$sql);
	mysqli_close($conn);
	header("Location: ../actividad.php?actividad=".$_GET['actividad']);
?>