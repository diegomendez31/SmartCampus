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
	
	$sql = "SELECT * FROM ECIVIRTUALINDUCTION WHERE id_actividad='".$_GET['actividad']."'";
	$result = mysqli_query($conn ,$sql);
	
	
	if(mysqli_num_rows($result) > 0){
		//show data for each row
		while($row = mysqli_fetch_assoc($result)){
			echo "id_actividad:".$row['id_actividad']."|fecha_inicio:".$row['fecha_inicio']."|fecha_fin:".$row['fecha_fin']."|nombre_actividad:".$row['nombre_actividad']."|lugar:".$row['lugar']."|link_mp3:".$row['link_mp3']."|link_mapa:".$row['link_mapa']."|link_imgActividad:".$row['link_imgActividad'].";";
		}
	}
	mysqli_close($conn);
?>