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
	
	$sql = "SELECT nombre_actividad FROM ECIVIRTUALINDUCTION";
	$result = mysqli_query($conn ,$sql);
	
	
	if(mysqli_num_rows($result) > 0){
		//show data for each row
		while($row = mysqli_fetch_assoc($result)){
			echo $row['nombre_actividad'].";";
		}
	}
	mysqli_close($conn);
?>