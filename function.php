<?php 
$conn =mysqli_connect("localhost", "root","","phpdasar");
// ambil data
function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;

}
return $rows;
}// 
function tambah($data){
	global $conn;
	$nrp =htmlspecialchars($data["nrp"]);//cek supaya tidak memproses script
$nama = htmlspecialchars($data["nama"]);
$email = htmlspecialchars($data["email"]);
$jurusan = htmlspecialchars($data["jurusan"]);

$gambar = upload();
if(!$gambar){
	return false;
}

$query = "INSERT INTO mahasiswa
VALUES
('','$nrp', '$nama','$email', '$jurusan', '$gambar' )";
mysqli_query($conn, $query);
return mysqli_affected_rows($conn);
//cek apakaha ada gambar yang diupload
}

function upload(){
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error	= $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];
	//cek apakah tdk ada gambar yang diupload
	if( $error === 4) {
		echo "<script>
		alert('Pilih gambar dulu');
		</script>";
		return false;
	}
	//cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg','jpeg','png'];//penetapan ekstensi gambar
	$ekstensiGambar = explode('.', $namaFile);//pemecahan file kearaay dan merubah nama belakng file
	$ekstensiGambar =strtolower(end($ekstensiGambar));//mengambil ekstensi trahir gambar dan merubah keukuran kecil jika eks.kapital
	if( !in_array($ekstensiGambar, $ekstensiGambarValid)){
		echo "<script> 
		alert('yang anda upload bukan gambar');

		</script>";
		return false;
	}
	//cek jika terlalu besar
	 if ($ukuranFile > 1000000) {
	 	echo "<script> 
	 	alert('ukuran gambar terlalu besar');

	 	</script>";
	 	return false;
 	# code...
	}
	//gambar dipload
	//generate gambar
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar; 
	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
	return $namaFileBaru;
}

function hapus($id){
	global $conn;
mysqli_query($conn, "DELETE FROM mahasiswa where id =$id");
return mysqli_affected_rows($conn);
}

function ubah($data){
	global $conn;
$id = htmlspecialchars($data["id"]);
$nrp =htmlspecialchars($data["nrp"]);
$nama = htmlspecialchars($data["nama"]);
$email = htmlspecialchars($data["email"]);
$jurusan = htmlspecialchars($data["jurusan"]);
$gambarLama =  htmlspecialchars($data["gambarLama"]);
//cek apkah user pilih gambar baru/tdk
if( $_FILES['gambar']['error'] === 4 ){
	$gambar = $gambarLama;
}else{
	$gambar = upload();
}

$query = "UPDATE mahasiswa SET 
		nrp = '$nrp',
		nama = '$nama',
		email ='$email',
		jurusan = '$jurusan',
		gambar = '$gambar'
		WHERE id = $id
";
mysqli_query($conn, $query);
return mysqli_affected_rows($conn);
}
 function cari($keyword){
 	$query = "SELECT * FROM mahasiswa 
 	WHERE nama LIKE '%$keyword%' OR
 			nrp LIKE '%$keyword%' OR
 			email LIKE '%$keyword%' OR
 			jurusan LIKE '%$keyword%'
 	";// mencari berdasarkan kata yang ada
 	return query($query);
 }
 function registrasi($data){
 	global $conn;
 	$username = strtolower(stripslashes($data["username"]));//mengecilkan huruf semua dan melarang nama berkarakter
 	$password = mysqli_real_escape_string($conn, $data["password"]);
 	$password2= mysqli_real_escape_string($conn, $data["password2"]);
	//cek username 
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username ='$username'");
	if (mysqli_fetch_assoc($result)) {
	 		echo "<script>
	 			alert('user sudah terdaftar');
		 		</script>";
		 		return false;
	 	} 	
 	//cek konfirmasi pass
 	if ($password !== $password2) {
 		echo "<script>
 		alert('password tidak sama');
 		</script>";
 		return false;
 		# code...
 	}
 	//enkripsi pass
 	$password = password_hash($password, PASSWORD_DEFAULT);
 	//tambahkan user baru ke db
 	mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password')");
 	return mysqli_affected_rows($conn);

 }
// mysqli_fetch_row($result);
// var_dump()
 ?>