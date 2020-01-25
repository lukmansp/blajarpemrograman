<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';

require 'function.php';
$mahasiswa = query("SELECT  * FROM mahasiswa");
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

// Write some HTML code:

$html = '<!DOCTYPE html>
<html>
<head>
	<title>Daftar mahasiwa</title>
	<link rel="stylesheet" href="css/print.css">
</head>
<body>
<h1>Daftar mahasiwa</h1>
<table border="1" cellpadding="10" cellspacing="0">

		<tr>
			<th>No</th>
			<th>Gambar</th>
			<th>Nrp</th>
			<th>Nama</th>
			<th>e-mail</th>
			<th>jurusan</th>
		</tr>';
		$i = 1;
		foreach ( $mahasiswa as $row ) {
			$html .='<tr>
			<td>'. $i++ .'</td>
			<td><img src="img/'. $row["gambar"] .'" width="50"></td>
			<td>'. $row["nrp"] .'</td>
			<td>'. $row["nama"] .'</td>
			<td>'. $row["email"] .'</td>
			<td>'. $row["jurusan"] .'</td>
			</tr>';
		}


$html .='</table>
</body>
</html>';

$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output('daftar-mahasiswa.pdf',\Mpdf\Output\Destination::INLINE);
?>
