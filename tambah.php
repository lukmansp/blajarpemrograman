<?php
session_start();
if(!isset($_SESSION["login"])){
header("Location: login.php");
exit;
} 
require 'function.php';
if( isset($_POST["submit"])){

if(tambah($_POST) > 0 ){
	echo "<script> alert('data disimpan');
	document.location.href = 'index.php';
	</script>
	";
}
else {
	echo "<script> alert('gagal disimpan');
	document.location.href = 'tambah.php';
	</script>
	";
}
	# code...
}
// cek keberhasilan

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Mahasiswa</title>
</head>
<body>
<h1>Tambah Mahasiswa</h1>
<form action="" method="post" enctype="multipart/form-data">
	<ul>
		<li>
			<label for="nrp">NRP :</label>
			<input type="text" name="nrp" id="nrp" required>
		</li>

		<li>
			<label for="nama">Nama :</label>
			<input type="text" name="nama" id="nama" required>
		</li>

		<li>
			<label for="email">Email :</label>
			<input type="text" name="email" id="email" required>
		</li>

		<li>
			<label for="jurusan">Jurusan :</label>
			<input type="text" name="jurusan" id="jurusan" required>
		</li>

		<li>
			<label for="gambar">Gambar :</label>
			<input type="file" name="gambar" id="gambar">
		</li>
		<li>
			<button type="submit" name="submit"> Tambah</button>
		</li>
	</ul>
	
</form>
</body>
</html>
<!-- <div style="position:absolute;top: 0;bottom: 0;left: 0;right: 0;background-color: black;font-size: 80px;color: red;text-align: center;">anda dihack</div> -->