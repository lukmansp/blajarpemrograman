<?php
session_start();
if(!isset($_SESSION["login"])){
header("Location: login.php");
exit;
} 
require 'function.php';

$id = $_GET["id"];
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if( isset($_POST["submit"])){

if(ubah($_POST) > 0 ){
	echo "<script> alert('data dirubah');
	document.location.href = 'index.php';
	</script>
	";
}
else {
	echo "<script> alert('gagal dirubah');
	document.location.href = 'ubah.php';
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
<h1>ubah Mahasiswa</h1>
<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
		<input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">

	<ul>
		<li>
			<label for="nrp">NRP :</label>
			<input type="text" name="nrp" id="nrp" required value="<?= $mhs["nrp"]; ?>">
		</li>

		<li>
			<label for="nama">Nama :</label>
			<input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>">
		</li>

		<li>
			<label for="email">Email :</label>
			<input type="text" name="email" id="email" required value="<?= $mhs["email"]; ?>">
		</li>

		<li>
			<label for="jurusan">Jurusan :</label>
			<input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"]; ?>">
		</li>

		<li>
			<label for="gambar">Gambar :</label><br>
			<img src="img/<?= $mhs["gambar"]; ?>" width="40"><br>
			<input type="file" name="gambar" id="gambar">
		</li>
		<li>
			<button type="submit" name="submit"> ubah</button>
		</li>
	</ul>
	
</form>
</body>
</html>
<!-- <div style="position:absolute;top: 0;bottom: 0;left: 0;right: 0;background-color: black;font-size: 80px;color: red;text-align: center;">anda dihack</div> -->