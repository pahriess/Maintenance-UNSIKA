<?php
include 'koneksi.php';

if(isset($_POST['submit'])){
$nama=$_POST['nama_pelapor'];
$lokasi=$_POST['lokasi'];
$desk=$_POST['deskripsi'];

mysqli_query($conn,"INSERT INTO maintenance (nama_pelapor,lokasi,deskripsi) VALUES('$nama','$lokasi','$desk')");

header("Location:index.php");
}