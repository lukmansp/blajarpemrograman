<?php 
require 'function.php';
if (isset($_POST["register"])) {
	if (registrasi($_POST)>0) {
		
		echo "<script>
		alert('user ditambahkan');

		</script>";# code...
	}else{
		echo mysqli_error($conn);
	}
 	# code...
 } ?>
<!DOCTYPE html>

<html>
<head>
	<title>Halaman Registrasi</title>
	<style>
		label{
			display: block;
		}
	</style>
</head>
<body>
<form action="" method="post">
	<ul>
		<h1>Halamah registrasi</h1>
		<li>
			<label for="username">username :</label>
			<input type="text" name="username" id="username">
		</li>
		<li>
			<label for="password">password :</label>
			<input type="password" name="password" id="password">
		</li>
		<li>
			<label for="password2">Re-password :</label>
			<input type="password" name="password2" id="password2">
		</li>
		<li>
			<button type="submit" name="register">Registrasi</button>
		</li>
	</ul>
	
</form>
</body>
</html>