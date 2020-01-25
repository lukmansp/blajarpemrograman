<?php
require 'function.php'; 
if (isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	$result = mysqli_query($conn, "SELECT  * FROM user WHERE username= '$username'");
	//cek username
	if (mysqli_num_rows($result)===1){
		//ceck password
		$row = mysqli_fetch_assoc($result);
		if(password_verify($password, $row["password"])){
			header("Location: index.php");
			exit;
		}
	}
	$error = true;
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman login</title>
	<style type="text/css">
		label{
			display: block;
		}
	</style>
	<?php if (isset($error)):?>
	<p style="color:red; font-style: italic;">username/password salah</p>
	 <?php endif;?>
</head>
<body>
<h1>Halaman login</h1>
<form action="" method="post">
	<ul>
		<li>
			<label for="username"> Username</label>
			<input type="text" name="username" id="username">
		</li>
		<li>
			<label for="password"> Password</label>
			<input type="password" name="password" id="password">
		</li>
		<button type="submit" name="login">Login</button>
	</ul>
	
</form>
</body>
</html>