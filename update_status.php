<?php
session_start();
if($_SESSION['role']!='admin'){
die("Akses ditolak");
}

include 'koneksi.php';

$id=$_POST['id'];
$status=$_POST['status'];

mysqli_query($conn,"UPDATE maintenance SET status='$status' WHERE id=$id");

header("Location:index.php");