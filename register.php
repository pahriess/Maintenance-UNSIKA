<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $err = "Username sudah dipakai!";
    } else {
        mysqli_query($conn, "INSERT INTO users (nama, username, password, role) 
                             VALUES ('$nama','$username','$password','user')");
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">

<div class="bg-white p-8 rounded-xl shadow-lg w-80">
<h2 class="text-xl font-bold mb-4 text-center">Register User</h2>

<?php if(isset($err)) echo "<p class='text-red-500'>$err</p>"; ?>

<form method="POST">
<input name="nama" placeholder="Nama" class="w-full p-2 mb-3 border rounded" required>
<input name="username" placeholder="Username" class="w-full p-2 mb-3 border rounded" required>
<input type="password" name="password" placeholder="Password" class="w-full p-2 mb-3 border rounded" required>

<button name="register" class="w-full bg-green-600 text-white p-2 rounded hover:bg-green-800">
Daftar
</button>
</form>

<p class="text-sm mt-3 text-center">
Sudah punya akun? <a href="login.php" class="text-red-600">Login</a>
</p>
</div>

</body>
</html>