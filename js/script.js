$(document).ready(function(){
	//hilangkan tombol cari
	$('#tombol-cari').hide();
$('#keyword').on('keyup', function(){
//munculkan loadin
$('.loader').show();
// // ajak menggunakan load
// $('#container').load('ajax/mahasiswa.php?keyword='+ $('#keyword').val());

$.get('ajax/mahasiswa.php?keyword=' +$('#keyword').val(),function(data){
$('#container').html(data);
$('.loader').hide();
	});
});
});