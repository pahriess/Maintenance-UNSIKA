<?php
$conn = mysqli_connect("localhost","root","","unsika_maintenance");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>