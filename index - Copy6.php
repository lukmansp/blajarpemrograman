
<?php
session_start();
if(!isset($_SESSION["login"])){
header("Location: login.php");
exit;
} 
require 'function.php';
//pagniation
//konf
$jumlahdatatampil = 2;
$jumlahhdata = count(query("SELECT * FROM mahasiswa"));
$jumlahhalaman = ceil($jumlahhdata / $jumlahdatatampil);
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"]:1;//cek kondisi jika halaman  awal/ lain
$awaldata = ($jumlahdatatampil * $halamanaktif) - $jumlahdatatampil;

$mahasiswa = query("SELECT  * FROM mahasiswa LIMIT $awaldata, $jumlahdatatampil");

if( isset($_POST["cari"])) {
	$mahasiswa = cari($_POST["keyword"]);
	# code...

}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
</head>
<body>
	<a href="logout.php">logout</a>
<h1> Daftar mahasiswa</h1>
<a href="tambah.php">Tambah data mahasiswa</a><br>
<br>
<form action="" method="post">
	<input type="text" name="keyword" size="40" autofocus 
	placeholder="Masukan Keyword..">
	<button type="submit" name="cari">Cari!</button>
</form>
<br><br>
<!-- perhalaman -->
<?php if($halamanaktif >1 ): ?>
<a href="?halaman=<?= $halamanaktif - 1; ?>">&laquo;</a>
<?php endif; ?>
<!-- nomoring -->
<?php for ($i=1; $i <= $jumlahhalaman; $i++): ?>
	<?php if ($i == $halamanaktif):?>
	<a href="?halaman=<?= $i; ?>" style="font-weight: bold;color: red;"><?= $i; ?></a>
	<?php else : ?>
		<a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
		 <?php endif; ?>
<?php endfor; ?>
<!-- ahir -->
<!-- perhalaman -->
<?php if($halamanaktif < $jumlahhalaman  ): ?>
<a href="?halaman=<?= $halamanaktif + 1; ?>">&raquo;</a>
<?php endif; ?>
<!--  -->
<br>
<table border="1" cellpadding="10" cellspacing="0">

<tr>
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
	<td> 
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
</body>
</html>