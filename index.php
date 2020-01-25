
<?php
session_start();
if(!isset($_SESSION["login"])){
header("Location: login.php");
exit;
} 
require 'function.php';
$mahasiswa = query("SELECT  * FROM mahasiswa ORDER BY id ASC");

if( isset($_POST["cari"])) {
	$mahasiswa = cari($_POST["keyword"]);
	# code...

}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
	<style>
		.loader{
			width: 20px;
			position: absolute;
			top: 142px;
			left: 330px;
			z-index: -1;
			/*membelakangi table*/
			display: none;
		}
		@media print{
			.logout,.tambah,.form-cari,.aksi{
				display: none;
			}

		}
	</style>
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
	<a href="logout.php" class="logout">logout</a>|<a href="cetak.php">Cetak</a>
<h1> Daftar mahasiswa</h1>
<a href="tambah.php" class="tambah">Tambah data mahasiswa</a><br>
<br>
<form action="" method="post" class="form-cari">
	<input type="text" name="keyword" size="40" autofocus 
	placeholder="Masukan Keyword.." id="keyword">
	<button type="submit" name="cari" id="tombol-cari">Cari!</button>
	<img src="img/loader.gif" class="loader">
</form>
<br>
<div id="container">
<table border="1" cellpadding="10" cellspacing="0">

<tr class="aksi">
	<th>No</th>
	<th>Aksi</th>
	<th>Gambar</th>
	<th>Nrp</th>
	<th>Nama</th>
	<th>e-mail</th>
	<th>jurusan</th>
</tr>
	<?php $i = 1; ?>
<?php foreach ($mahasiswa as $row) : ?>
<tr>

	<td><?= $i; ?></td>
	<td class="aksi"> 
		<a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a>
		<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">Hapus</a></td>
		<td> <img src="img/<?= $row['gambar'];?>" width="50"></td>
		<td><?= $row['nrp']; ?></td>
		<td><?= $row['nama']; ?></td>
		<td><?= $row['email']; ?></td>
		<td><?= $row['jurusan']; ?></td>

</tr>
<?php $i++; ?>
<?php endforeach; ?>
</table>	
</div>

</body>
</html>