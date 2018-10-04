<?php
    session_start();
 
    if(isset($_POST['login'])) {
		$host = "desarrollo.is.escuelaing.edu.co:3306/bd2087065";
		$usr =  "bd2087065";
		$pass = "2087065";
		$dbName = "bd2087065";
		
		$error = "";
		
        $db = mysqli_connect($host, $usr, $pass, $dbName);
        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);
 
        $username = stripslashes($username);
        $password = stripslashes($password);
       
        $username = mysqli_real_escape_string($db, $username);
        $password = mysqli_real_escape_string($db, $password);
 
        $password = md5($password);
 
        $sql = "SELECT * FROM ECIVIUSERS WHERE user='$username' LIMIT 1";
        $query = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($query);
        if($password == $row['password']) {
            $_SESSION['id'] = 1;
            header("Location: index.php");
        } else {
            $error = "Usuario o contraseña incorrectos";
        }
    }
?>

<html>
<head>
    <title>Login ECIVI</title>
</head>
<body>
	<p style="text-align:center;"><img id="Banner" src="http://estudiantes.is.escuelaing.edu.co/~2092964/Banners/bannerConTexto.png" alt="Escuela Colombiana de Ingenieria Banner" style="width:836px;height:150px;"></p>
    <table style="width:350px; border: 1px solid black; margin-left: auto; margin-right: auto;">
	<tr align="left"><th><h1 style="font-family: Tahoma;"><br>&nbsp;&nbsp;Login</h1></th></tr>
	<br>
    <form action="login.php" method="post" enctype="multipart/form-data">
        <tr align="center"><td><p>Usuario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input placeholder="Usuario" name="username" type="text" autofocus> </p></td></tr>
		<tr align="center"><td><p>Constraseña:&nbsp; <input placeholder="Constraseña" name="password" type="password"> </p></td></tr>
		<br>
        <tr align="center"><td><br><input name="login" type="submit" value="Entrar"><p><br></p></td></tr>
    </form>
	</table>
	<?php echo $error; ?>
	<br>
	<br>
	<br>
	<br>
	<br>
	<p style="text-align:center;"><img id="Banner" src="http://estudiantes.is.escuelaing.edu.co/~2092964/Banners/bannerBajo.png" alt="Escuela Colombiana de Ingenieria BannerBajo" style="width:836px;height:150px;"></p>
</body>
</html>