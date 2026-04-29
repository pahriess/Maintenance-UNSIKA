<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $u = $_POST['username'];
    $p = md5($_POST['password']);

    $q = mysqli_query($conn,"SELECT * FROM users WHERE username='$u' AND password='$p'");
    $d = mysqli_fetch_assoc($q);

    if ($d) {
        $_SESSION['login'] = true;
        $_SESSION['nama'] = $d['nama'];
        $_SESSION['role'] = $d['role'];
        header("Location:index.php");
        exit;
    } else {
        $err = "Login gagal!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- INI YANG PENTING -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center h-screen bg-gray-100">

<div class="bg-white p-8 rounded-2xl shadow-lg w-80">
    <h2 class="text-2xl font-bold mb-4 text-center text-red-600">Login</h2>

    <?php if(isset($err)) echo "<p class='text-red-500 text-sm mb-2'>$err</p>"; ?>

    <form method="POST">
        <input name="username" placeholder="Username"
            class="w-full p-2 mb-3 border rounded focus:ring-2 focus:ring-red-400" required>

        <input type="password" name="password" placeholder="Password"
            class="w-full p-2 mb-3 border rounded focus:ring-2 focus:ring-red-400" required>

        <button name="login"
            class="w-full bg-red-600 text-white p-2 rounded hover:bg-red-800 transition">
            Login
        </button>
    </form>

    <p class="text-sm text-center mt-3">
        Belum punya akun?
        <a href="register.php" class="text-red-600 font-semibold">Daftar</a>
    </p>
</div>

</body>
</html>